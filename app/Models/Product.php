<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = [

    ];

    public static function boot(){
        parent::bood();

        static::creating(function($product){
            $product->slug = str_slug($product->title);
        });
    }

    public function category(){
        return $this->hasOne(Category::class);
    }

}
