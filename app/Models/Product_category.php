<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product_category extends Model
{
    use HasFactory;
    protected $fillable=['product_id','category_id'];
    
}
