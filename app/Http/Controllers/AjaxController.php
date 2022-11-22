<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Division;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(){
        $divisions = Division::all();
        return view('web.pages.auth.ajax.ajax',['divisions'=>$divisions]);
    }

    public function getDistrictsByID($id){
        $districts = Districts::where('division_id',$id)->get();
        return response()->json([
            'districts' => $districts
        ]);
    }

    public function insertDivision(Request $request){
        $division = new Division();
        $division->name = $request->name;
        $division->save();

        return response()->json([
            'division' => $division,
            'error' => false,
        ]);
    }

    public function index2(){
        $divisions = Division::all();
        return view('web.pages.auth.ajax.ajax2',['divisions'=>$divisions]);
    }
}
