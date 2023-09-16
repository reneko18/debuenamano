<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory;
   
   public function user()
   {       
       return $this->belongsTo(User::class);
   }

   public function category()
   {       
       return $this->belongsTo(Category::class);
   }

   public function status()
   {       
       return $this->belongsTo(StatusProduct::class);
   }

   public function address()
   {
       return $this->hasOne(Address::class);
   }
}
