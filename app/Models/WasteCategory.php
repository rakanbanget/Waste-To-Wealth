<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    protected $fillable = ['name', 'detection_keywords'];
    protected $casts = [
        'detection_keywords' => 'array'
    ];

    public function productIdeas()
    {
        return $this->hasMany(ProductIdea::class);
    }
}