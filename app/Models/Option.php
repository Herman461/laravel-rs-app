<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $hidden = ['pivot'];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }
}
