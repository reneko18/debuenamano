<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryInformation extends Model
{
    use HasFactory;


    protected $fillable = [
        'option',
        'region',
        'city',
        'chile_office',
        'address',
        'address_number',
        'dpto_house',
    ];

    protected $table = 'delivery_informations';


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
