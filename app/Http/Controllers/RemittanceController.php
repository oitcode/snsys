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
	if (session()->has('lot')) {
	    $lotCode = session()->get('lot');
	    $remainingBal = $this->lotRemainingBal($lotCode);
	    /* Todo: check for uniqueness? */
	    $remittanceLot = RemittanceLot::where('lot_code', $lotCode)->first();
	    $bvDepositDate = $remittanceLot->deposit_date;
            return view('remittance.create')
	        ->with('remainingBal', $remainingBal)
	        ->with('bvDepositDate', $bvDepositDate);
	} else {
            return view('remittance.create');
	}
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
        $newBv = new RemittanceLot;

	//$newBv->voucher_number = $bvInfo['bvNum'];
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
     * Create remittance lot.
     *
     * @param array remitLotInfo
     *
     * @return object
     */
    public function createRemitLot($remitLotInfo)
    {
        $newRemitLot = new RemittanceLot;

	/* Todo: Bank voucher number?? */
	//$newRemitLot->voucher_number = $remitLotInfo['bankVoucherNumber'];
	$newRemitLot->deposit_date = $remitLotInfo['bankDepositDate'];
	$newRemitLot->deposited_by = $remitLotInfo['bankDepositedBy'];
	$newRemitLot->amount = $remitLotInfo['bankDepositAmount'];

	$newRemitLot->philanthrophy_deposit_date = $remitLotInfo['phDepositDate'];
	$newRemitLot->philanthrophy_deposited_by = $remitLotInfo['phDepositedBy'];

	$newRemitLot->creator_id = Auth::user()->id;

	/* Todo: Lock table before doing this. */
	$newRemitLot->lot_code = RemittanceLot::max('lot_code') + 1;

	if (! $newRemitLot->save()) {
	/* Todo: Recover from error in someway rather than dryiing */
	    die('Err: Could not insert bank voucher info.');
	}

	return $newRemitLot;
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
	DB::raw('lock tables family write');
        $newFamily = new Family;
        if ($familyInfo['familyCode'] === 'new') {
            /*
            | Todo: Need to lock access to family table. So that
            | other other connection will not allocate same family
            | code.
            */
            $newFamily->family_code = Family::max('family_code') + 1;
        } else {

	    /* Get first 9 digits of fam code. */
	    $tenDFamCode = $familyInfo['familyCode'];
	    $nineDFamCode = substr($tenDFamCode, 0, 9);
	    $checkDigit = substr($tenDFamCode, 9, 1);

            $newFamily->family_code = $nineDFamCode;
            $newFamily->fcode_check_digit = $checkDigit;
        }
        
        $newFamily->address = $familyInfo['familyAddress'];
        $newFamily->creator_id = $request->user()->id;
        
        /* Commit/Store to database */
        if (! $newFamily->save()) {
        /* Todo: Recover from error in someway rather than dryiing */
            die('Could not insert new family to db.');
        }
        
	DB::raw('unlock tables');
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

	    /* Get first 9 digits of fam code. */
	    $tenDFamCode = $familyInfo['familyCode'];
	    $nineDFamCode = substr($tenDFamCode, 0, 9);

	    /* Check if family exists in database. */
            $family = Family::where('family_code', $nineDFamCode)->first();
	    if ($family) {
	        $familyExistsInDb = true;
	    }
	}

	/**
	 * Family code ending in 'N' does not exist in DB.
	 * It should not be happening.
         */
	if ($familyInfo['familyCode'] !== 'new'
	    && substr($tenDFamCode, 9, 1) === 'N'
	    && $familyExistsInDb === false) {
	    /* Todo: Do sth instead of dying. */
	    die("Error: 'N' family code not existing in DB");
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
	$names['middle_name'] = null;

	if ($len > 2) {
	    $middleNames = array_slice($keywords, 1, $len-2);
	    $names['middle_name'] = implode(' ', $middleNames);
	}

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
	$newPerson->middle_name = $names['middle_name'];
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
	    $newOblate->ritwik_id = $ritwikId;
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
                  $oblateNames['middle_name'] === $oblate->person->middle_name
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
	$newRemittance->remittance_lot_id = $remitInfo['bv']->remittance_lot_id;

	$newRemittance->submitted_date = $remitInfo['submittedDate'];

	$newRemittance->creator_id = Auth::user()->id;

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
	];

	$remittance = $this->createRemittance($remittanceCreationInfo);

	return $remittance;
    }

    /**
     * Multiply remittance lines for multiple months.
     *
     * @param array remitLines
     *
     * @return array
     */
    public function multiMonths($remitLines, $forMonths)
    {
	$i = 0;
        foreach ($remitLines as $remitLine) {
	    /**
	     * Todo: using of $i in the loop condition itself would look more
	     *       natural. 
             */
	    $remitLines[$i]['swastyayani'] *= $forMonths;
	    $remitLines[$i]['istavrity'] *= $forMonths;
	    $remitLines[$i]['acharyavrity'] *= $forMonths;
	    $remitLines[$i]['dakshina'] *= $forMonths;
	    $remitLines[$i]['sangathani'] *= $forMonths;
	    $remitLines[$i]['ananda-bazar'] *= $forMonths;
	    $remitLines[$i]['pranami'] *= $forMonths;
	    $remitLines[$i]['swastyayani-awasista'] *= $forMonths;
	    $remitLines[$i]['ritwiki'] *= $forMonths;
	    $remitLines[$i]['utsav'] *= $forMonths;
	    $remitLines[$i]['diksha-pranami'] *= $forMonths;
	    $remitLines[$i]['acharya-pranami'] *= $forMonths;
	    $remitLines[$i]['parivrity'] *= $forMonths;
	    $remitLines[$i]['misc'] *= $forMonths;

	    $i++;
	}

	return $remitLines;
    }

    /**
     * Convert currency of remittance lines.
     *
     * @param array remitLines
     *
     * @return array
     */
    public function currencyConvert($remitLines)
    {
	$i = 0;
        foreach ($remitLines as $remitLine) {
	    /**
	     * Todo: using of $i in the loop condition itself would look more
	     *       natural. 
             */
	    $remitLines[$i]['swastyayani'] *= 1.6;
	    $remitLines[$i]['istavrity'] *= 1.6;
	    $remitLines[$i]['acharyavrity'] *= 1.6;
	    $remitLines[$i]['dakshina'] *= 1.6;
	    $remitLines[$i]['sangathani'] *= 1.6;
	    $remitLines[$i]['ananda-bazar'] *= 1.6;
	    $remitLines[$i]['pranami'] *= 1.6;
	    $remitLines[$i]['swastyayani-awasista'] *= 1.6;
	    $remitLines[$i]['ritwiki'] *= 1.6;
	    $remitLines[$i]['utsav'] *= 1.6;
	    $remitLines[$i]['diksha-pranami'] *= 1.6;
	    $remitLines[$i]['acharya-pranami'] *= 1.6;
	    $remitLines[$i]['parivrity'] *= 1.6;
	    $remitLines[$i]['misc'] *= 1.6;

	    $i++;
	}

	return $remitLines;
    }

    /**
     * Create a new ritwik.
     *
     * @param array ritwikName
     *
     * @return object
     */
    public function createRitwik($ritwikName)
    {
        $newPerson = new Person;

	$newPerson->first_name = $ritwikName['first_name'];
	if ($ritwikName['middle_name'] !== null) {
	    $newPerson->middle_name = $ritwikName['middle_name'];
	}
	$newPerson->last_name = $ritwikName['last_name'];
	$newPerson->creator_id = Auth::user()->id;
	$newPerson->save();


	$newRitwik = new Worker;

	$newRitwik->person_id = $newPerson->person_id;
	$newRitwik->worker_code = 'N00001';
	$newRitwik->type = 'R';
	$newRitwik->creator_id = Auth::user()->id;
	$newRitwik->save();

	$newOblate = new Oblate;
        /* Todo: 49? Need a constant? */
        /* Update: Use 3 for live */
	$newOblate->family_id = 3;
	$newOblate->person_id = $newPerson->person_id;
        /* Todo: 3? Need a constant? */
	$newOblate->ritwik_id = 3;
	$newOblate->creator_id = Auth::user()->id;
	$newOblate->save();

	return $newRitwik;
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

        foreach ($remitLines as $remitLine) {
	    /* Todo: Handle blank rows more appropriately */
	    if ($remitLine['name'] === null) {
	        continue;
	    }

	    /**
	     * Fetch ritwik from DB, if not found, create one.
	     */
	    $ritwikName = $this->extractNames($remitLine['ritwik-name']);
	    $ritwiks = Worker::all()->where('type', 'R');
	    
	    $match = false;
	    $ritwikId = -1;
	    foreach ($ritwiks as $ritwik) {
		$person = Person::all()
		          ->where('person_id', $ritwik->person_id)
			  ->first();

		if ($person->first_name == $ritwikName['first_name']
		  &&
		  $person->middle_name == $ritwikName['middle_name']
		  &&
		  $person->last_name == $ritwikName['last_name']) {
		    $match = true;
	            echo 'Match found<br />';
		    $ritwikId = $ritwik->worker_id;
		    /* Todo: If multiple ritwiks with same name? */
		    break;
		}
	    }

	    /* Ritwik with given name not found */
	    if (! $match) {
	        echo 'Creating new ritwik<br />';
	        $newRitwik= $this->createRitwik($ritwikName);
		$ritwikId = $newRitwik->worker_id;
	    }

            
	    /* Check if oblate present in family. Else add one. */
	    $oblate = $this->oblateInFamily($remitLine['name'], $family);
	    if ($oblate === null) {
	        $oblate = $this->addOblateToFamily($remitLine['name'],
		                                   $family,
					           $ritwikId);
	    } else {
	        /**
	         * Oblate present in family. But still check if it has a 
	         *  dummy ritwik
	         */
		 /* Todo: URGETN: Ritwik id 3? In Live? */
		 if ($oblate->ritwik_id == 3) {
		     $oblate->ritwik_id = $ritwikId;
		     $oblate->save();
		 }
	    }

	    /* Create the remittance line with given details. */
            $newRemittanceLine = new RemittanceLine;

	    $newRemittanceLine->swastyayani = $remitLine['swastyayani'];
	    $newRemittanceLine->istavrity = $remitLine['istavrity'];
	    $newRemittanceLine->acharyavrity = $remitLine['acharyavrity'];
	    $newRemittanceLine->dakshina = $remitLine['dakshina'];
	    $newRemittanceLine->sangathani = $remitLine['sangathani'];
	    $newRemittanceLine->ananda_bazar = $remitLine['ananda-bazar'];
	    $newRemittanceLine->pranami = $remitLine['pranami'];
	    $newRemittanceLine->swastyayani_awasista = $remitLine['swastyayani-awasista'];
	    $newRemittanceLine->ritwiki = $remitLine['ritwiki'];
	    $newRemittanceLine->utsav = $remitLine['utsav'];
	    $newRemittanceLine->diksha_pranami = $remitLine['diksha-pranami'];
	    $newRemittanceLine->acharya_pranami = $remitLine['acharya-pranami'];
	    $newRemittanceLine->parivrity = $remitLine['parivrity'];
	    $newRemittanceLine->misc = $remitLine['misc'];

	    $newRemittanceLine->remittance_id = $remittance->remittance_id;
	    $newRemittanceLine->oblate_id = $oblate->oblate_id;
	    $newRemittanceLine->creator_id = Auth::user()->id;

	    if (! $newRemittanceLine->save()) {
	    /* Todo: Recover from error in someway rather than dryiing */
	        die('Could not insert new remittance line to db.');
	    }
	}
    }

    /**
     * Process remittance lines.
     *
     * @param array remitLines
     * @param object remittance
     *
     * Note: This method does not return anything.
     */
    public function processRemitLinesBak($remitLines, $remittance)
    {
	$family = $remittance->family;

        foreach ($remitLines as $remitLine) {
	    /* Todo: Handle blank rows more appropriately */
	    if ($remitLine['name'] === null) {
	        continue;
	    }

	    /* Check if oblate present in family. Else add one. */
	    $oblate = $this->oblateInFamily($remitLine['name'], $family);
	    if ($oblate === null) {
	        $oblate = $this->addOblateToFamily($remitLine['name'], $family);
	    } 

	    /* Create the remittance line with given details. */
            $newRemittanceLine = new RemittanceLine;

	    $newRemittanceLine->swastyayani = $remitLine['swastyayani'];
	    $newRemittanceLine->istavrity = $remitLine['istavrity'];
	    $newRemittanceLine->acharyavrity = $remitLine['acharyavrity'];
	    $newRemittanceLine->dakshina = $remitLine['dakshina'];
	    $newRemittanceLine->sangathani = $remitLine['sangathani'];
	    $newRemittanceLine->ananda_bazar = $remitLine['ananda-bazar'];
	    $newRemittanceLine->pranami = $remitLine['pranami'];
	    $newRemittanceLine->swastyayani_awasista = $remitLine['swastyayani-awasista'];
	    $newRemittanceLine->ritwiki = $remitLine['ritwiki'];
	    $newRemittanceLine->utsav = $remitLine['utsav'];
	    $newRemittanceLine->diksha_pranami = $remitLine['diksha-pranami'];
	    $newRemittanceLine->acharya_pranami = $remitLine['acharya-pranami'];
	    $newRemittanceLine->parivrity = $remitLine['parivrity'];
	    $newRemittanceLine->misc = $remitLine['misc'];

	    $newRemittanceLine->remittance_id = $remittance->remittance_id;
	    $newRemittanceLine->oblate_id = $oblate->oblate_id;
	    $newRemittanceLine->creator_id = Auth::user()->id;

	    if (! $newRemittanceLine->save()) {
	    /* Todo: Recover from error in someway rather than dryiing */
	        die('Could not insert new remittance line to db.');
	    }
	}
    }


    /**
     * Verify total amount.
     *
     * @param decimal submittedTotal
     * @param array remitLines
     *
     * @return bool
     */
    public function verifyTotal($submittedTotal, $remitLines)
    {
	echo 'Verifying total:' . $submittedTotal . '<br />';

	$retval = false;

	$actualTotal = 0;

	$i = 0;
        foreach ($remitLines['rlPersonFullNames'] as $rlPersonFullName) {
	    /* Todo: Handle blank rows more appropriately */
	    if ($rlPersonFullName === null) {
	        continue;
	    }

	    $actualTotal += $remitLines['rlSwastyayanis'][$i];
	    $actualTotal += $remitLines['rlIstavritys'][$i];
	    $actualTotal += $remitLines['rlAcharyavritys'][$i];
	    $actualTotal += $remitLines['rlDakshinas'][$i];
	    $actualTotal += $remitLines['rlSangathanis'][$i];
	    $actualTotal += $remitLines['rlAnandaBazars'][$i];
	    $actualTotal += $remitLines['rlPranamis'][$i];
	    $actualTotal += $remitLines['rlSwastyayaniAwasistas'][$i];
	    $actualTotal += $remitLines['rlRitwikis'][$i];
	    $actualTotal += $remitLines['rlUtsavs'][$i];
	    $actualTotal += $remitLines['rlDikshaPranamis'][$i];
	    $actualTotal += $remitLines['rlAcharyaPranamis'][$i];
	    $actualTotal += $remitLines['rlParivritys'][$i];
	    $actualTotal += $remitLines['rlMiscs'][$i];

	    $i++;
	}

	if ($actualTotal == $submittedTotal) {
	    echo 'Actual equal total';
	    $retval = true;
	} else if ($actualTotal > $submittedTotal) { 
	    // Todo: Set appropriate error message in session
	    echo 'Actual more than total';
	    //return Redirect::back() ->withInput() ->withErrors('Actual more than total');
	} else {
	    // Todo: Set appropriate error message in session
	    echo 'Actual less than total';
	    //return Redirect::back() ->withInput() ->withErrors('Actual less than total');
	}

	return $retval;
    }

    /**
     * Validate remit lines.
     *
     * @param array remitLines
     *
     * @return array
     */
    public function validateRemitLines($remitLines)
    {
        $amountPattern = '/^[0-9]+(\.[0-9]{1,2})?$/';
	$namePattern = '/^[a-zA-Z]+[\s]+[a-zA-Z]+([\s]+[a-zA-Z]+){0,}$/';

        foreach ($remitLines as $remitLine) {
	   /* Todo: Handle blank rows more appropriately */
	   if ($remitLine['name'] === null) {
	       continue;
	   }

	   /* Validate name */
	   if (! preg_match($namePattern, $remitLine['name'])) {
	     return false;
	   }

	   /* Validate ritwik name */
	   if (! preg_match($namePattern, $remitLine['ritwik-name'])) {
	     return false;
	   }

	   /* Validate each data */
	   if ($remitLine['swastyayani'] &&
	       ! preg_match($amountPattern, $remitLine['swastyayani'])) {
	     return false;
	   }
	   if (! preg_match($amountPattern, $remitLine['istavrity'])) {
	       return false;
	   }
	   if ($remitLine['acharyavrity'] &&
	       ! preg_match($amountPattern, $remitLine['acharyavrity'])) {
	       return false;
	   }
	   if ($remitLine['dakshina'] &&
	       ! preg_match($amountPattern, $remitLine['dakshina'])) {
	       return false;
	   }
	   if ($remitLine['sangathani'] &&
	       ! preg_match($amountPattern, $remitLine['sangathani'])) {
	       return false;
	   }
	   if ($remitLine['ananda-bazar'] &&
	       ! preg_match($amountPattern, $remitLine['ananda-bazar'])) {
	       return false;
	   }
	   if ($remitLine['pranami'] &&
	       ! preg_match($amountPattern, $remitLine['pranami'])) {
	       return false;
	   }
	   if ($remitLine['swastyayani-awasista'] &&
	       ! preg_match($amountPattern, $remitLine['swastyayani-awasista'])) {
	       return false;
	   }
	   if ($remitLine['ritwiki'] &&
	       ! preg_match($amountPattern, $remitLine['ritwiki'])) {
	       return false;
	   }
	   if ($remitLine['utsav'] &&
	       ! preg_match($amountPattern, $remitLine['utsav'])) {
	       return false;
	   }
	   if ($remitLine['diksha-pranami'] &&
	       ! preg_match($amountPattern, $remitLine['diksha-pranami'])) {
	       return false;
	   }
	   if ($remitLine['acharya-pranami'] &&
	       ! preg_match($amountPattern, $remitLine['acharya-pranami'])) {
	       return false;
	   }
	   if ($remitLine['parivrity'] &&
	       ! preg_match($amountPattern, $remitLine['parivrity'])) {
	       return false;
	   }
	   if ($remitLine['misc'] &&
	       ! preg_match($amountPattern, $remitLine['misc'])) {
	       return false;
	   }
	}

	return true;
    }

    /**
     * Validate family code submitted by user.
     *
     * @param string formFamCode
     *
     * @return bool
     */
    public function validateFormFamilyCode($formFamCode)
    {
	$formFamCode = (string) $formFamCode;

	/* Return true if it is new */
	if ($formFamCode === 'new') {
	    return true;
	}

	/* Check it is of 10 characters */
	if (strlen($formFamCode) !== 10) {
	    echo "Err: Family code not 10 characers.<br />";
	    return false;
	}

	/* Standard regex match  (very loose/permissive check) */
	$famCodeLoosePattern = '/^(4700[0-9]{6,6}|4700[0-9]{5,5}N)$/';
	if (! preg_match($famCodeLoosePattern, $formFamCode)) {
	    echo "Err: Family code not 'new' OR 4700*****(*/N).<br />";
	    return false;
	}

	/* Get first 9 digits of fam code. */
	$nineDFamCode = substr($formFamCode, 0, 9);
	$nineDFamCode = (int) $nineDFamCode;

	/**
	 * For family codes with N at the end, check that these
	 * are in the range actually given by Satsang Nepal.
	 *
	 * Also check that it is already present in database.
	 */
	if (substr($formFamCode, 9, 1) === 'N') {
	    if ($nineDFamCode < 470026201) {
	        echo "Err: Satsang NEPAL Family code but in old range.<br />";
	        return false;
	    }

	    $famInDb = \App\Family::where('family_code', $nineDFamCode)->first();
	    if (! $famInDb) {
	        echo "Err: Satsang NEPAL Family code but does not exits in DB.<br />";
	        return false;
	    }
	} else {
	    /**
	     * These are family codes given by Satsang Deoghar.
	     * Do appropriate checks.
	     */
	    if ($nineDFamCode > 470026154) {
	        echo "Err: Satsang DEOGHAR Family code but over range.<br />";
	        return false;
	    }

	    /* If family code in database, then make sure check digit matches. */
	    /**
	     * Todo: Calculate check digit on actual logic rather than db
	     *       saved value.
             */
	    $famInDb = \App\Family::where('family_code', $nineDFamCode)->first();
	    if ($famInDb) {
	        if ($famInDb->fcode_check_digit !==  substr($formFamCode, 9, 1)) {
	            echo "Err: Satsang DEOGHAR Family code check digit mismatch.<br />";
		    return false;
		}
	    }
	}

	return true;
    }

    /**
     * Validate data received in remittance creation form.
     *
     * @param Request request
     *
     * @return bool
     */
    public function validateRemitCreateData(Request $request)
    {
	$currencyPattern = '/^(nc|ic)$/';

	$namePattern = '/^[a-zA-Z]+[\s]+[a-zA-Z]+([\s]+[a-zA-Z]+){0,}$/';

	$familyCodePattern = '/^(new|4700[0-9]{6,6}|4700[0-9]{5,5}N)$/';

	/* Validate family code */
	$formFamCode = $request->input('family-code');
	if ($this->validateFormFamilyCode($formFamCode) == false) {
	    echo "Error: Invalid family code: $formFamCode <br />";
	    /* Todo: Redirect back with appropriate error message instead of dying. */
	    die("FAIL:: Family code validation failed.<br/>");
	    return false;
	}

	/* Validate currency */
	$validatedCurrencyData = $request->validate([
	    'currency' => array('required',  'regex:' . $currencyPattern),
	]);

	/* Validate bank voucher data */
	if (! session()->has('lot')) {
	    echo 'Validating BV data<br />';
	    $validatedBvData = $request->validate([
		/* Todo: What about bank voucher number? */
	        //'bv-num' => 'nullable|integer',
	        'bv-deposit-date' => 'required|date',
	        'bv-depositor' => array('required', 'regex:' . $namePattern),
	        'bv-amount' => 'required|integer',
	    ]);
	}

	echo('BV validation done<br/>');

	/* Validate main info data */
	echo 'Validating MI data<br />';
	$validatedMainData = $request->validate([
	    'family-code' => array('required', 'regex:' . $familyCodePattern),
	    'submitter-name' => array('required', 'regex:' . $namePattern),
	    /* Todo: Validate it is in correct address format*/
	    'submitter-address' => 'required',
	    'submitted-date' => 'required|date',
	    'submitted-total' => 'required|integer',
	]);
	echo('MI validation done<br/>');


	/* Validate remit lines info data */
	echo 'Validating RL data<br />';
	$remitLines = $request->input('remit-row');
	if (! $this->validateRemitLines($remitLines)) {
	    /* Todo: Put appropriate error message */
	    return false;
	}
	echo('RL validation done<br/>');

	/**
	 * If this statement is executed that means all validations were
	 * passed.
	 */
	return true;
    }


    /**
     * Store the new remittance submitted.
     *
     * @return \Illuminate\Http\Response
     */
    //public function storeRemittance(StoreRemit $request)
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


        if (! $this->validateRemitCreateData($request)) {
	    /**
	     * Todo: If this statement executed then it means that remittance
	     *       line validation failed.
             */
	    return redirect()->back()->withInput()
	        ->withErrors('Non valid line data');
	}

	/* Validate that given amount is within bank voucher consumption.*/
	if (session()->has('lot')) {
	    $rl = RemittanceLot::where('lot_code', session()->get('lot'))
	          ->first();
            $rlId = $rl->remittance_lot_id;
	    echo ("Rmittance lot id: $rlId<br/>");

	    $checkAmount = $request->input('submitted-total');
	    if ($request->input('currency') == 'ic') {
	        $checkAmount *= 1.6;
	    }
	    if (! $this->checkBvSpace($rlId, $checkAmount)) {
	        return redirect()->back()->withInput()
	            ->withErrors('Error: Total exceeds amount in Bank Voucher');
	    }
	} else {
	    // Todo: For non-lot remittances
	}

	/* Get currency info */
	$currency = $request->input('currency');

	/* Get bank voucher input from form */
	if (! session()->has('lot')) {
	    $bvInfo = [
	        //'bvNum' => $request->input('bv-num'),
	        'bvDepositDate' => $request->input('bv-deposit-date'),
                'bvDepositor' => $request->input('bv-depositor'),
                'bvAmount' => $request->input('bv-amount'),
	    ];
	}


	/* Get main input from form */
	$mainInfo = [
            'familyCode' => $request->input('family-code'),
            'submitterName' => $request->input('submitter-name'),
            'submitterAddress' => $request->input('submitter-address'),
            'submittedDate' => $request->input('submitted-date'),
            'submittedTotal' => $request->input('submitted-total'),
            'deliveredBy' => $request->input('delivered-by'),
	];


	/* Get individual input from form */
	$remitLines = $request->input('remit-row');


	/**
	 * =====================
	 * Verify Total.
	 * =====================
	 */
	/*
	$totalOk =
	    $this->verifyTotal($mainInfo['submittedTotal'], $remitLineInfos);
	if (! $totalOk) {
	    // Todo: Go back with input intact.
	    echo 'Total not Ok';
	    return Redirect::back()->withInput()->withErrors('Total mismatch');
	}
	die();
	*/


	/**
	 * =====================
	 * Process bank voucher.
	 * =====================
	 */
	if (session()->has('lot')) {
	  $lotCode = session()->get('lot');
	  $bv = RemittanceLot::where('lot_code', $lotCode)->first();
	} else {
	  $bv = $this->createBankVoucher($bvInfo, $request);
	}
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
	$forMonths = (int) $request->input('for-months');
	if ($forMonths > 1) {
	    $remitLines = $this->multiMonths($remitLines, $forMonths);
	}
	if ($currency === 'ic') {
	    $remitLines = $this->currencyConvert($remitLines);
	}
	$adjustVal = (float) $request->input('adjust-val');
	if ($adjustVal > 0 && count($remitLines) > 0) {
	    $remitLines[0]['pranami'] += $adjustVal;
	}
	$this->processRemitLines($remitLines, $remittance);

	$request->session()->flash('status', 'Success: Remittance created!');
	$request->session()->flash('serialNum', $remittance->remittance_id);
	$request->session()->flash('familyCode', $remittance->family->family_code);

        return redirect('/rmt/create/success');
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
     * Search by lot number.
     *
     * @param string lotNumber
     *
     * @return array
     */
    public function searchByLot($lotNumber)
    {
	$lot = RemittanceLot::where('lot_code', $lotNumber)->first();

	if (!$lot) {
	    /* Todo: redirect back with error message */
	    die("Lot: $lotNumber not found");;
	}

	$remittances = $lot->remittances;

        return $remittances;
    }

    /**
     * Process the search request.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProcess(Request $request)
    {
	$validatedData = $request->validate([
	    'family-code' => 'nullable|integer',
	    /* Todo: Validate it is in correct name format*/
	    //'submitter-name' => 'nullable|alpha'
	    'serial-num' => 'nullable|integer',
	    'submit-date' => 'nullable|date',
	    /* Todo: Validate it is in correct name format*/
	    //'delivered-by' => 'nullable|alpha'
	    'lot-num' => 'nullable|integer',
	]);


	/* Todo: Use data from $validatedData or $request->input ? */
	/*
	foreach ($validatedData as $key => $value ) {
	  echo $key . ': ' . $value . '<br />';
	}
	*/

	$familyCode = $request->input('family-code');
	$lotNumber = $request->input('lot-num');
	$serialNum = $request->input('serial-num');

	/* Todo: Switch between different cases nicely! */
	if ($lotNumber) {
	    $remittances = $this->searchByLot($lotNumber);
            return view('remittance.search-result')
	        ->with('remittances', $remittances);
	} else if ($serialNum) {
	    $remittances = Remittance::where('remittance_id', $serialNum)->get();
            return view('remittance.search-result')
	        ->with('remittances', $remittances);
	}

	if (! $familyCode) {
	    /* Todo */
	    die('Whops! Give family code');
            $remittances = \App\Remittance::order_by('created_time', 'desc')->take(10);
            return view('remittance.search-result')
	        ->with('remittances', $remittances);
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
	$remTotal = $this->remTotalAmount($remittance);

        return view('remittance.show-rmt')
	    ->with('remittance', $remittance)
	    ->with('remTotal', $remTotal);
    }

    /**
     * Create a new lot.
     *
     * @return \Illuminate\Http\Response
     */
    public function createLot(Request $request)
    {
	/* Todo: Validate data */

	/* Get the input data */

	$remitLotInfo = [
	    'bankDepositDate' => $request->input('bank-deposit-date'),
	    /* Todo: Bank voucher number for lot? */
	    //'bankVoucherNumber' => $request->input('bank-voucher-number'),
	    'bankDepositedBy' => $request->input('bank-deposited-by'),
	    'bankDepositAmount' => $request->input('bank-deposit-amount'),

	    'phDepositDate' => $request->input('philanthrophy-deposit-date'),
	    'phDepositedBy' => $request->input('philanthrophy-deposited-by'),
	];

	/* Todo: Create lot in DB */
	//$remitLot = $this->createBankVoucher($bvInfo, $request);
	$remitLot = $this->createRemitLot($remitLotInfo);
	//

	/* Put lot info into session */
	$request->session()->put('lot', $remitLot->lot_code);
	$request->session()->flash('status', 'Starting Lot Num: ' . $remitLot->lot_code);

        return redirect('/rmt/create');
    }

    /**
     * Start a new lot.
     *
     * @return \Illuminate\Http\Response
     */
    public function startLot(Request $request)
    {
        return view('remittance.start-lot');
    }

    /**
     * End current lot.
     *
     * @return \Illuminate\Http\Response
     */
    public function exitLot(Request $request)
    {
	/**
	 * Todo: This method should be callable only when 
	 *       there is current lot. Else should take an
         *       appropriate action.
         */

	$request->session()->forget('lot');
	$request->session()->flash('status', 'Success: Lot exited.');

        return redirect('/');
    }

    /**
     * Resume previous lot.
     *
     * @return \Illuminate\Http\Response
     */
    public function resumeLot()
    {
        return view('remittance.resume-lot');
    }

    /**
     * Process resume lot request.
     *
     * @return \Illuminate\Http\Response
     */
    public function resumeLotProcess(Request $request)
    {
	/* Validate data */
	$validatedData = $request->validate([
	    'lot-code' => 'required|integer|exists:remittance_lot,lot_code',
	]);

	/* Put lot info into session */
	$lotCode = $request->input('lot-code');
	$request->session()->put('lot', $lotCode);

	/* Todo: Redirect to more appropriate place. */
        return redirect('/');
    }



    /**
     * Show remittance creation success page.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSuccess()
    {
        return view('remittance.store-temp');
    }

    /**
     * Check if given amount is remaining in a given bank voucher.
     *
     * @param integer rlId
     * @param integer amount
     *
     * @return bool
     */
    public function checkBvSpace($rlId, $amount)
    {
	$retval = false;

	$bvAmount = RemittanceLot::find($rlId)->amount;

        $usedAmount = $this->usedBvAmount($rlId);

	if ($amount <= $bvAmount - $usedAmount) {
	    $retval = true;
	}

	return $retval;
    }

    /**
     * Return used amount for a given remittance lot id.
     *
     * @param integer rlId
     *
     * @return integer
     */
    public function usedBvAmount($rlId)
    {
	$usedAmount = 0;

        $remittanceLot = RemittanceLot::find($rlId);

	$remittances = $remittanceLot->remittances;

	foreach ($remittances as $remittance) {
	    $usedAmount += $this->remTotalAmount($remittance);
	}

	return $usedAmount;
    }

    /**
     * Return total amount for a given remittance.
     *
     * @param object remittance
     *
     * @return integer
     */
    public function remTotalAmount($remittance)
    {
        $total = 0;

	$remittanceLines = $remittance->remittance_lines;

	foreach ($remittanceLines as $remittanceLine) {
	    $total += $this->remLineTotalAmount($remittanceLine);
	}

	return $total;
    }

    /**
     * Return total amount for a given remittance line.
     *
     * @param object remittanceLine
     *
     * @return integer
     */
    public function remLineTotalAmount($remittanceLine)
    {
        $total = 0;

        $total += $remittanceLine->swastyayani;
        $total += $remittanceLine->istavrity;
        $total += $remittanceLine->acharyavrity;
        $total += $remittanceLine->dakshina;
        $total += $remittanceLine->sangathani;
        $total += $remittanceLine->ananda_bazar;
        $total += $remittanceLine->pranami;
        $total += $remittanceLine->swastyayani_awasista;
        $total += $remittanceLine->ritwiki;
        $total += $remittanceLine->utsav;
        $total += $remittanceLine->diksha_pranami;
        $total += $remittanceLine->acharya_pranami;
        $total += $remittanceLine->parivrity;
        $total += $remittanceLine->misc;

	return $total;
    }

    /**
     * Return remaining usable amount for a given lot.
     *
     * @param integer lotCode
     *
     * @return integer
     */
    public function lotRemainingBal($lotCode)
    {
        $remittanceLot = RemittanceLot::where('lot_code', $lotCode)->first();
	$remittanceLotId = $remittanceLot->remittance_lot_id;

        return $remittanceLot->amount - $this->usedBvAmount($remittanceLotId);
    }

    /**
     * Print remittance to arghya praswasti paper.
     *
     * @param integer remittanceId
     *
     * @return bool
     */
    public function printRemittance($remittanceId)
    {
	$remittance = \App\Remittance::find($remittanceId);
	$remTotal = $this->remTotalAmount($remittance);

        return view('remittance.print-rmt')
	    ->with('remittance', $remittance)
	    ->with('remTotal', $remTotal);
    }

    /**
     * Break 10 digit family code to 9 digit family code and  check digit.
     *
     * @param string tenDFamCode
     * 
     * @return array
     *
     */
    public function breakFamilyCode($tenDFamCode)
    {
        $tenDFamCode = (string) $tenDFamCode;

	/* Todo: implement validateTenDFamCode
	if ($this->validateTenDFamCode($tenDFamCode) === false) {
	    return false;
	}
	*/

	$famCodeParts = [
	    'nineDFamCode' => substr($tenDFamCode, 0, 9),
	    'checkDigit' => substr($tenDFamCode, 9, 1),
	];

	return $famCodeParts;
    }

    /**
     * Input family code.
     *
     * @return \Illuminate\Http\Response
     */
    public function familyInp()
    {
        return view('remittance.family-inp');
    }

    /**
     * Get old data for a given family.
     *
     * @return \Illuminate\Http\Response
     */
    public function getlastFamilyRemittance(Request $request)
    {
	/* Get lot info if in lot */
	if (session()->has('lot')) {
	    $lotCode = session()->get('lot');
	    $remainingBal = $this->lotRemainingBal($lotCode);
	    /* Todo: check for uniqueness? */
	    $remittanceLot = RemittanceLot::where('lot_code', $lotCode)->first();
	    $bvDepositDate = $remittanceLot->deposit_date;
	}

	/**
	 * Check for family old remittance
	 */
        $tenDFamCode = $request->input('family-code');
	$famCodeParts = $this->breakFamilyCode($tenDFamCode);
	if ($famCodeParts === false) {
	    /* Todo: Show error istead of dying. */
	    die("Error: Could not extract family code parts");
	}
	$nineDFamCode = $famCodeParts['nineDFamCode'];
	$family = Family::where('family_code', $nineDFamCode)->first();

	$lastRemittance = null;
	if ($family) {
	    /* Get last remittance of this family */
	    $lastRemittance = Remittance::where('family_id', $family->family_id)
	                      ->orderBy('created_time', 'desc')->first();
	}

	/* If no old remittance in db, return normal create view. */
	if (!$family || !$lastRemittance) {
	    if (session()->has('lot')) {
                return view('remittance.create')
	            ->with('remainingBal', $remainingBal)
	            ->with('bvDepositDate', $bvDepositDate);
	    } else {
                return view('remittance.create');
	    }
	}


	/* Return view with old remittance info */
        if (session()->has('lot')) {
            return view('remittance.create-wior')
                ->with('remainingBal', $remainingBal)
                ->with('bvDepositDate', $bvDepositDate)
	        ->with('lastRmt', $lastRemittance);
        } else {
            return view('remittance.create-wior')
	        ->with('lastRmt', $lastRemittance);
        }
    }
}

