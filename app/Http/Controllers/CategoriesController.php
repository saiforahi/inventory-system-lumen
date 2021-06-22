<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{
    public function create(Request $request){
        // if(auth()->user()->can('create brand')){
            
        // }
        $this->validate($request,[
            'name'=>'required|string|unique:categories'
        ]);
        $new_category=Category::create(['name'=>$request->name]);
        if($new_category){
            return response()->json(['status'=>true,'message'=>'Category Created!'],200);
        }
        return response()->json(['status'=>false,'message'=>'Server Error!'],500);
    }

    public function show(){
        return Category::all();
    }

    public function delete($id){
        if(Category::find($id)->exists()){
            $deleted=Category::find($id)->delete();
            if($deleted){
                return response()->json(['status'=>true,'message'=>'Category deleted'],200);
            }
            return response()->json(['status'=>false,'message'=>'Category deleted'],500);
        }
        return response()->json(['status'=>false,'message'=>'Category Not Found'],404);
    }
}
