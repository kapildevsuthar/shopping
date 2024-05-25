<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','description', 'price','discount','cgst','sgst', 'user_id','net_price'];
  public function categoryids(){
    return $this->hasMany(Product_category::class,'product_id','id');
  }
  public function media(){
    return $this->hasMany(ProductMedia::class,'product_id','id');
  }
}
