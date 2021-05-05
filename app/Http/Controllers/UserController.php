<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function storagedoctordocuments(Request $request)
    {
        $input=$request->all();
        if($request->hasFile('document')/*uzantı sorgula*/)
        {
            $destination_path='public/doctors/doctor1';
            $doc=$request->file('document');
            $doc_name=$doc->getClientOriginalName();
            $path=$request->file('document')->storeAs($destination_path,$doc_name);
            $input['document']=$doc_name;
        }
    }

    public function deneme()
    {
        dd(123);
    }

}
