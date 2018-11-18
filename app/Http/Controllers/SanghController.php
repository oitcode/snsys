<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanghController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	/* Only available to logged in users. */
        $this->middleware('auth');
    }

    /**
     * Search for old existing records.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('sangh.family');
    }
}
