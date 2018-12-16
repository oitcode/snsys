<?php

namespace App\Traits;


use App\Remittance;
use App\RemittanceLot;
use App\RemittanceLine;

trait RemittanceTrait
{
    /**
     * Return total amount for a given remittance line.
     *
     * @param object remittanceLine
     *
     * @return decimal
     */
    public function getRmtLineTotalAmount($remittanceLine)
    {
        $total = 0.0;

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
     * Get the total amount for a given remittance.
     *
     * @param integer rmtId
     *
     * @return decimal
     */
    public function getRmtTotalAmount($rmtId)
    {
	$total = 0.0;

	if (($remittance = Remittance::find($rmtId)) === null) {
	    /* Todo: Do something senssible instead of just dying. */
	    die("Error: Cannot find remiitance with id: $rmtId<br/>");
	}

	$remittanceLines = $remittance->remittance_lines;

	foreach ($remittanceLines as $remittanceLine) {
	    $total += $this->getRmtLineTotalAmount($remittanceLine);
	}

	return $total;
    }
}
