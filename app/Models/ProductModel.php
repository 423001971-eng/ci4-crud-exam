<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    
    // You must list the columns from your database here:
    protected $allowedFields    = ['title', 'description', 'price', 'stock']; 

    // This handles the created_at and updated_at automatically
    protected $useTimestamps    = true;
}