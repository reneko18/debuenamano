<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeFilter extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasMany(Product::class,'age_filter_id','id');
    }
}
