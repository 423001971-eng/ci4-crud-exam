<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'price', 'stock'];
    protected $useTimestamps = true; // manages created_at and updated_at
}