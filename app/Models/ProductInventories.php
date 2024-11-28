<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventories extends Model
{
    use HasFactory;
    protected $table = 'product_inventories';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public static function reduceStock($productId, $qty)
	{
		$inventory = self::where('product_id', $productId)->firstOrFail();

		if ($inventory->qty < $qty) {
			$product = Products::findOrFail($productId);
			throw new \App\Exceptions\OutOfStockException('The product '. $product->sku .' is out of stock');
		}

		$inventory->qty = $inventory->qty - $qty;
		$inventory->save();
	}

	public static function increaseStock($productId, $qty)
	{
		$inventory = self::where('product_id', $productId)->firstOrFail();
		$inventory->qty = $inventory->qty + $qty;
		$inventory->save();
	}
}

