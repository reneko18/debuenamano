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
    'gender_id',
    'age_filter_id',
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

   public function gender()
   {       
       return $this->belongsTo(Gender::class, 'gender_id', 'id');
   }

   public function agefilter()
   {
       return $this->belongsTo(AgeFilter::class,'age_filter_id', 'id');
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
   public function scopeWithFilters($query, $category_id, $gender_id, $min_price, $max_price, $age, $search_query, $order)
    {
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        if ($gender_id) {
            $query->where('gender_id', $gender_id);
        }

        if ($min_price) {
            $query->where('price', '>=', $min_price);
        }

        if ($max_price) {
            $query->where('price', '<=', $max_price);
        }

        if ($age) { 
            $query->where('age_filter_id', $age);
        }

        if ($search_query) { 
            $query->where('name', 'like', '%' . $search_query . '%');
        }

        // Handle the ordering logic
        switch ($order) {
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query;
    }


   public function getRouteKeyName()
   {
       return 'slug';
   }
}
