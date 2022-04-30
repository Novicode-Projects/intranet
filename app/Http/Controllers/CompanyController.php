<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
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

            $companies = DB::table('companies')
                ->select('*')
                ->paginate(5);

            return view('company')->with('companies', $companies);
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
                'wording'=>'required|max:255|unique:companies,wording',
                'url_logo' => 'required|mimes:png,jpeg',
            ]);
    
            $name = uniqid() . '-' . $_FILES['url_logo']['name'];
            $request->url_logo->move(public_path('logo'), $name);
    
            Company::create([
                'wording'=>$request->wording,
                'url_logo'=>$name,
            ]);
    
            return redirect()->route('company.createCompany');
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

            $company = DB::table('companies')
            ->select('*')
            ->where('id', $id)
            ->first();

            if ($company === NULL)
                return redirect()->route('company.createCompany');

            if ($company->disable !== NULL) 
                return redirect()->route('company.createCompany');
            
            return view('company-update')->with('company', $company);
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
                'wording'=>'required|max:255',
                'url_logo' => 'required|mimes:png,jpeg',
            ]);
    
            $name = uniqid() . '-' . $_FILES['url_logo']['name'];
            $request->url_logo->move(public_path('logo'), $name);
    
            Company::where('id', $request->id)
                ->update([
                'wording'=>$request->wording,
                'url_logo'=>$name,
            ]);
    
            return redirect()->route('company.createCompany');
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
            
            Company::where('id', $id)
                ->update([
                'disable'=>TRUE,
            ]);

            return redirect()->route('company.createCompany');
        }
    }
}
