<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class TestController extends Controller
{
    public function test()
    {
        return view('welcome');
    }

    // protected function image($request)
    // {
    //     $img_temp = $request->file('image');
    //     if($img_temp->isValid())
    //     {
    //         // $img_name = $img_temp->getClientOriginalName();
    //         $img_ext = $img_temp->getClientOriginalExtension();
    //         $imageName = rand(123,99999).'.'.$img_ext;
    //         $img_path = public_path('test/'.$imageName);
    //         Image::make($img_temp)->resize(218, 218)->save($img_path);
    //         return $imageName;
    //     }
    // }

    public function store(Request $request)
    {
        $image = $this->image($request);

        return $image;
    }
}
