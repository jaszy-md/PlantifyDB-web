<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'name',
        'information',
    ];

    /**
     * Get all categories associated with the plant.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_plant');
    }
}
