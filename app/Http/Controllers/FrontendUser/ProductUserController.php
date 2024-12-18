<?php

namespace App\Http\Controllers\FrontendUser;
use App\Http\Controllers\Controller;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AttributeOptions;
use App\Models\ProductAttributeValues;

class ProductUserController extends Controller
{
    private $selectedSort = null;

    public function index(Request $request)
    {
        $minPrice = Products::min('price');
        $maxPrice = Products::max('price');

        $products = Products::active();
        $colors = AttributeOptions::whereHas(
			'attribute',
			function ($query) {
					$query->where('code', 'color')
						->where('is_filterable', 1);
			}
		)
        ->orderBy('name', 'asc')->get();
        $sizes = AttributeOptions::whereHas(
			'attribute',
			function ($query) {
				$query->where('code', 'size')
					->where('is_filterable', 1);
			}
        )->orderBy('name', 'asc')->get();
        $categories = Categories::parentCategories()
			->orderBy('name', 'asc')
            ->get();

        $selectedSort = url('products');
        $sorts = [
            url('products') => 'Default',
            url('products?sort=price-asc') => 'Price - Low to High',
            url('products?sort=price-desc') => 'Price - High to Low',
            url('products?sort=created_at-desc') => 'Newest to Oldest',
            url('products?sort=created_at-asc') => 'Oldest to Newest',
        ];

        $products = $this->_searchProducts($products, $request);
        $products = $this->_filterProductsByPriceRange($products, $request);
        $products = $this->_filterProductsByAttribute($products, $request);
        $products = $this->_sortProducts($products, $request);
        $selectedSort = $this->selectedSort;
        $products = $products->paginate(10);

        return view('user.frontend.products.products', compact('products','colors','sizes','minPrice','maxPrice','categories', 'sorts','selectedSort'));
    }

    private function _filterProductsByPriceRange($products, $request)
	{
		$lowPrice = null;
		$highPrice = null;

		if ($priceSlider = $request->query('price')) {
            $prices = explode('-', $priceSlider);

			$lowPrice = (float)$prices[0];
			$highPrice = (float)$prices[1];

			if ($lowPrice && $highPrice) {
				$products = $products->where('price', '>=', $lowPrice)
					->where('price', '<=', $highPrice)
					->orWhereHas(
						'variants',
						function ($query) use ($lowPrice, $highPrice) {
							$query->where('price', '>=', $lowPrice)
								->where('price', '<=', $highPrice);
						}
					);
			}
		}

		return $products;
	}

    private function _searchProducts($products, $request)
	{
		if ($q = $request->query('q')) {
			$q = str_replace('-', ' ', Str::slug($q));

			$products = $products->whereRaw('MATCH(name, slug, short_description, description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);

			$this->data['q'] = $q;
		}

		if ($categorySlug = $request->query('category')) {
			$category = Categories::where('slug', $categorySlug)->firstOrFail();

			$childIds = Categories::childIds($category->id);
			$categoryIds = array_merge([$category->id], $childIds);

			$products = $products->whereHas(
				'categories',
				function ($query) use ($categoryIds) {
					$query->whereIn('categories.id', $categoryIds);
				}
			);
		}

		return $products;
    }

    private function _filterProductsByAttribute($products, $request)
	{
		if ($attributeOptionID = $request->query('option')) {
			$attributeOption = AttributeOptions::findOrFail($attributeOptionID);

			$products = $products->whereHas(
				'ProductAttributeValues',
				function ($query) use ($attributeOption) {
					$query->where('attribute_id', $attributeOption->attribute_id)
						->where('text_value', $attributeOption->name);
				}
			);
		}

		return $products;
    }

    private function _sortProducts($products, $request)
	{
		if ($sort = preg_replace('/\s+/', '', $request->query('sort'))) {
			$availableSorts = ['price', 'created_at'];
			$availableOrder = ['asc', 'desc'];
			$sortAndOrder = explode('-', $sort);

			$sortBy = strtolower($sortAndOrder[0]);
			$orderBy = strtolower($sortAndOrder[1]);

			if (in_array($sortBy, $availableSorts) && in_array($orderBy, $availableOrder)) {
				$products = $products->orderBy($sortBy, $orderBy);
			}

            $this->selectedSort = url('products?sort='. $sort);
		}

		return $products;
	}

    public function show(Products $product)
    {
        if (!$product->configurable()) {
            return view('user.frontend.products.show', compact('product'));
        }

        $colors = ProductAttributeValues::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
        $sizes = ProductAttributeValues::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        return view('user.frontend.products.show', compact('product', 'sizes', 'colors'));
    }

    public function quickView(Products $product)
	{
		if (!$product->configurable()) {
            return view('user.frontend.products.quick_view', compact('product'));
        }

        $colors = ProductAttributeValues::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
        $sizes = ProductAttributeValues::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        return view('user.frontend.products.quick_view', compact('product', 'sizes', 'colors'));
	}
}
