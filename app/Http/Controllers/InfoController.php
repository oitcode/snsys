<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Family;

class InfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	/* This controller is available only for authenticated users. */
        $this->middleware('auth');
    }

    /**
     * Get maximum family code from database.
     *
     * @return Response
     */
    public function getMaxFamilyCode()
    {
	$maxFamCode = Family::max('family_code');

        return view('info.max-family')
	    ->with('maxFamCode', $maxFamCode);
    }
}
