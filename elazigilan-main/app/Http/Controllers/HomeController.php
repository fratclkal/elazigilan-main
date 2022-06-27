<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index($order = "newest"){

        if ($order == "newest"){
            $ads = Ad::orderBy('id', 'DESC')->get();
        }else if ($order == "popular"){
            $ads = Ad::orderBy('views', 'DESC')->get();
        }else{
            $ads = Ad::orderBy('id', 'DESC')->get();
        }

        $siteSettings = \App\Models\SiteSettings::all()[0];
        $adsForSwipe = Ad::orderBy('views', 'DESC')->get();
        return view('home.index', compact('ads', 'siteSettings', 'adsForSwipe'));
    }

    function detail($ilan){

        $ad = Ad::find($ilan);
        if (session('ilan'.$ad->id) != true){
            Ad::where('id',$ilan)->update([
                'views' => $ad->views + 1
            ]);
            session(['ilan'.$ad->id => true]);
        }

        return view('home.detail', compact('ad'));
    }

    function search(Request $r){




        if (true){
            $siteSettings = \App\Models\SiteSettings::all()[0];
            $ads = Ad::query()
                ->where('title', 'LIKE', "%".$r->search."%")->get();
            $adsForSwipe = Ad::orderBy('views', 'DESC')->limit(8)->get();
            $ads->appends(['search' => $r->search]);
            return view('home.index', compact('ads', 'siteSettings', 'adsForSwipe'));
        }



    }

}
