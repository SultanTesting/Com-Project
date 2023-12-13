<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'name', 'slug', 'category_id', 'sub_category_id', 'child_category_id', 'brand_id', 'thumb_image', 'quantity', 'short_description', 'long_description', 'video_link', 'SKU', 'price', 'offer_price', 'offer_start_date', 'offer_end_date', 'top', 'best', 'featured', 'status', 'approved', 'seo_title', 'seo_description'
    ];

    public function uploadDate()
    {
        return $this->created_at->diffForHumans();
    }
}
