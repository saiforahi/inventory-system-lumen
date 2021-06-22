<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
class ScheduleController extends Controller
{
    //
    public function create(Request $request){
        $this->validate($request,[
            'title'=>'required|string',
            'agenda' => 'required|string',
            'date' => 'required|date|after:yesterday',
            'time' => 'required',
            'people' => 'sometimes|nullable'
        ]);
        $new_schedule=Schedule::create([
            'title' => $request->title,
            'agenda' => $request->agenda,
            'date' => $request->date,
            'time' => $request->time,
            'people' => json_encode(array($request->people))
        ]);
        if($new_schedule){
            return response()->json(['status'=>true,'message'=>'New Schedule Created'],200);
        }
        else{
            return response()->json(['status'=>false,'message'=>'Internal Server Error'],500);
        }
    }

    public function all(){
        return Schedule::all();
    }
}
