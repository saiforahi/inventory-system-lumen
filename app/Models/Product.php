<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable=['category_id','brand_id','title','description','sell_price','unit_price','total_price','buy_price','image','capacity','power','voltage','power_source','arrival_date','remaining_quantity','receive_date','purchase_date','location'];
    protected $dates=['receive_date','purchase_date','arrival_date','created_at','updated_at'];
    protected $cast=[];
    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    
}
