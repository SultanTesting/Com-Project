<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['banner', 'title', 'type', 'starting_price', 'url', 'serial', 'status'];

    public function uploadDate()
    {
        return $this->created_at->diffForHumans();
    }
}
