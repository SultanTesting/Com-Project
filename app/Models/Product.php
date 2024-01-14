<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'name', 'slug', 'category_id', 'sub_category_id', 'child_category_id', 'brand_id', 'thumb_image', 'quantity', 'short_description', 'long_description', 'video_link', 'SKU', 'price', 'offer_price', 'offer_start_date', 'offer_end_date', 'top', 'best', 'featured', 'status', 'approved', 'seo_title', 'seo_description'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function gallery() : HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function items() : HasMany
    {
        return $this->hasMany(ProductVariantItem::class);
    }

    public function variants() : HasMany
    {
        return $this->hasMany(ProductVariants::class);
    }

    public function uploadDate()
    {
        return $this->created_at->diffForHumans();
    }



}
