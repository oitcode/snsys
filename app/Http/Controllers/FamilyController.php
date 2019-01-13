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

        return view('db.person-update')
            ->with('person', $person);
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

        $person->comment = $comment;

        $person->save();

        $request->session()->flash('status', 'Success: Person updated!');
        return redirect('/db/family/' . $familyCode);
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

	    $names['first_name'] = $keywords[0];
	    $names['last_name'] = $keywords[$len-1];
	    $names['middle_name'] = null;

	    if ($len > 2) {
	        $middleNames = array_slice($keywords, 1, $len-2);
	        $names['middle_name'] = implode(' ', $middleNames);
	    }

	    return $names;
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
