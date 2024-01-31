<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory;

   // In your Product model
protected $fillable = [
    'name', 
    'user_id',
    'genre',
    'age_ini',
    'age_date_ini',
    'age_fin',
    'age_date_fin',
    'description',
    'publish_status',
    'selling_status', 
    'product_contacts'
];

   
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

   public function carts()
   {
       return $this->belongsToMany(Cart::class);
   }

   public function productContacts()
   {
       return $this->belongsToMany(ProductContact::class, 'product_contact_product');
   }

   public function order()
   {
       return $this->hasOne(Order::class);
   }

   public function getRouteKeyName()
   {
       return 'slug';
   }
}
