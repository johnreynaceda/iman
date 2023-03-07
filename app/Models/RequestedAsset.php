<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedAsset extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function requestTransaction()
    {
        return $this->belongsTo(RequestTransaction::class);
    }
}
