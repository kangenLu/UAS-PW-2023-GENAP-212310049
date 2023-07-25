<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['product_ordered', 'quantity', 'price_item', 'total_price', 'total_paid', 'total_unpaid', 'status'];
}
