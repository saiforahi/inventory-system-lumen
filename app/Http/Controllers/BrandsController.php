<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
class BrandsController extends Controller
{
    //
    public function create(Request $request){
        // if(auth()->user()->can('create brand')){
            
        // }
        $this->validate($request,[
            'name'=>'required|string|unique:brands'
        ]);
        $new_brand=Brand::create(['name'=>$request->name]);
        if($new_brand){
            return response()->json(['status'=>true,'message'=>'Brand Created!'],200);
        }
        return response()->json(['status'=>false,'message'=>'Server Error!'],500);
    }

    public function show(){
        return Brand::all();
    }

    public function delete($id){
        if(Brand::find($id)->exists()){
            $deleted=Brand::find($id)->delete();
            if($deleted){
                return response()->json(['status'=>true,'message'=>'Brand deleted'],200);
            }
            return response()->json(['status'=>false,'message'=>'Brand deleted'],500);
        }
        return response()->json(['status'=>false,'message'=>'Brand Not Found'],404);
    }
}
