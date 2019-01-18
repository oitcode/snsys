<?php

namespace App\Http\Controllers;

use App\Family;
use App\Person;
use App\Oblate;
use App\Worker;

use App\Remittance;
use App\RemittanceLot;
use App\RemittanceLine;


use Illuminate\Http\Request;

class WorkerController extends Controller
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
	 * Display main worker search form.
	 *
	 * @return Response
	 */
	public function mSearch()
	{
		return view('worker.worker-msearch');
	}

	/** 
	 * Process main worker search form.
	 *
	 * @return Response
	 */
	public function mSearchProcess(Request $request)
	{
		// Todo: Input Form Validation

	// $familyCode = $request->input('family-code');
		if ($request->input('worker-name')) {
			return redirect('db/worker/msearch/result');
		    return view('worker.worker-msearch-result');
		} else {
		    return 'Hey this will be out soon!';
		}
	}

	public function mSearchResult()
	{
		return view('worker.worker-msearch-result');
	}
}
