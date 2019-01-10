<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SdeoFamily;
use App\SdeoPerson;

class SdeoController extends Controller
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
     * Show family input form.
     *
     * @return Response
     */
    public function famInp()
    {
        return view('sdeo.match-faminp');
    }

    /**
     * Process a family and get its info.
     *
     * @return Response
     */
    public function processFamInp(Request $request)
    {
		$familyCode = $request->input('family-code');

		$sfamily = SdeoFamily::where('sdeo_family_code', $familyCode)->first();
		$spersons = SdeoPerson::where('sdeo_person_family_code', $familyCode)->get();

        return view('sdeo.match-famres')
		    ->with('sfamily' , $sfamily)
			->with('spersons' , $spersons);
    }
}
