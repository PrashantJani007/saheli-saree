<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductPhotos extends Model
{
    use HasFactory;
    public $table='product_photos';
    public $tmiestamps = true;

    protected $fillable = [
        'image',
        'product_id'
    ];

    public function products():BelongsTo
    {
        return $this->belongTo(Product::class,'product_id','id');
    }

}
