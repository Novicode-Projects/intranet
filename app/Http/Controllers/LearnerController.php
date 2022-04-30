<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearnerController extends Controller
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
                'id_learner'=>'required|exists:users,id',
            ]);
    
            Learner::create([
                'id_session'=>$id,
                'id_learner'=>$request->id_learner,
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

            Learner::destroy($id);

            return redirect()->route('session.createSession');
        }
    }
}
