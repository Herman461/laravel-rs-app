<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AttributeOption extends Model
{
    protected $table = 'attribute_option';
    public $timestamps = false;
    protected $hidden = ['pivot', 'attribute_id', 'option_id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_attribute_option');
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }
}
