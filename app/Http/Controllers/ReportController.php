<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\SearchFamilyCode;
use App\Http\Requests\StoreRemit;

use App\Family;
use App\Person;
use App\Oblate;
use App\Worker;

use App\Remittance;
use App\RemittanceLot;
use App\RemittanceLine;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Only for authenticated users.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* Display family code form */
    public function familyInput()
    {
        return view('report.family-inp');
    }

    /* Process the family code */
    public function familyInputProcess(Request $request)
    {
	/* Todo: validate */


        $famCode = $request->input('family-code');

	if (! $this->familyCodeExists($famCode)) {
	   die('Invalid family code ...');
	}

        if (! $this->workerInFamily($famCode)) {
	   die('No worker in family...');
	}

	// $workerId = $this->getWorkerIdFromFamCode($famCode);
	$workerId = 20;

	$worker = Worker::find($workerId);
	$workerOblate = $worker->person->oblate;
	echo "Oblate Id: $workerOblate->oblate_id <br/>";

	$remittanceLines = RemittanceLine::where('oblate_id', $workerOblate->oblate_id)->get();
	if (! $remittanceLines) {
	    echo "No remittance found <br />";
	}

	echo $remittanceLines; 
        return view('report.worker-record')
	    ->with('remittanceLines', $remittanceLines);
    }

    /* Display worker list */
    public function displayWorkerList()
    {
        $workers = Worker::all();

	/* Ignore dummy ritwiks */
        $workers = $workers->except(1);
        $workers = $workers->except(2);
        $workers = $workers->except(3);

	return view('report.display-workers')
	    ->with('workers', $workers);
    }

    /* Check if a given family code exists in DB */
    public function familyCodeExists($famCode)
    {
	/* Todo */
        return true;
    }

    /* Check if a given family code has a worker */
    public function workerInFamily($famCode)
    {
	/* Todo */
        return true;
    }

    /* Get record of a worker */
    public function getWorkerRecord($workerId)
    {
        // Array to hold records
	$record = [];

	// Put the worker in array
	$worker = Worker::find($workerId);
	if (! $worker) {
	    die('Woker not found ...');
	}
	$record['worker'] = $worker;


	// Put the oblate (worker is also an oblate!) in array
	$oblate = $worker->person->oblate;
	$record['oblate'] = $oblate;

	// Put the person in array
	$person = $oblate->person;
	$record['person'] = $person;

	// Put the family in array
	$family = $oblate->family;
	$record['family'] = $family;

	// Put todays date in array
	$todayDate = date('Y-m-d');
	$record['todayDate'] = $todayDate;

	// Put all remittance records in array
	$remittanceLines = RemittanceLine::where('oblate_id', $oblate->oblate_id)->get();
	$record['remittanceLines'] = $remittanceLines;


  // Put istavrity total
  $istavrityTotal = $this->getTotalIstavritySum($remittanceLines);
  $swastyayaniTotal = $this->getTotalSwastyayaniSum($remittanceLines);

  $record['istavrityTotal'] = $istavrityTotal;
  $record['swastyayaniTotal'] = $swastyayaniTotal;

	return view('report.worker-record')
	    ->with('record', $record);
    }

    /* Get sum of all istavrity. */
    public function getTotalIstavritySum($remittanceLines)
    {
        $total = 0;

        foreach ($remittanceLines as $remittanceLine) {
            $total += $remittanceLine->istavrity;   
        }

        return $total;
    }

    /* Get sum of all swastyayani. */
    public function getTotalSwastyayaniSum($remittanceLines)
    {
        $total = 0;

        foreach ($remittanceLines as $remittanceLine) {
            if ($remittanceLine->swastyayani != null) {
                $total += $remittanceLine->swastyayani;   
            }
        }

        return $total;
    }
}
