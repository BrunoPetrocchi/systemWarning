<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCity','description','name','type'
    ];

    public function City(): HasMany
    {
        return $this->hasMany(City::class, 'idCity', 'id');
    }
}
