<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'bank',
        'account_number',
        'rut',
        'account_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
