<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['category_id', 'name', 'description', 'sort_order'])]
class SupportingServiceItem extends Model
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(SupportingServiceCategory::class, 'category_id');
    }
}
