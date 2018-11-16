<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemittanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Search for old existing records.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('remittance.create');
    }


    /**
     * Search for old existing records.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('remittance.search');
    }
}
