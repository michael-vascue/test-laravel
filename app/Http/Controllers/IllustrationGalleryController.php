<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Illustration;
use Illuminate\Support\Facades\DB;

class IllustrationGalleryController extends Controller
{
    public function getIllustrationGallery(){
        $illustrations = Illustration::all();

        $svg_category = Illustration::select('illustrations.category')->groupBy('category')->get();

        // $svg_category = DB::table('illustrations')
        //                 ->groupBy('category')
        //                 ->get();

        return response([
            'illustrations' => $illustrations,
            'svg_category' => $svg_category
        ]);
    }
}
