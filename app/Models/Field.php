<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'cover',
        'fixed_price',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(FieldPrice::class, 'field_id', 'id');
    }
}
