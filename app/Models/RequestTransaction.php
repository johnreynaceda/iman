<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function requestedAssets()
    {
        return $this->hasMany(RequestedAsset::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
