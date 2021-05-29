<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MyIllustration;

class MyIllustrationController extends Controller
{
    public function saveIllus(Request $request){

        // foreach($request->data as $data){
        //     $illus = new MyIllustration([
        //         'user_id' => $data['user_id'],
        //         'name' => $data['name'],
        //         'illustration_svg' => $data['illustration_svg']
        //     ]);
        //     $illus->save();
        // }
        // $userId = Auth::user()->id;
        $userId = 1;

        $illus = new MyIllustration();
        $illus->user_id = $userId;
        $illus->name = $request->input('name');
        $illus->illustration_svg = $request->input('illustration_svg');
        $illus->save();

        return $this->success();
    }
}
