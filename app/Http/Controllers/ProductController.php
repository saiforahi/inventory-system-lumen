<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function set_image(Request $request){
        $this->validate($request,[
            'id' => 'required|exists:products',
            'image'=>'required|mimes:jpeg,jpg,png'
        ]);
        $result=Product::find($request->id)->addMedia($request->image)->toMediaLibrary();
        if($result){
            return response()->json(['status'=>true,'message'=>'Image added!'],200);
        }
        else{
            return response()->json(['status'=>false,'message'=>'Internal Server Error'],500);
        }
    }
    public function store(Request $request){
        $this->validate($request,[
            'category'=> 'required|string|exists:categories,id',
            'brand' => 'required|string|exists:brands,id',
            'title' => 'required|string|max:255|unique:products',
            'description' => 'sometimes|nullable',
            'sell_price' => 'sometimes|nullable|string',
            'unit_price' => 'sometimes|nullable|string',
            'buy_price' => 'sometimes|nullable|string',
            'capacity' => 'sometimes|nullable',
            'power' => 'sometimes|nullable',
            'voltage'=>'sometimes|nullable',
            'power_source'=>'sometimes|nullable',
            'quantity' => 'sometimes|nullable|numeric|min:1',
            'receive_date' => 'sometimes|nullable|date|before_or_equal:tomorrow',
            'purchase_date'=> 'sometimes|nullable|date|before_or_equal:receive_date',
            'arrival_date'=>'sometimes|nullable|date|after:purchase_date',
            'location' => 'sometimes|nullable'
        ]);
        $new_product=Product::create([
            'category_id'=> $request->category,
            'brand_id'=> $request->brand,
            'title'=>$request->title,
            'description' => $request->description,
            'sell_price' => (float)$request->sell_price,
            'unit_price' => (float)$request->unit_price,
            'total_price' => (float)$request->unit_price * (float)$request->quantity,
            'buy_price' => $request->buy_price,
            'capacity' => $request->capacity,
            'power' => $request->power,
            'voltage'=>$request->voltage,
            'power_source'=>$request->power_source,
            'arrival_date'=>$request->arrival_date,
            'quantity' => (int)$request->quantity,
            'receive_date' => $request->receive_date,
            'purchase_date'=> $request->purchase_date,
            'location' => $request->location
        ]);
        if($new_product){
            return response()->json(['status'=>true,'message'=>'Product added successfully','data'=>$new_product],200);
        }
        else{
            return response()->json(['status'=>false,'message'=>'Internal Server Error'],500);
        }
    }
    public function all_products(){
        return Product::all();
    }
}
