<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValues extends Model
{
    use HasFactory;
    protected $table = 'product_attribute_values';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public static function getAttributeOptions($product, $attributeCode)
    {
        $productVariantIDs = $product->variants->pluck('id');
        $attribute = Attributes::where('code', $attributeCode)->first();

        $attributeOptions = ProductAttributeValues::where('attribute_id', $attribute->id)
                            ->whereIn('product_id', $productVariantIDs)
                            ->get();

        return $attributeOptions;
    }
}
