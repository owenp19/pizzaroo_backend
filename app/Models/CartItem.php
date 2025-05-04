<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'pizza_id',
        'quantity',
    ];
}
