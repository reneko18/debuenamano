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

   public function address()
   {
       return $this->hasOne(Address::class);
   }

   public function galleries()
   {
       return $this->hasMany(ProductGallery::class);
   }

   public function deliveryInformation()
   {
       return $this->hasOne(DeliveryInformation::class);
   }

   public function getRouteKeyName()
   {
       return 'slug';
   }
}
