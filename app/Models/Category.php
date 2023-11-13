<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'status'];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function activeSubCategory()
    {
        return $this->hasMany(SubCategory::class)->where('status', 'Active');
    }

    public function uploadDate()
    {
        return $this->created_at->diffForHumans();
    }

}
