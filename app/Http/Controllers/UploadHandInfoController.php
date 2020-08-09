<?php

namespace App\Http\Controllers;

use App\Hand;
use App\PaieInformation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HandsImport;
<<<<<<< HEAD
=======
use App\Imports\PaieBeneficierImport;
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
use App\Exports\AllHandExport;


class UploadHandInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.upload.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        Excel::import(new HandsImport, $request->file('file'));
        $info = PaieInformation::all();
        foreach($info as $i){
            $i->RIP = str_replace('*','',$i->RIP);
            $i->save();
        }
=======
        if($request->has('file')){
            Excel::import(new HandsImport, $request->file('file'));
        }else if($request->has('paieinfofile')){
            Excel::import(new PaieBeneficierImport, $request->file('paieinfofile'));
        }
        // $info = PaieInformation::all();
        // foreach($info as $i){
        //     $i->RIP = str_replace('*','',$i->RIP);
        //     $i->save();
        // }
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1

        session()->flash('success','Données import avec success');
        
        return redirect('/upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function DownloadUpdate(){
        return Excel::download(new AllHandExport, 'Update Database.xlsx');
    }
}
