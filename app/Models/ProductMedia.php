<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'file_path',
        'file_type',
    ];
    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }
}
