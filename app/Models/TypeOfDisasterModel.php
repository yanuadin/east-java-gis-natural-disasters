<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class TypeOfDisasterModel extends Model
{
    use HasFactory;

    protected $table = 'type_of_disasters';
    protected $fillable = ['name'];

    public function disasters(): Relations\HasMany
    {
        return $this->hasMany(DisasterModel::class, 'type_id');
    }
}
