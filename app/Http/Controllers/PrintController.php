<?php

namespace App\Http\Controllers;

/* Use fpdf library */
require('fpdf181/fpdf.php');

use Illuminate\Http\Request;
use App\Traits\RemittanceTrait;

use Illuminate\Support\Facades\Storage;

class PrintController extends Controller
{
    use RemittanceTrait;


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
     * Show print lot form.
     *
     * @return Response
     */
    public function printSingleForm()
    {
        return view('remittance.print-single-form');
    }

    /**
     * Show print lot form.
     *
     * @return Response
     */
    public function printLotForm()
    {
        return view('remittance.print-lot-form');
    }

    /**
     * Process print lot form.
     *
     * @return Response
     */
    public function printLotFormProcess(Request $request)
    {
	$rmtLot = RemittanceLot::where('lot_code', $request->input('lot-num'))->first();

        return view('remittance.print-lot-prepare')
	           ->with('rmtLot', $rmtLot);
    }

    /**
     * Prepare lot print.
     *
     * @param integer rLotNum
     *
     * @return Response
     */
    public function printLotPrep(Request $request)
    {
	$rLotNum = $request->input('lot-num');
	$rmtLot = RemittanceLot::where('lot_code', $rLotNum)->first();

        return view('remittance.print-rmt-lot-p')
	           ->with('rmtLot', $rmtLot);
    }

    /**
     * Print remittance to arghya praswasti paper.
     *
     * @param integer remittanceId
     *
     * @return bool
     */
    public function printRemittanceIndNew($remittanceId)
    {
	$remittance = \App\Remittance::find($remittanceId);
	$rmtTotal = $this->getRmtTotalAmount($remittanceId);

        return view('remittance.print-rmt-lot-p-ind')
	    ->with('remittance', $remittance)
	    ->with('rmtTotal', $rmtTotal);
    }


    /**
     * Make a full name out of individual names.
     *
     * @param array nameParts
     *
     * @return string
     */
    public function makeFullName($nameParts)
    {
	if ($nameParts['middleName'] != null) {
            $fullName = $nameParts['firstName']  . ' ' .
                        $nameParts['middleName'] . ' ' .
		        $nameParts['lastName'];
	} else {
            $fullName = $nameParts['firstName'] . ' ' . $nameParts['lastName'];
	}

	return $fullName;
    }

    /**
     * Get page header text for a given remittance.
     *
     * @param object remittance
     *
     * @return array
     */
    public function getPageHeaderInfo($remittance)
    {
        $submitter = [
          'firstName' => $remittance->submitter->person->first_name,
	  'middleName' => $remittance->submitter->person->middle_name,
          'lastName' => $remittance->submitter->person->last_name,
        ];

	$submitterFullName = $this->makeFullName($submitter);
        $submitterAddress = $remittance->family->address;

	$headerText = [
	    'submitterName' => $submitterFullName,
	    'address' => $submitterAddress,
	];

	return $headerText;
    }

    /**
     * Print page header for a given remittance.
     *
     * @param object pdf
     * @param object remittance
     *
     * @return object
     */
    public function printPdfPageHeader($pdf, $remittance)
    {
	$headerText = $this->getPageHeaderInfo($remittance);

        $headerX = 67;
        $headerY = 20;

        $pdf->SetXY($headerX, $headerY);
        $pdf->Cell(80,10, $headerText['submitterName'], 0, 0);
        $pdf->Ln(5);
        $pdf->SetX($headerX);
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(80,10, $headerText['address'], 0, 1);
        $pdf->SetFont('Courier','',13);

	return $pdf;
    }

    /**
    * Print page footer for a given remittance.
    *
    * @param object pdf
    * @param object remittance
    *
    * @return object
    */
    public function printPdfPageFooter($pdf, $remittance)
    {
        $nineDFamCode = $remittance->family->family_code;
        $checkDigit = $remittance->family->fcode_check_digit;

        if ($checkDigit === null) {
            $tenDFamCode = (string) $nineDFamCode . 'N';
        } else {
            $tenDFamCode = (string) $nineDFamCode . (string) $checkDigit;
        }

        $rmtDate = $remittance->submitted_date;
        $serialNum = $remittance->remittance_id;
        $rmtTotal = $this->getRmtTotalAmount($remittance->remittance_id);

        $footerY = 139;

        $pdf->setXY(47, $footerY);
        $pdf->Cell(50, 10, (string) $tenDFamCode, 0, 0);

        $pdf->setXY(137, $footerY);
        $pdf->Cell(30, 10, (string) $rmtDate, 0, 0);

        $pdf->setXY(267, $footerY);
        $pdf->Cell(30, 10, (string) $serialNum, 0, 0);

        $pdf->setXY(332, $footerY);
        $pdf->Cell(20, 10, "NRs " . (string) $rmtTotal, 0, 0);

        return $pdf;
    }

    /**
     * Set the position for printing remittance lines.
     *
     * @param object pdf
     *
     * @return object
     */
    public function setPageRlPos($pdf)
    {
        $posX = 0;
        $posY = 67;

        $pdf->SetXY($posX, $posY);

	return $pdf;
    }

    /**
     * Print a decimal amount in given position.
     *
     * @param object pdf
     * @param integer posX
     * @param decimal amount
     *
     * @return object
     */
    public function printNumInPos($pdf, $posX, $amount)
    {
        $pdf->SetX($posX);

        $numWidth = $pdf->GetStringWidth((string) $amount);
        $pdf->Cell($numWidth, 10, (string) $amount, 0, 0);

	return $pdf;
    }

    /**
     * Print oblate name for a remittance line.
     *
     * @param object pdf
     * @param object remittanceLine
     *
     * @return object
     *
     * Todo: For now this function is agnostic of current Y position in the
     *       pdf. It would be better if this method somehow writes with 
     *       the knowledge of the current Y position.
     */
    public function writeOblateName($pdf, $remittanceLine)
    {
        $rl = $remittanceLine;

        $oblate = [
          'firstName' => $rl->oblate->person->first_name,
          'middleName' => $rl->oblate->person->middle_name,
          'lastName' => $rl->oblate->person->last_name,
        ];

        if (strtoupper($oblate['lastName']) == 'EXT') {
             /* Use only first name if last name is `ext' */
             $oblateFullName = $oblate['firstName'];
        } else {
            $oblateFullName = $this->makeFullName($oblate);
        }

        // Print oblate name
        $pdf->setX(10);
        $pdf->Cell(75, 10, $oblateFullName, 0, 0);
        $pdf->Cell(5, 10, '', 0, 0);

	return $pdf;
    }

    /**
     * Print ritwik name for a remittance line.
     *
     * @param object pdf
     * @param object remittanceLine
     *
     * @return object
     *
     * Todo: For now this function is agnostic of current Y position in the
     *       pdf. It would be better if this method somehow writes with 
     *       the knowledge of the current Y position.
     */
    public function writeRitwikName($pdf, $remittanceLine)
    {
        $rl = $remittanceLine;

        $ritwik = [
          'firstName' => $rl->oblate->worker->person->first_name,
          'middleName' => $rl->oblate->worker->person->middle_name,
          'lastName' => $rl->oblate->worker->person->last_name,
        ];

        /* Print ritwik name, unless it is `B R' */
        if ($ritwik['firstName'] == 'B' && $ritwik['lastName'] == 'R') {
            //
        } else {
            $pdf->setX(10);
            $ritwikFullName = $this->makeFullName($ritwik);
            $pdf->Cell(75, 10, "*$ritwikFullName", 0, 0);
        }

	return $pdf;
    }


    /**
     * Print numbers for a remittance line.
     *
     * @param object pdf
     * @param object remittanceLine
     *
     * @return object
     *
     * Todo: For now this function is agnostic of current Y position in the
     *       pdf. It would be better if this method somehow writes with 
     *       the knowledge of the current Y position.
     */
    public function writeNumbers($pdf, $rl)
    {
        // X position of all numbers
	// Todo: Keep in some sensible place.
        $numPosX = [
            'swastyayani' => 122,
            'istavrity' => 139,
            'acharyavrity' => 161,
            'dakshina' => 178,
            'sangathani' => 197,
            'anandaBazar' => 212,
            'pranami' => 232,
            'swastyayaniAwasista' => 252,
            'ritwiki' => 269,
            'utsav' => 288,
            'dikshaPranami' => 306,
            'acharyaPranami' => 322,
            'parivrity' => 340,
            'misc' => 358,
        ];

	if ($rl->swastyayani != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['swastyayani'], $rl->swastyayani);
	}
	if ($rl->istavrity != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['istavrity'], $rl->istavrity);
	}
	if ($rl->acharyavrity != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['acharyavrity'], $rl->acharyavrity);
	}
	if ($rl->dakshina != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['dakshina'], $rl->dakshina);
	}
	if ($rl->sangathani != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['sangathani'], $rl->sangathani);
	}
	if ($rl->ananda_bazar != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['anandaBazar'], $rl->ananda_bazar);
	}
	if ($rl->pranami != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['pranami'], $rl->pranami);
	}
	if ($rl->swastyayani_awasista != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['swastyayaniAwasista'], $rl->swastyayani_awasista);
	}
	if ($rl->ritwiki != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['ritwiki'], $rl->ritwiki);
	}
	if ($rl->utsav != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['utsav'], $rl->utsav);
	}
	if ($rl->diksha_pranami != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['dikshaPranami'], $rl->diksha_pranami);
	}
	if ($rl->acharya_pranami != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['acharyaPranami'], $rl->acharya_pranami);
	}
	if ($rl->parivrity != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['parivrity'], $rl->parivrity);
	}
	if ($rl->misc != 0) {
	    $pdf = $this->printNumInPos($pdf, $numPosX['misc'], $rl->misc);
	}

	return $pdf;
    }

    /**
     * Print remittance body to pdf page.
     *
     * @param object pdf
     * @param object remittance
     *
     * @return object
     */
    public function printPdfPageBody($pdf, $remittance)
    {
	/* Todo: Print this info only if needed? Or log. */
        $numRls = count($remittance->remittance_lines);
        //echo "Total remittance lines: $numRls <br />";

	$pdf = $this->setPageRlPos($pdf);

        $rlCount = 0;
        foreach ($remittance->remittance_lines as $rl) {
            /* Add a new page after every 6 lines */
            if ($rlCount > 0 && $rlCount % 6 === 0) {
                $pdf->AddPage();
                $pdf = $this->printPdfPageHeader($pdf, $remittance);
	        $pdf = $this->setPageRlPos($pdf);
            }


            /*
            |------------
            | Oblate Line
            |------------
            */

            /*
            | Write oblate name for this line.
            */
	    $pdf = $this->writeOblateName($pdf, $rl);


	    /*
	    | Write all the numbers for this oblate line.
	    */
            $pdf->SetFont('Courier','',10);
	    $pdf = $this->writeNumbers($pdf, $rl);
            $pdf->SetFont('Courier','',13);
            // Go to new line
            $pdf->Ln(5);

            /*
            |------------
            | Ritwik Line
            |------------
            */

	    $pdf = $this->writeRitwikName($pdf, $rl);
            // Go to new line
            $pdf->Ln(5);


            /* Add a footer after 6 lines if remittance not done yet. */
            if ($rlCount % 6 === 5  && $rlCount < $numRls - 1) {
                $pdf = $this->printPdfPageFooter($pdf, $remittance);
            }

            $rlCount++;
        }

	return $pdf;
    }

    /**
     * Add a new page in the pdf for a given remittance.
     *
     * @param object pdf
     * @param object remittance
     *
     * @return object
     */
    public function addRemittanceToPdf($pdf, $remittance)
    {
        $pdf->AddPage();
        $pdf->SetFont('Courier','',13);

        /*
        | Print Header
        */
        $pdf = $this->printPdfPageHeader($pdf, $remittance);

        /*
        | Print Lines
        */
	$pdf = $this->printPdfPageBody($pdf, $remittance);

        /*
        | Print Footer
        */
        $pdf = $this->printPdfPageFooter($pdf, $remittance);

	return $pdf;
    }

    /** 
     * Create a PDF file for printing a lot
     *
     * @param integer lotCode
     *
     * @return Response
     */
    public function printToPdfLot($lotCode)
    {
	$rmtLot = \App\RemittanceLot::where('lot_code', $lotCode)->first();

	/*
	| Create a new pdf
	*/
        $pdf = new \FPDF('L','mm', [380, 153]);
	$pdf->SetMargins(0, 0, 0);
	$pdf->SetAutoPageBreak(false);

	/*
	 | Add each remittance in this lot to the pdf
	 */
	foreach ($rmtLot->remittances as $remittance) {
	    $pdf = $this->addRemittanceToPdf($pdf, $remittance);
	}

	return $pdf;
    }

    /** 
     * Create a PDF file for printing a single remittance
     *
     * @param integer rmtId
     *
     * @return Response
     */
    public function printToPdfSingle($rmtId)
    {
	$remittance = \App\Remittance::where('remittance_id', $rmtId)->first();

	/*
	| Create a new pdf
	*/
        $pdf = new \FPDF('L','mm', [380, 153]);
	$pdf->SetMargins(0, 0, 0);
	$pdf->SetAutoPageBreak(false);

	/*
	| Add the remittance to the pdf
	*/
	$pdf = $this->addRemittanceToPdf($pdf, $remittance);

	return $pdf;
    }

    /** 
     * Prepare for printing pdf of a lot.
     *
     * @param Request request
     *
     * @return Response
     */
    public function printToPdfLotPrep(Request $request)
    {
	/* Validate form input */
	$validatedData = $request->validate([
	    'lot-num' => 'bail|required|integer|exists:remittance_lot,lot_code',
	]);

	$lotNum = $request->input('lot-num');

	$pdf = $this->printToPdfLot($lotNum);

	/* Send the pdf to browser */
	return response($pdf->Output('I'), 200)
	                  ->header('Content-Type', 'application/pdf');
    }

    /**
     * Prepare for printing pdf of a single remittance.
     *
     * @return Response
     */
    public function printToPdfSinglePrep(Request $request)
    {
	/* Validate data */
	$validatedData = $request->validate([
	    'serial-num' => 'bail|required|integer|exists:remittance,remittance_id',
	]);

	$serialNum = $request->input('serial-num');

	$pdf = $this->printToPdfSingle($serialNum);

	/* Send the pdf to browser */
	return response($pdf->Output('I'), 200)
	                  ->header('Content-Type', 'application/pdf');
    }

    /**
     * Print a single remmittance.
     *
     * @return Response
     *
     * Todo: Refactor with printToPdfSinglePrep method.
     */
    public function printToPdfSingleParam($rmtId)
    {
	$serialNum = $rmtId;

	$pdf = $this->printToPdfSingle($serialNum);

	/* Send the pdf to browser */
	return response($pdf->Output('I'), 200)
	                  ->header('Content-Type', 'application/pdf');
    }

    /** 
     * Display PDF for a lot.
     *
     * @param Integer lotNum
     *
     * @return Response
     */
    public function displayLotPdf($lotNum)
    {
	$header = [
	    'Content-type' => 'application/pdf',
	];

	return response()->file('/home/osa_ad1/Documents/src/own/stage/larasites/snsys/storage/app/public/rmtlot-' . $lotNum . '.pdf', $header);
    }
}
