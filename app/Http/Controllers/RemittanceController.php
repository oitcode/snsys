<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\SearchFamilyCode;
use App\Family;
use App\Person;
use App\Oblate;
use App\Worker;

use App\BankVoucher;
use App\Remittance;
use App\RemittanceLine;

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
     * Create a new remittance.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('remittance.create');
    }

    /**
     * Create a bank voucher.
     *
     * @param array bvInfo
     * @param Request request
     *
     * @return object
     */
    public function createBankVoucher($bvInfo, $request)
    {
        $newBv = new BankVoucher;

	$newBv->voucher_number = $bvInfo['bvNum'];
	$newBv->deposit_date = $bvInfo['bvDepositDate'];
	$newBv->deposited_by = $bvInfo['bvDepositor'];
	$newBv->amount = $bvInfo['bvAmount'];
	$newBv->creator_id = $request->user()->id;

	if (! $newBv->save()) {
	/* Todo: Recover from error in someway rather than dryiing */
	    die('Err: Could not insert bank voucher info.');
	}

	return $newBv;
    }


    /**
     * Create a family in database.
     *
     * @param array familyInfo
     * @param Request request
     *
     * @return object
     */
    public function createFamilyInDb($familyInfo, $request)
    {
	echo $familyInfo['familyCode'] 
	     . ': Family does NOT Exist in DB. Creating a family in DB<br />';

        $newFamily = new Family;
        if ($familyInfo['familyCode'] === 'new') {
            /*
            | Todo: Need to lock access to family table. So that
            | other other connection will not allocate same family
            | code.
            */
            $newFamily->family_code = Family::max('family_code') + 1;
        } else {
            $newFamily->family_code = $familyInfo['familyCode'];
        }
        
        $newFamily->address = $familyInfo['familyAddress'];
        $newFamily->creator_id = $request->user()->id;
        
        /* Commit/Store to database */
        if (! $newFamily->save()) {
        /* Todo: Recover from error in someway rather than dryiing */
            die('Could not insert new family to db.');
        }
        
        echo 'Success: Family inesrted in DB. Family code: '
	     . $newFamily->family_code . '<br />';
	return $newFamily;
    }

    /**
     * Process family info.
     *
     * @param array familyInfo
     * @param Request request
     *
     * @return object
     */
    public function processFamily($familyInfo, $request)
    {
	$familyExistsInDb = false;

	/* For a given family code */
	if ($familyInfo['familyCode'] !== 'new') {
	    /* Check if family exists in database. */
            $family = Family::where('family_code', $familyInfo['familyCode'])->first();
	    if ($family) {
	        $familyExistsInDb = true;
	    }
	}

	/* Family not existing in db */
	if ($familyExistsInDb === false) {
	    $family = $this->createFamilyInDb($familyInfo, $request);
	}

	return $family;
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

	/* Todo: Extract middle names too */

	return $names;
    }

    /**
     * Create a person in db.
     *
     * @param string fullName
     *
     * @return object
     */
    public function createPerson($fullName)
    {
	$names = $this->extractNames($fullName);

	$newPerson = new Person;

	$newPerson->first_name = $names['first_name'];
	//$newPerson->middle_name = $names['middle_name'];
	$newPerson->last_name = $names['last_name'];

	$newPerson->creator_id = Auth::user()->id;

        /* Commit/Store to database */
        if (! $newPerson->save()) {
        /* Todo: Recover from error in someway rather than dryiing */
            die('Could not insert new person to db.');
        }

	return $newPerson;
    }

    /**
     * Add oblate to family.
     *
     * @param string oblateName
     * @param object family
     * @param integer ritwikId
     *
     * @return bool
     */
    public function addOblateToFamily($oblateName, $family, $ritwikId = -1)
    {
	$newPerson = $this->createPerson($oblateName);

	$newOblate = new Oblate;

	$newOblate->family_id = $family->family_id;
	$newOblate->person_id = $newPerson->person_id;

	if ($ritwikId === -1) {
	    /**
	     * Todo: Use a programmatically extracted number rather than 3
	     *
	     * This is the case where ritwik is unknow. So one way is to create
	     * a dummy worker and use that worker's id for all oblates with
	     * unknow ritwik.
	     */
	    $newOblate->ritwik_id = 3;
	} else {
	    $newOblate->ritwik_id = $ritwik_id;
	}

	$newOblate->creator_id = Auth::user()->id;

        /* Commit/Store to database */
        if (! $newOblate->save()) {
            /* Todo: Recover from error in someway rather than dryiing */
            die('Could not insert new person to db.');
        } 

	return $newOblate;
    }

    /**
     * Check if oblate exists in family.
     *
     * @param string oblateName
     * @param object family
     *
     * @return bool
     */
    public function oblateInFamily($oblateName, $family)
    {
        $retval = null;

	$oblateNames = $this->extractNames($oblateName);

        if ($family->oblates()->exists()) {
	    /**
	     * There are some oblates in this family. Search if the 
	     * main submitter is present.
	     */
	    foreach ($family->oblates as $oblate) {
                if ($oblateNames['first_name'] === $oblate->person->first_name
		  && 
                  $oblateNames['last_name'] === $oblate->person->last_name) {
		    $retval = $oblate;
		    break;
		}
	    }
	}

	return $retval;
    }

    /**
     * Process main submitter.
     *
     * @param string submitterName
     * @param object family
     * @param Request request
     */
    public function processMainSubmitter($submitterName,
                                         $family,
					 $request)
    {
	$submitter = $this->oblateInFamily($submitterName, $family);

	if ($submitter === null) {
	    /**
	     * Submitter does not exist in this family yet. Add a new one.
	     */
	    $submitter = $this->addOblateToFamily($submitterName, $family);
	}

	return $submitter;
    }

    /**
     * Create remittance.
     *
     * @param array remitInfo
     *
     * @return object
     */
    public function createRemittance($remitInfo)
    {
	$newRemittance = new Remittance;

	$newRemittance->family_id = $remitInfo['family']->family_id;
	$newRemittance->submitter_id = $remitInfo['submitter']->oblate_id;
	$newRemittance->bank_voucher_id = $remitInfo['bv']->bank_voucher_id;

	$newRemittance->submitted_date = $remitInfo['submittedDate'];
	$newRemittance->delivered_by = $remitInfo['deliveredBy'];

	$newRemittance->creator_id = Auth::user()->id;

	/**
	 * Todo: Do not create main remittance now, because, there mayby amount
	 *       mismatch. Just keep the object without saving to db.
	 */
	if (! $newRemittance->save()) {
	    die('Could not insert new remittance to db.');
	}

	return $newRemittance;
    }

    /**
     * Process remittance main info.
     *
     * @param array mainInfo
     * @param Request request
     *
     * @return object
     */
    public function processMainInfo($mainInfo, $request)
    {
	$familyInfo = [
	    'familyCode' => $mainInfo['familyCode'],
	    'familyAddress' => $mainInfo['submitterAddress'],
	];

	$family = $this->processFamily($familyInfo, $request);
	$submitter = 
            $this->processMainSubmitter($mainInfo['submitterName'],
	                                $family,
					$request);

	/* Create remittance now */
	$remittanceCreationInfo = [
	    'bv' => $mainInfo['bv'],
	    'family' => $family,
	    'submitter' => $submitter,
	    'submittedDate' => $mainInfo['submittedDate'],
	    'deliveredBy' => $mainInfo['deliveredBy'],
	];

	$remittance = $this->createRemittance($remittanceCreationInfo);

	return $remittance;
    }


    /**
     * Process remittance lines.
     *
     * @param array remitLines
     * @param object remittance
     *
     * Note: This method does not return anything.
     */
    public function processRemitLines($remitLines, $remittance)
    {
	$family = $remittance->family;

	$i = 0;
        foreach ($remitLines['rlPersonFullNames'] as $rlPersonFullName) {
	    /* Check if oblate present in family. Else add one. */
	    $oblate = $this->oblateInFamily($rlPersonFullName, $family);
	    if ($oblate === null) {
	        $oblate = $this->addOblateToFamily($rlPersonFullName, $family);
	    }

	    /* Create the remittance line with given details. */
            $newRemittanceLine = new RemittanceLine;

	    $newRemittanceLine->swastyayani = $remitLines['rlSwastyayanis'][$i];
	    $newRemittanceLine->istavrity = $remitLines['rlIstavritys'][$i];
	    $newRemittanceLine->acharyavrity = $remitLines['rlAcharyavritys'][$i];
	    $newRemittanceLine->dakshina = $remitLines['rlDakshinas'][$i];
	    $newRemittanceLine->sangathani = $remitLines['rlSangathanis'][$i];
	    $newRemittanceLine->ananda_bazar = $remitLines['rlAnandaBazars'][$i];
	    $newRemittanceLine->pranami = $remitLines['rlPranamis'][$i];
	    $newRemittanceLine->swastyayani_awasista = $remitLines['rlSwastyayaniAwasistas'][$i];
	    $newRemittanceLine->ritwiki = $remitLines['rlRitwikis'][$i];
	    $newRemittanceLine->utsav = $remitLines['rlUtsavs'][$i];
	    $newRemittanceLine->diksha_pranami = $remitLines['rlDikshaPranamis'][$i];
	    $newRemittanceLine->acharya_pranami = $remitLines['rlAcharyaPranamis'][$i];
	    $newRemittanceLine->parivrity = $remitLines['rlParivritys'][$i];
	    $newRemittanceLine->misc = $remitLines['rlMiscs'][$i];

	    $newRemittanceLine->remittance_id = $remittance->remittance_id;
	    $newRemittanceLine->oblate_id = $oblate->oblate_id;
	    $newRemittanceLine->creator_id = Auth::user()->id;

	    if (! $newRemittanceLine->save()) {
	    /* Todo: Recover from error in someway rather than dryiing */
	        die('Could not insert new remittance line to db.');
	    }

	    $i++;
	}
    }

    /**
     * Store the new remittance submitted.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeRemittance(Request $request)
    {
	/*
	|----------------------------------------------------------------------
	| Steps:
	|----------------------------------------------------------------------
	|
	| 1. Validate input data
	| 2. Create bank voucher record
	| 3. If new family, create one.
	|    Else, check if family exists, else create one.
	| 4. Check if main submitter oblate exist in family. Else create one.
	| 5. Create remittance with foreign keys to bank voucher, family and
	|    submitter oblate .
	|
	| By now the main info part is done. Now individual lines need to be
	| stored.
	|
	| 6. Check if individual oblate exists in family. Else create one.
	|    While doing so check if ritwik exists, else create one.
	| 7. Create remittance_line record with foreign keys to remittance
	|    and oblate.
	| 8. Fill in the amounts and save to database.
	|
	| 9. Repeat steps 6-8 for all individual lines.
	|
	*/

	/* Todo: Validate input data */


	/* Get bank voucher input from form */
	$bvInfo = [
	    'bvNum' => $request->input('bv-num'),
	    'bvDepositDate' => $request->input('bv-deposit-date'),
            'bvDepositor' => $request->input('bv-depositor'),
            'bvAmount' => $request->input('bv-amount'),
	];

	/* Get main input from form */
	$mainInfo = [
            'familyCode' => $request->input('family-code'),
            'submitterName' => $request->input('submitter-name'),
            'submitterAddress' => $request->input('submitter-address'),
            'submittedDate' => $request->input('submitted-date'),
            'deliveredBy' => $request->input('delivered-by'),
	];

	/* Get individual input from form */
	$remitLineInfos = [
	    'rlPersonFullNames' => $request->input('person-full-name.*'),
	    'rlRitwikFullNames' => $request->input('ritwik-full-name.*'),
            'rlSwastyayanis' => $request->input('swastyayani.*'),
            'rlIstavritys' => $request->input('istavrity.*'),
            'rlAcharyavritys' => $request->input('acharyavrity.*'),
            'rlDakshinas' => $request->input('dakshina.*'),
            'rlSangathanis' => $request->input('sangathani.*'),
	    'rlAnandaBazars' => $request->input('ananda-bazar.*'),
	    'rlPranamis' => $request->input('pranami.*'),
	    'rlSwastyayaniAwasistas' => $request->input('swastyayani-awasista.*'),
	    'rlRitwikis' => $request->input('ritwiki.*'),
	    'rlUtsavs' => $request->input('utsav.*'),
	    'rlDikshaPranamis' => $request->input('diksha-pranami.*'),
	    'rlAcharyaPranamis' => $request->input('acharya-pranami.*'),
	    'rlParivritys' => $request->input('parivrity.*'),
	    'rlMiscs' => $request->input('misc.*'),
	];


	/**
	 * =====================
	 * Process bank voucher.
	 * =====================
	 */
	$bv = $this->createBankVoucher($bvInfo, $request);
	$mainInfo['bv'] = $bv;


	/**
	 * =======================
	 * Process main/head info.
	 * =======================
	 */
	$remittance = $this->processMainInfo($mainInfo, $request);


	/**
	 *=========================
	 * Process remittance lines
	 *=========================
	 */
	$this->processRemitLines($remitLineInfos, $remittance);

	/* Todo: Correctly show success messsage. */
	$request->session()->flash('status', 'Success: Remittance created!');

        return view('remittance.store-temp');
    }


    /**
     * Search for old existing records.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return view('remittance.search');
    }

    /**
     * Process the search request.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProcess(SearchFamilyCode $request)
    {
	/*
	$validatedData = $request->validate([
	    'family-code' => 'required',
	]);
	*/

	/*
	foreach ($validatedData as $key => $value ) {
	  echo $key . ': ' . $value . '<br />';
	}
	*/

	$familyCode = $request->input('family-code');

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

