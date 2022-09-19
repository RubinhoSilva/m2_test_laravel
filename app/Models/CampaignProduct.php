<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CampaignProduct extends Pivot
{
    use HasFactory;

    protected $table = 'campaign_product';

    protected $fillable = [
        'campaign_id',
        'product_id',
        'discount'
    ];

    public $timestamps = false;

    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(CampaignProduct::class)->withPivot('discount');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CampaignProduct::class)->withPivot('discount');
    }


}
