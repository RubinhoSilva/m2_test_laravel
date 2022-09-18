<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'active',
        'group_cities_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function groupCities(): BelongsTo
    {
        return $this->belongsTo(GroupCities::class);
    }
}
