<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();

        return response(['partners' => $partners]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $file =  $request->file('logo');
        $path = Storage::putFile('public/files', $file);
        $url = Storage::url($path);


        $partner = new Partner;
        $partner->status = 'active';
        $partner->name = $request->name;
        $partner->logo = $url;
        $partner->save();

        return response(['partner' => $partner]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = Partner::find($id);
        if($partner){
            return response(['partner' => $partner]);
        }else{
            return response(['message' => 'Partner not found'], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $partner = Partner::find($id);
        if($partner){
            $partner->name = $request->name;
            $partner->logo = $request->logo;
            $partner->status = $request->status;
            $partner->save();
            return response(['partner' => $partner]);
        }else{
            return response(['message' => 'Partner not found'], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);

        if($partner){
            $partner->delete();
            return response(['partner' => $partner]);
        }else{
            return response(['message' => 'Partner not found'], 404);
        }
    }
}
