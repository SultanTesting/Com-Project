<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'logo', 'featured', 'status'];

    public function uploadDate()
    {
        return $this->created_at->diffForHumans();
    }

    public function product() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
