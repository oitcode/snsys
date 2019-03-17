<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Family;
use App\Person;
use App\Oblate;
use App\Worker;

class FamilyController extends Controller
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
     * Extract first, middle and last names from full name.
     *
     * @param string fullName
     *
     * @return array
     */
    public function extractNames($fullName)
    {
        $keywords = preg_split("/[\s]+/", $fullName);

	$len = count($keywords);

	$names['first_name'] = null;
	$names['middle_name'] = null;
	$names['last_name'] = null;

	/* Has at least one name part */
	if ($len >= 1) {
	    $names['first_name'] = $keywords[0];
	}
	/* Has at least two name part */
	if ($len >= 2) {
	    $names['last_name'] = $keywords[$len-1];
            /* Has middle names too */
	    if ($len > 2) {
	        $middleNames = array_slice($keywords, 1, $len-2);
	        $names['middle_name'] = implode(' ', $middleNames);
	    }

	}

	return $names;
    }

    /**
     * Display a family.
     *
     * @param string famCode
     *
     * @return Response
     */
    public function displayFamily($famCode)
    {
        $family = Family::where('family_code', $famCode)->first();

        return view('db.family')
            ->with('family', $family);
    }

    /**
     * Edit person form page.
     *
     * @param string personId
     *
     * @return Response
     */
    public function editPerson($personId)
    {
        $person = Person::find($personId);

	/* Get ritwik list */
	$ritwiks = Worker::join('person', 'person.person_id', '=', 'worker.person_id')
	    ->orderBy('person.first_name')
	    ->get();

	/* Ignore dummy ritwiks */
        $ritwiks = $ritwiks->except(1);
        $ritwiks = $ritwiks->except(2);
        $ritwiks = $ritwiks->except(3);

        return view('db.person-update')
            ->with('person', $person)
	    ->with('ritwiks', $ritwiks);
    }

    /**
     * Edit person process.
     *
     * @param string personId
     * @param Request request
     *
     * @return Response
     */
    public function editPersonProcess(Request $request)
    {

        $personId = $request->input('person-id');
        $personName = $request->input('person-name');
        $personName = $this->extractNames($personName);
        $familyCode = $request->input('family-code');
        $comment = $request->input('comment');

        $person = Person::find($personId);

        $person->first_name = $personName['first_name'];
        $person->middle_name = $personName['middle_name'];
        $person->last_name = $personName['last_name'];

	/* Update ritwik if needed */
	if ($request->has('change_ritwik')) {
	    $correctRitwik = $request->input('correct_ritwik');

	    /**
	     * Fetch ritwik from DB, if not found, create one.
	     */
	    $ritwikName = $this->extractNames($correctRitwik);
	    $ritwiks = Worker::all()->where('type', 'R');
	    
	    $match = false;
	    $ritwikId = -1;
	    foreach ($ritwiks as $ritwik) {
		$ritwikPerson = Person::find($ritwik->person_id);
			 // Note: Was a nasty performance bug #pb01
			 // very slow time to run
		     // ->where('person_id', $ritwik->person_id)
			 // ->first();

		if ($ritwikPerson->first_name == $ritwikName['first_name']
		  &&
		  $ritwikPerson->middle_name == $ritwikName['middle_name']
		  &&
		  $ritwikPerson->last_name == $ritwikName['last_name']) {
		    $match = true;
	            echo 'Match found<br />';
		    $ritwikId = $ritwik->worker_id;
		    /* Todo: If multiple ritwiks with same name? */
		    break;
		}
	    }

	    /* Ritwik with given name not found */
	    if (! $match) {
	        die ('Whoops! Ritwik not found ...');
	    } else {
		$oblate = $person->oblate;
		$oblate->ritwik_id = $ritwikId;
                $oblate->save();
	    }
	}

        $person->comment = $comment;

        $person->save();

        $request->session()->flash('status', 'Success: Person updated!');
        return redirect('/db/family/' . $familyCode);
    }

    public function famInp()
    {
        return view('db.fam-inp');
    }

    public function famInpProcess(Request $request)
    {
	/* Todo: Validate */

	//
	$family = Family::where('family_code', $request->input('family-code'))->first();


	return $this->famInpResult($family);
    }

    public function famInpResult($family)
    {
	if ($family) {
            return view('db.fam-inp-res')->with('family', $family);
	} else {
            return view('db.fam-inp-res')
	        ->with('errMsg', 'Sorry, no results found !');
	}
    }


}
