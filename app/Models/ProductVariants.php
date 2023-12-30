<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariants extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'product_id'];

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function items() : HasMany
    {
        return $this->hasMany(ProductVariantItem::class);
    }

    public function uploadDate()
    {
        return $this->created_at->diffForHumans();
    }
}
