<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use App\Models\Attributes;
use Illuminate\Http\Request;
use App\Models\AttributeOptions;
use App\Models\ProductInventories;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\ProductAttributeValues;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('name', 'ASC')->get();

        return view('frontendadmin.products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('name', 'ASC')->get(['name','id']);
        $types = Products::types();
        $configurable_attributes = $this->_getConfigurableAttributes();

        return view('admin.products.create', compact('categories', 'types', 'configurable_attributes'));
    }

    private function _getConfigurableAttributes()
	{
		return Attributes::where('is_configurable', true)->get();
    }

    private function _generateAttributeCombinations($arrays)
	{
        $result = [[]];
		foreach ($arrays as $property => $property_values) {
            $tmp = [];
			foreach ($result as $result_item) {
				foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
		return $result;
    }

    private function _convertVariantAsName($variant)
	{
		$variantName = '';
		foreach (array_keys($variant) as $key => $code) {
			$attributeOptionID = $variant[$code];
			$attributeOption = AttributeOptions::find($attributeOptionID);

			if ($attributeOption) {
				$variantName .= ' - ' . $attributeOption->name;
			}
		}

		return $variantName;
    }

    private function _saveProductAttributeValues($product, $variant, $parentProductID)
	{
		foreach (array_values($variant) as $attributeOptionID) {
            $attributeOption = AttributeOptions::find($attributeOptionID);

			$attributeValueParams = [
				'parent_product_id' => $parentProductID,
				'product_id' => $product->id,
				'attribute_id' => $attributeOption->attribute_id,
				'text_value' => $attributeOption->name,
			];

			ProductAttributeValues::create($attributeValueParams);
		}
	}

    private function _generateProductVariants($product, $request)
	{
		$configurableAttributes = $this->_getConfigurableAttributes();

		$variantAttributes = [];
		foreach ($configurableAttributes as $attribute) {
            $variantAttributes[$attribute->code] = $request[$attribute->code];
        }

		$variants = $this->_generateAttributeCombinations($variantAttributes);
        // here
		if ($variants) {
			foreach ($variants as $variant) {
				$variantParams = [
					'parent_id' => $product->id,
					'user_id' => Auth::user()->id,
					'sku' => $product->sku . '-' .implode('-', array_values($variant)),
					'type' => 'simple',
					'name' => $product->name . $this->_convertVariantAsName($variant),
				];

				$newProductVariant = Products::create($variantParams);

				$categoryIds = !empty($request['category_id']) ? $request['category_id'] : [];
				$newProductVariant->categories()->sync($categoryIds);

                $this->_saveProductAttributeValues($newProductVariant, $variant, $product->id);
			}
		}
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = DB::transaction(
			function () use ($request) {
				$categoryIds = !empty($request['category_id']) ? $request['category_id'] : [];
				$product = Products::create($request->validated() + ['user_id' => Auth::user()->id]);
				$product->categories()->sync($categoryIds);

				if ($request['type'] == 'configurable') {
					$this->_generateProductVariants($product, $request);
				}
				return $product;
			}
        );

        return redirect()->route('admin.products.edit', $product)->with([
            'message' => 'Berhasil di buat !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        $categories = Categories::orderBy('name', 'ASC')->get(['name','id']);
        $statuses = Products::statuses();
        $types = Products::types();
        $configurable_attributes = $this->_getConfigurableAttributes();

        return view('admin.products.edit', compact('product','categories','statuses','types','configurable_attributes'));
    }

    private function _updateProductVariants($request)
	{
		if ($request['variants']) {
			foreach ($request['variants'] as $productParams) {
				$product = Products::find($productParams['id']);
				$product->update($productParams);

				$product->status = $request['status'];
				$product->save();

				ProductInventories::updateOrCreate(['product_id' => $product->id], ['qty' => $productParams['qty']]);
			}
		}
	}

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Products $product)
    {
        $saved = false;
		$saved = DB::transaction(
			function () use ($product, $request) {
				$categoryIds = !empty($request['category_id']) ? $request['category_id'] : [];
				$product->update($request->validated());
				$product->categories()->sync($categoryIds);

				if ($product->type == 'configurable') {
					$this->_updateProductVariants($request);
				} else {
					ProductInventories::updateOrCreate(['product_id' => $product->id], ['qty' => $request['qty']]);
				}

				return true;
			}
        );

        return redirect()->route('admin.products.index')->with([
            'message' => 'Berhasil di ganti !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        foreach($product->productImages as $productImage) {
            File::delete('storage/' . $productImage->path);
        }
        $product->delete();

        return redirect()->back()->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}

