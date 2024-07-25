<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\SiteDataController;


class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sitedctrlr=new SiteDataController();   

        // $langitem = Language::where('status',1)->where('code', $lang)->first();
         $transarr=$sitedctrlr->FillTransData();
         $defultlang=$transarr['langs']->first();
         $lang=$defultlang->code;
        return view('site.client.verify',['defultlang'=>$defultlang,'lang'=>$lang, 'transarr'=>$transarr,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = auth()->guard('client')->user();

        if($request->input('code') == $client->code){

            $client->restCode();
            return redirect()->route('client.account');
        }

        return redirect()->back()->withErrors(['code' => 'verify code incorrect']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
