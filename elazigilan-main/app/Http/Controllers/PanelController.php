<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Attribute;
use App\Models\File;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PanelController extends Controller
{
    function index()
    {
        return view('panel.ads.index');
    }

    function adsFetch()
    {

        $ads = Ad::query();

        return DataTables::of($ads)->addColumn('update', function ($data) {
            return "<button onclick='updateAds(" . $data->id . ")' class='btn btn-warning'>Güncelle</button>";
        })->addColumn('delete', function ($data) {
            return "<button onclick='deleteAds(" . $data->id . ")' class='btn btn-danger'>Sil</button>";
        })->rawColumns(['delete', 'update'])->make();
    }

    function create(Request $request)
    {

        $request->validate([
            'title' => 'required | max:255',
            'ads_content' => 'required',
            'contact' => 'required | max:255'
        ]);


        $newAd = new Ad();
        $newAd->title = $request->title;
        $newAd->description = $request->ads_content;
        $newAd->views = 0;
        $newAd->contact = $request->contact;
        $newAd->is_whatsapp = $request->is_whatsapp;
        $newAd->save();


        for ($i = 1 ; true ; $i++){
            $expertiseOrder = 'attribute_name_'.$i;
            $expertiseVal = 'attribute_value_'.$i;
            if ($request->$expertiseOrder == null){
                break;
            }else{
                $newExpertise = new Attribute();
                $newExpertise->ad_id = $newAd->id;
                $newExpertise->value = $request->$expertiseVal;
                $newExpertise->key = $request->$expertiseOrder;
                $newExpertise->save();
            }
        }




        if ($request->hasFile('contentFiles')) {

            $request->validate([
                'contentFiles.*' => 'mimes:pdf,xls,docx,png,jpg,jpeg'
            ]);


            foreach ($request->file('contentFiles') as $file) {

                $name = time() . rand(0, 1000) . '.' . $file->getClientOriginalName();
                $file->move(public_path() . '/contentFiles/', $name);

                File::create([
                    'path' => $name,
                    'ad_id' => $newAd->id
                ]);

            }

        }

        return response()->json(['Success' => 'success']);

    }

    function delete(Request $request)
    {

        $request->validate([
            'id' => 'distinct'
        ]);


        if (File::where('ad_id', $request->id)->count()>0) {
            foreach (File::where('ad_id', $request->id)->get() as $file){
                unlink(public_path() . '/contentFiles/' . $file->path);
                $file->delete();
            }
        }
        Ad::where('id', $request->id)->delete();

        return response()->json(['Success' => 'success']);
    }

    function get(Request $request)
    {


        $request->validate([
            'id' => 'distinct | required'
        ]);

        $ad = Ad::where('id', $request->id)->first();
        $files = File::where('ad_id', $request->id)->get();


        return response()->json(['is_whatsapp' => $ad->is_whatsapp,'title' => $ad->title, 'content' => $ad->description, 'contact' => $ad->contact, 'files' => $files]);

    }

    function update(Request $request)
    {

        $request->validate([
            'title' => 'required | max:255',
            'ads_content' => 'required',
            'updateId' => 'distinct | required',
        ]);





            $ad = Ad::where('id', $request->updateId)->first();







                Ad::where('id', $request->updateId)->update([
                    'title' => $request->title,
                    'description' => $request->ads_content,
                    'contact' => $request->contact,
                    'is_whatsapp' => $request->is_whatsapp
                ]);




        if ($request->hasFile('contentFiles')) {

            $request->validate([
                'contentFiles.*' => 'mimes:pdf,xls,docx,png,jpg,jpeg'
            ]);

            foreach (File::where('ad_id', $request->updateId)->get() as $file) {

                unlink(public_path() . '/contentFiles/' . $file->path);

            }

            File::where('ad_id', $request->updateId)->delete();


            foreach ($request->file('contentFiles') as $file) {

                $name = time() . rand(0, 1000) . '.' . $file->getClientOriginalName();
                $file->move(public_path() . '/contentFiles/', $name);

                File::create([
                    'path' => $name,
                    'ad_id' => $request->updateId
                ]);

            }

        }


        return response()->json(['Success' => 'success']);
    }

    function update_active()
    {

        $ad = Ad::find(\request('id'));

        $is_active = $ad->is_active;
        if ($is_active == 1) {
            $new_is_active_val = 0;
        } else {
            $new_is_active_val = 1;
        }
        $ad->is_active = $new_is_active_val;
        if ($ad->save()) {
            return response()->json(['Success' => 'success']);

        } else {
            return response()->json(['Error' => 'error']);
        }

    }

    function settings_index()
    {

        $siteSettings = SiteSettings::all()->last();

        if (session('okay')){
            $okay = true;
            session(['okay' => false]);

            return view('panel.settings.index', compact('siteSettings', 'okay'));
        }else{
            return view('panel.settings.index', compact('siteSettings'));
        }


    }

    function settings_update(Request $r)
    {
        $r->validate([
            'title' => 'required',
            'page_title' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($r->hasFile('contentFiles')) {

            $r->validate([
                'contentFiles.*' => 'mimes:png,jpg,jpeg'
            ]);


            foreach ($r->file('contentFiles') as $file) {

                $name = time() . rand(0, 1000) . '.' . $file->getClientOriginalName();
                $file->move(public_path() . '/contentFiles/', $name);

                File::create([
                    'path' => $name,
                    'ad_id' => null,
                    'is_top' => 1
                ]);

            }

        }

        SiteSettings::all()->last()->update([
            'title' => $r->title,
            'page_title' => $r->page_title,
            'tags' => strip_tags($r->tags),
            'description' => strip_tags($r->description)
        ]);
        session(['okay' => true]);
        return redirect()->route('panel.settings.index');
    }
}
