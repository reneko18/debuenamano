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
    'genre',
    'age_ini',
    'age_date_ini',
    'age_fin',
    'age_date_fin',
    'description',
    'category_id',
    'brand',
    'model',
    'height',
    'height_unit',
    'width',
    'width_unit',
    'length',
    'length_unit',
    'weight',
    'weight_unit',
    'status',
    'used_time',
    'used_time_unit',
    'remark',
    'advice',
    'price', 
    'publish_status',
    'selling_status', 
    'admin_status', 
    'visible_status', 
    'payment_status', 
    'sell_date',
    'sku',
    'slug',
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

   public function orders()
   {
       return $this->belongsToMany(Order::class)->withPivot('delivery_price');
   }

   /*Scope Filters*/ 
   public function scopeWithFilters($query, $category_id, $genre, $min_price, $max_price)
    {
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        if ($genre) {
            $query->where('genre', $genre);
        }

        if ($min_price) {
            $query->where('price', '>=', $min_price);
        }

        if ($max_price) {
            $query->where('price', '<=', $max_price);
        }

        return $query;
    }


   public function getRouteKeyName()
   {
       return 'slug';
   }
}
