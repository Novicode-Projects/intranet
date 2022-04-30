<?php

namespace App\Http\Controllers;

use App\Models\Training_session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
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
        if (Auth::user()->authorisation == 3) 
            return view('404');

        else {

            $sessions = DB::table('training_sessions')
            ->select('training_sessions.id','date_start', 'date_end', 'training_sessions.disable', 'formations.wording AS nameFormation', 'companies.wording AS nameCompany')
            ->join('formations', 'formations.id', '=', 'training_sessions.id_formation')
            ->join('companies', 'companies.id', '=', 'training_sessions.id_company')
            ->orderByDesc('training_sessions.id')
            ->paginate(5);

            $formations = DB::table('formations')
                ->select('*')
                ->orderBy('wording')
                ->paginate(5);

            $companies = DB::table('companies')
                ->select('*')
                ->orderBy('wording')
                ->paginate(5);

            return view('session', compact("sessions", "formations", "companies"));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->authorisation == 3) 
            return view('404');

        else {

            $request->validate([
                'date_start'=>'required|date|max:255',
                'date_end'=>'required|date|max:255',
                'id_formation'=>'required|exists:formations,id',
                'id_company'=>'required|exists:companies,id',
            ]);
    
            Training_session::create([
                'date_start'=>$request->date_start,
                'date_end'=>$request->date_end,
                'id_formation'=>$request->id_formation,
                'id_company'=>$request->id_company,
            ]);
    
            return redirect()->route('session.createSession');
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
        if (Auth::user()->authorisation == 3) 
            return view('404');
            
        else {

            $session = DB::table('training_sessions')
                ->select('training_sessions.id','date_start', 'date_end', 'training_sessions.disable', 'formations.wording AS nameFormation', 'companies.wording AS nameCompany')
                ->join('formations', 'formations.id', '=', 'training_sessions.id_formation')
                ->join('companies', 'companies.id', '=', 'training_sessions.id_company')
                ->where('training_sessions.id', $id)
                ->first();
        
            $pdfs = DB::table('pdfs')
                ->select('pdfs.id', 'url_pdf')
                ->join('training_sessions', 'training_sessions.id', '=', 'pdfs.id_session')
                ->where('id_session', $id)
                ->get();

            $users = DB::table('users')
                ->select('*')
                ->where('authorisation', 3)
                ->orderBy('last_name')
                ->get();

            $learners = DB::table('learners')
                ->select('learners.id', 'first_name', 'last_name')
                ->join('users', 'users.id', '=', 'learners.id_learner')
                ->where('id_session', $id)
                ->where('authorisation', 3)
                ->orderBy('last_name')
                ->get();

            if ($session->disable !== NULL) 
                return redirect()->route('session.createSession');
                
            return view('session-update', compact("session", "users", "pdfs", "learners"));
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
        if (Auth::user()->authorisation == 3) 
            return view('404');

        else {

            $request->validate([
                'date_start'=>'required|date|max:255',
                'date_end'=>'required|date|max:255',
                'id_formation'=>'required|exists:formations,id',
                'id_company'=>'required|exists:formations,id',
            ]);
    
            Training_session::where('id', $request->id)
                ->update([
                    'date_start'=>$request->date_start,
                    'date_end'=>$request->date_end,
                    'id_formation'=>$request->id_formation,
                    'id_company'=>$request->id_company,
            ]);
    
            return redirect()->route('session.createSession');
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
        if (Auth::user()->authorisation == 3) 
            return view('404');

        else {

            Training_session::where('id', $id)
                ->update([
                'disable'=>TRUE,
            ]);

            return redirect()->route('session.createSession');
        }
    }
}
