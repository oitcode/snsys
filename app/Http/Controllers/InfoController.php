<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Family;
use App\Remittance;

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
    public function getLatestInfo()
    {
	$maxFamCode = Family::max('family_code');
	$maxSerialNum = Remittance::max('remittance_id');

        return view('info.latest')
	    ->with('maxFamCode', $maxFamCode)
	    ->with('maxSerialNum', $maxSerialNum);
    }
}
