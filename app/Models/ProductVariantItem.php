<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariantItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_variants_id', 'name', 'price', 'default', 'status'];

    public function variants() : BelongsTo
    {
        return $this->belongsTo(ProductVariants::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
