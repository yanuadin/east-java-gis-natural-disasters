<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class EastJavaRegionModel extends Model
{
    use HasFactory;

    protected $table = 'east_java_regions';
    protected $fillable = ['name'];

    public function disasters(): Relations\HasMany
    {
        return $this->hasMany(DisasterModel::class, 'region_id');
    }
}
