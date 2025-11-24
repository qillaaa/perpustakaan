<?php

namespace App\Models\User;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $allowedFields = ['user_id', 'book_id', 'created_at'];
    public $timestamps = false;
}
