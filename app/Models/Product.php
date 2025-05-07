<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['value', 'quantity', 'price'];

    public function scopeFilterByAttributes($query, array $filters)
    {
        foreach ($filters as $attributeName => $values) {
            if (!empty($values)) {
                $query->whereHas('attributeOptions', function ($q) use ($attributeName, $values) {
                    $q->whereHas('attribute', function ($q) use ($attributeName) {
                        $q->where('name', $attributeName);
                    })->whereHas('option', function ($q) use ($values) {
                        $q->whereIn('value', (array)$values);
                    });
                });
            }
        }
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'attribute_option');
    }

    public function attributeOptions(): BelongsToMany
    {
        return $this->belongsToMany(AttributeOption::class, 'product_attribute_option');
    }

}
