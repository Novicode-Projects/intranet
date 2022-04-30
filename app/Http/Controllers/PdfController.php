<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        if (Auth::user()->authorisation == 3) 
            return view('404');

        else {

            $request->validate([
                'url_pdf'=>'required|mimes:pdf',
            ]);
    
            $name = uniqid() . '-' . $_FILES['url_pdf']['name'];
            $request->url_pdf->move(public_path('pdf'), $name);
    
            Pdf::create([
                'id_session'=>$id,
                'url_pdf'=>$name,
            ]);
    
            return redirect()->route('session.editSession', $id); 
        }
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
        if (Auth::user()->authorisation == 3) 
            return view('404');

        else {

            Pdf::destroy($id);
            return redirect()->route('session.createSession');
        }
    }
}
