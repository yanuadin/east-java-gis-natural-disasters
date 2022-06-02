<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class DisasterModel extends Model
{
    use HasFactory;

    protected $table = 'disasters';
    protected $fillable = ['region_id', 'type_id', 'year', 'amount'];

    public function type(): Relations\BelongsTo
    {
        return $this->belongsTo(TypeOfDisasterModel::class, 'type_id');
    }

    public function region(): Relations\BelongsTo
    {
        return $this->belongsTo(EastJavaRegionModel::class, 'region_id');
    }
}
