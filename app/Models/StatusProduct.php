<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusProduct extends Model
{
    use HasFactory;

    protected $table = 'statusproducts';

    public function product()
    {
        return $this->hasMany(Product::class,'status_id','id');
    }
}
