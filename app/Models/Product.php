<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table="products";
    protected $fillable=['category_id','brand_id','title','description','sell_price','unit_price','total_price','buy_price','image','capacity','power','voltage','power_source','arrival_date','remaining_quantity','receive_date','purchase_date','location'];
    protected $dates=['receive_date','purchase_date','arrival_date','created_at','updated_at'];
    protected $casts = [
        'receive_date' => 'date:Y-m-d',
        'purchase_date' => 'date:Y-m-d',
        'arrival_date' => 'date:Y-m-d',
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];
    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    
}
