<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIdea extends Model
{
    protected $fillable = [
        'waste_category_id',
        'name',
        'difficulty_level',
        'required_tools',
        'short_description',
        'estimated_time'
    ];

    protected $casts = [
        'required_tools' => 'array'
    ];

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class);
    }
}