<?php

use Illuminate\Database\Seeder;

class FixNewFamilyCodes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	echo "=======================================\n";
	echo " Running family code fix seed\n";
	echo "=======================================\n";

        $LEAD_CODE = 4700261548;


	/* 
	|----------------------------------------------------------------------
	| Algorithn
	|----------------------------------------------------------------------
	|
	| 1. Give temporary codes for old family codes not 10 digit.
	| 2. Remove check digit for old family codes of 10 digit.
	| 3. Give new family codes for new family codes with NULL check digit.
	|
        */



	echo "============================================\n";
	echo "Fixing old family codes with non 10 digits  \n";
	echo "============================================\n";

	$families = \App\Family::orderBy('family_id', 'ASC')->get();

	$exceptionCodes = [
	    101,
	    102,
	    103,
	    50001,
	    50002,
	    50003,
	    50009,
	    158631,
	    417050,
	    8953317,
	];

	$ntd_fix_lead_code = 48001;

	/*
	 *---------------------------------------------------------------------
	 * Just print
	 *---------------------------------------------------------------------
	 *
	 */
	//  $oldFixCount = 1;
	//  foreach ($families as $family) {
	//      $famCode = (string) $family->family_code;
	//      $famCodeLen = strlen($famCode);

	//      if ($family->family_code <= $LEAD_CODE && $famCodeLen !== 10) {
	//  	if (in_array($family->family_code, $exceptionCodes)) {
	//  	    // Ignore these family codes
	//  	    continue;
	//  	}
        //          
	//  	echo "[" . $oldFixCount++ . "]  :: " . $family->family_id . " ::  " . $family->family_code . "\n";
	//      }
	//  }


	/*
	 *---------------------------------------------------------------------
	 * UPDATE DATABASE
	 *---------------------------------------------------------------------
	 *
	 */
	$oldFixCount = 1;
	foreach ($families as $family) {
	    $famCode = (string) $family->family_code;
	    $famCodeLen = strlen($famCode);

	    if ($family->family_code <= $LEAD_CODE && $famCodeLen !== 10) {
		if (in_array($family->family_code, $exceptionCodes)) {
		    // Ignore these family codes
		    continue;
		}

		// Record error family code for this family id
                DB::table('family_code_fix')->insert([
                    'err_family_code' => $family->family_code,
		    'family_id' => $family->family_id,
	            'created_time' => \Carbon\Carbon::now(),
	            'updated_time' => \Carbon\Carbon::now(),
	            'comment' => 'Fixing err family code, snsys start 2018-Dec, [LTE-LC-NTD]',
                ]);

		// Make family code change in database
		try {
		    $family->family_code = $ntd_fix_lead_code;
		    $family->save();
	            $ntd_fix_lead_code++; 
		} catch (\Exception $e){
		    echo "Error:: Old non 10 Family Code: " . $famCode . "\n";
		}
	    }
	}



	echo "\n=============================================\n";
	echo "Removing check digit from old family codes   \n";
	echo "=============================================\n";

	$families = \App\Family::orderBy('family_id', 'ASC')->get();

	$checkDFixCount = 1;
	$newFCodes = [];

	$exceptionCodesOTN = [
            4700224154,
            4700224151,
            
            4700052949,
            4700052945,
            
            4700249963,
            4700249962,
            
            4700231070,
            4700231074,
            
            4700200859,
            4700200854,
            
            4700184667,
            4700184662,
            
            4700044746,
            4700044741,
            
            4700003636,
            4700003638,
            
            4700013781,
            4700013785,

            4700045284,
            4700045288,
	];

	$conflicting_fix_lead_code = 49001;

	/*
	 *---------------------------------------------------------------------
	 * Just print
	 *---------------------------------------------------------------------
	 *
	 */
	//  foreach ($families as $family) {
	//      if ($family->family_code <= $LEAD_CODE) {
	//  	/* IGNORE these families: They have duplicates need to handle them
	//  	 * manually.
	//  	 */
	//  	// if (in_array($family->family_code, $exceptionCodesOTN)) {
	//  	//     // Skip this family
	//  	//     continue;
	//  	// }

	//          $famCode = (string) $family->family_code;
	//          $famCodeLen = strlen($famCode);

	//          if ($famCodeLen === 10) {
        //              $nineDFamCode = substr($famCode, 0, 9);
        //              $checkDigit = substr($famCode, 9, 1);

	//  	    /* Make changes to database. */
	//  	    try {
	//  	        $family->family_code = $nineDFamCode;
	//  	        $family->fcode_check_digit = $checkDigit;
	//  		if (in_array($nineDFamCode, $newFCodes)) {
	//  		    echo "9D FamCode Repeat: $nineDFamCode\n";
	//  		} else {
	//  		    $newFCodes[] = $nineDFamCode;
	//  		}

	//  	        echo "[" . $checkDFixCount++ . "] " . $family->family_id . ":: " . $famCode . " => "
	//  		     . $family->family_code . " + " . $family->fcode_check_digit .  "\n";
	//  	    } catch (\Exception $e){
	//  		echo $e->getMessage() . "\n";
	//  	        echo "Error::: Check Digit:: Family Code: $famCode\n";
	//  	    }
	//          }
	//      }
	//  }


	/*
	 *---------------------------------------------------------------------
	 * UPDATE DATABASE
	 *---------------------------------------------------------------------
	 *
	 */
	foreach ($families as $family) {
	    /* Give temporary family codes to these families.
	     * Need to fix them later.
	     */
	    if (in_array($family->family_code, $exceptionCodesOTN)) {
	        // Record error family code for these family id
                DB::table('family_code_fix')->insert([
                    'err_family_code' => $family->family_code,
	            'family_id' => $family->family_id,
	            'created_time' => \Carbon\Carbon::now(),
	            'updated_time' => \Carbon\Carbon::now(),
	            'comment' => 'Fixing err family code, snsys start 2018-Dec, [LTE-LC-CONFLICT]',
                ]);

	        // Make family code change in database
	        try {
	            $family->family_code = $conflicting_fix_lead_code;
	            $family->save();
	            $conflicting_fix_lead_code++; 
	        } catch (\Exception $e){
	            echo "Error:: Old non 10 Family Code: " . $famCode . "\n";
	        }

	        continue;
	    }

	    if ($family->family_code <= $LEAD_CODE) {
	        /**
	         *-------------------------------------------------------------
	         * Fix check digit for deoghar alloted family codes.
	         *-------------------------------------------------------------
	         *
	         * These are the family codes which are smaller than or equal
	         * to LEAD_CODE. These codes were alloted by deoghar. No need
	         * to change these family codes. However we need to separete
	         * the check digit (10th digit) from the family code.
	         *
	         */


	        $famCode = (string) $family->family_code;
	        $famCodeLen = strlen($famCode);

	        if ($famCodeLen === 10) {
                    $nineDFamCode = substr($famCode, 0, 9);
                    $checkDigit = substr($famCode, 9, 1);

		    /* Make changes to database. */
		    try {
		        $family->family_code = $nineDFamCode;
		        $family->fcode_check_digit = $checkDigit;
		        $family->save();
		    } catch (\Exception $e){
			echo $e->getMessage();
		        echo "Error::: Check Digit:: Family Code: $famCode\n";
		    }
	        }
	    }
	}


	echo "\n===================================\n";
	echo "Fixing New family Codes\n";
	echo "===================================\n";

	$families = \App\Family::orderBy('family_id', 'ASC')->get();

	$new_lead_code = 470026201;

	/*
	 *---------------------------------------------------------------------
	 * Just print
	 *---------------------------------------------------------------------
	 *
	 */
	//  $newFixCount = 1;
	//  foreach ($families as $family) {
	//      if ($family->family_code > $LEAD_CODE) {
	//  	$famCode = $family->family_code;
	//          echo "[" . $newFixCount++ . "] " .  $family->family_id . ":: " . $famCode . "\n";
	//      }
	//  }



	/*
	 *---------------------------------------------------------------------
	 * UPDATE DATABASE
	 *---------------------------------------------------------------------
	 *
	 */
	$newFixCount = 1;
	foreach ($families as $family) {
	    if ($family->family_code > $LEAD_CODE) {
		/**
		 *---------------------------------------------------------
		 * Record the erroneous family code
		 *---------------------------------------------------------
		 * 
		 * For these family code we have given arghya praswawsti
		 * so we need to record their erroneous family codes
		 * so that if people submit with this erroneous family
		 * code then we can know which family this is for.
		 *
		 */

		$famCode = $family->family_code;

                DB::table('family_code_fix')->insert([
                    'err_family_code' => $family->family_code,
		    'family_id' => $family->family_id,
	            'created_time' => \Carbon\Carbon::now(),
	            'updated_time' => \Carbon\Carbon::now(),
	            'comment' => 'Fixing err family code while snsys start 2018-December, [SN-NEW]',
                ]);

		/**
		 *--------------------------------------------------------- 
		 * Update family code in database.
		 *--------------------------------------------------------- 
		 *
		 * Fix family code in database. This new family code only
		 * has 9 digits.
		 */

		try {
		    $family->family_code = $new_lead_code;
		    $family->save();
		    $new_lead_code++; 
		} catch (\Exception $e) {
		    echo "Error:: New Family Code: " . $famCode . "\n";
		}
	    }
	}
    }
}
