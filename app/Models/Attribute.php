<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $hidden = ['pivot'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

}
