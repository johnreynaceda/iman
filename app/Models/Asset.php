<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function requestTransactions()
    {
        return $this->hasMany(RequestTransaction::class);
    }

    public function returnAssets()
    {
        return $this->hasMany(ReturnAsset::class);
    }

    public function borrowedAssets()
    {
        return $this->hasMany(BorrowedAsset::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
}
