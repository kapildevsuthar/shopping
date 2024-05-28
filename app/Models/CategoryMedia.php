<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'file_path',
        'file_type',
    ];
    public function media()
    {
        return $this->hasMany(CategoryMedia::class);
    }
}
