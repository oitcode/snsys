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

    /**
     * Process the search request.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProcess(Request $request)
    {
	$familyCode = $request->input('family-Code');
	if (! $familyCode) {
	    echo 'Input Error: Family Code not given ' . '<br />';
	    die();
	    /* Todo: Redirect to some page where the error message is shown */
	}

	$families = \App\Family::all()->where('family_code', $familyCode);
	if (! count($families)) {
	    echo 'Input Error: Family does not exist in database ' . '<br />';
	    die();
	    /* Todo: Redirect to some page where the error message is shown */
	} else if (count($families) != 1){
	    echo 'Input Error: Something wrong!' . '<br />';
	    die();
	    /* Todo: Redirect to some page where the error message is shown */
	    
	} else {
	    foreach ($families as $family) {
	        $family_id = $family->family_id;
	    }
	    $family = \App\Family::find($family_id);
            $remittances = $family->remittances;
	}

        return view('remittance.search-result')
	    ->with('familyCode', $familyCode)
	    ->with('remittances', $remittances);
    }

    /**
     * Get details of a particular remittance.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRmt($remittance_id)
    {
	$remittance = \App\Remittance::find($remittance_id);
        return view('remittance.show-rmt')
	    ->with('remittance', $remittance);
    }
}
