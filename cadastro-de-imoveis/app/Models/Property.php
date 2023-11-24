<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['title','code','number_of_rooms','value','construction_date','others','category_id'];

    /**
     * Get the categories that owns the property.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
