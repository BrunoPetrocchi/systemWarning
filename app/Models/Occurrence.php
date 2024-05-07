<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCity','idTrash','description','zipcode','street','district','locality','status'
    ];

    public function City(): HasMany
    {
        return $this->hasMany(City::class, 'idCity', 'id');
    }

    public function Trash(): HasMany
    {
        return $this->hasMany(Trash::class, 'idTrash', 'id');
    }
}
