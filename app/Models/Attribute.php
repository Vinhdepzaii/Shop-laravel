<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    use HasFactory;
    protected $fillable = ['size_name' ,'product_id','quantity'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
