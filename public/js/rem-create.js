/* Javascript code for remittance creation. */

/* Add a new remittance line row */
function addRemitRow(remLineBody)
{
    /* Get the number of rows */
    var rowCount = $("#remit_row_body tr").length;

    /* Create new row */
    var newRow = $("<tr></tr>");

    /**
     * Create new columns
     */

    /* Name */
    var newNameCol = $("<td></td>");
    var newNameInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-name nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx",
        "name": "remit-row[" + rowCount + "][name]",
        "id": "",
    });
    newNameInp.keyup(function(){
        this.value=this.value.toUpperCase();
    });
    newNameInp.appendTo(newNameCol);
    newNameCol.appendTo(newRow);

    /* Ritwik Name */
    var newRitwikCol = $("<td></td>");
    var newRitwikInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-name nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx",
        "name": "remit-row[" + rowCount + "][ritwik-name]",
        "id": "",
	"list": "id_ritwik_list",
    });
    newRitwikInp.keyup(function(){
        this.value=this.value.toUpperCase();
    });
    newRitwikInp.appendTo(newRitwikCol);
    newRitwikCol.appendTo(newRow);

    /* Swastyayani */
    var newSwastyayaniCol = $("<td></td>");
    var newSwastyayaniInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][swastyayani]",
        "id": "",
    });
    newSwastyayaniInp.appendTo(newSwastyayaniCol);
    newSwastyayaniCol.appendTo(newRow);

    /* Istavrity */
    var newIstavrityCol = $("<td></td>");
    var newIstavrityInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][istavrity]",
        "id": "",
    });
    newIstavrityInp.appendTo(newIstavrityCol);
    newIstavrityCol.appendTo(newRow);

    /* Acharyavrity */
    var newAcharyavrityCol = $("<td></td>");
    var newAcharyavrityInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][acharyavrity]",
        "id": "",
    });
    newAcharyavrityInp.appendTo(newAcharyavrityCol);
    newAcharyavrityCol.appendTo(newRow);

    /* Dakshina */
    var newDakshinaCol = $("<td></td>");
    var newDakshinaInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][dakshina]",
        "id": "",
    });
    newDakshinaInp.appendTo(newDakshinaCol);
    newDakshinaCol.appendTo(newRow);

    /* Sangathani */
    var newSangathaniCol = $("<td></td>");
    var newSangathaniInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][sangathani]",
        "id": "",
    });
    newSangathaniInp.appendTo(newSangathaniCol);
    newSangathaniCol.appendTo(newRow);

    /* Ritwiki */
    var newRitwikiCol = $("<td></td>");
    var newRitwikiInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][ritwiki]",
        "id": "",
    });
    newRitwikiInp.appendTo(newRitwikiCol);
    newRitwikiCol.appendTo(newRow);

    /* Pranami */
    var newPranamiCol = $("<td></td>");
    var newPranamiInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][pranami]",
        "id": "",
    });
    newPranamiInp.appendTo(newPranamiCol);
    newPranamiCol.appendTo(newRow);

    /* Swastyayani Awasista */
    var newSwaAwaCol = $("<td></td>");
    var newSwaAwaInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][swastyayani-awasista]",
        "id": "",
    });
    newSwaAwaInp.appendTo(newSwaAwaCol);
    newSwaAwaCol.appendTo(newRow);

    /* Ananda bazar */
    var newAnandaBazarCol = $("<td></td>");
    var newAnandaBazarInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][ananda-bazar]",
        "id": "",
    });
    newAnandaBazarInp.appendTo(newAnandaBazarCol);
    newAnandaBazarCol.appendTo(newRow);

    /* Parivrity  */
    var newParivrityCol = $("<td></td>");
    var newParivrityInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][parivrity]",
        "id": "",
    });
    newParivrityInp.appendTo(newParivrityCol);
    newParivrityCol.appendTo(newRow);

    /* Misc  */
    var newMiscCol = $("<td></td>");
    var newMiscInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][misc]",
        "id": "",
    });
    newMiscInp.appendTo(newMiscCol);
    newMiscCol.appendTo(newRow);

    /* Utsav */
    var newUtsavCol = $("<td></td>");
    var newUtsavInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][utsav]",
        "id": "",
    });
    newUtsavInp.appendTo(newUtsavCol);
    newUtsavCol.appendTo(newRow);

    /* Diksha Pranami  */
    var newDikshaPrCol = $("<td></td>");
    var newDikshaPrInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][diksha-pranami]",
        "id": "",
    });
    newDikshaPrInp.appendTo(newDikshaPrCol);
    newDikshaPrCol.appendTo(newRow);

    /* Acharya Pranami  */
    var newAcharyaPrCol = $("<td></td>");
    var newAcharyaPrInp = $("<input />", {
        "type": "number",
        "step": "0.25",
        "min": "0.0",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][acharya-pranami]",
        "id": "",
    });
    newAcharyaPrInp.appendTo(newAcharyaPrCol);
    newAcharyaPrCol.appendTo(newRow);

    /* Actions  */
    var newActionsCol = $("<td></td>");
    var dAction = $("<span>", {
        "class": "nwo-rmc-rd",
    });
    dAction.text('D');

    /* Line Spacer */
    var mSpace = $("<span>", {
        "class": "",
    });
    mSpace.text(' ');

    var cAction = $("<span>", {
        "class": "nwo-rmc-rc",
    });
    cAction.text('C');

    dAction.appendTo(newActionsCol);
    mSpace.appendTo(newActionsCol);
    cAction.appendTo(newActionsCol);
    newActionsCol.appendTo(newRow);
    /*
    */


    /**
     * Append new row to form body
     */
    newRow.appendTo(remLineBody);
}

/**
 * ----------------------------------------------------------------------------
 * Add person and remove person buttons
 * ----------------------------------------------------------------------------
 */

$( document ).ready(function() {
    console.log("Console of Satsang Nepal Philanthrophy application");

    var remLineBody = $("#remit_row_body");

    if (! remLineBody.length) {
        /* Todo: Terminate program as there is something wrong. */
        console.log("Error: Remittance line table body NOT found");
    }

    /* Person remove button */
    var remPerson = $("#rem_person");
    remPerson.click(function(){
        /* Get last row */
	var lastRow = $("#remit_row_body tr:last");
	lastRow.remove();
    });

    /* Person add button */
    var addPerson = $("#add_person");
    addPerson.click(function(){
        addRemitRow(remLineBody);
    });
});


/**
 * ----------------------------------------------------------------------------
 * Check Total
 * ----------------------------------------------------------------------------
 *
 * TODO: Submit button click even should call this function and pass
 *       required arguments.
 */
$( document ).ready(function() {
    var checkTotalBtn = $("#check_total");

    checkTotalBtn.click(function(){
        /* Get Head Total amount */    
        var headTotal = $("#id_mi_total").val();

	/* Calculate total by adding all the sum */
	var sumTotal = 0;
	$(".col-val").each(function(){
            sumTotal += +$(this).val();
        });

	/* See the difference */
	var diff = headTotal - sumTotal;

	/* Alert a message */
	if (diff == 0) {
	    alert("MATCH");
	} else if (diff > 0) {
	    alert("ADD: " + diff);
	} else {
	    alert("SUBTRACT: " + diff * -1);
	}
    });
});

/**
 * ----------------------------------------------------------------------------
 * Submit button
 * ----------------------------------------------------------------------------
 */
// $( document ).ready(function() {
//     var submitFormBtn = $("#submit_remit");
// 
//     submitFormBtn.click(function(e){
//         var elem = $(this);
// 
//         /* Get Head Total amount */    
//         var headTotal = $("#id_mi_total").val();
// 
// 	/* Calculate total by adding all the sum */
// 	var sumTotal = 0;
// 	$(".col-val").each(function(){
//             sumTotal += +$(this).val();
//         });
// 
// 	/* See the difference */
// 	var diff = headTotal - sumTotal;
// 
// 	/* Alert a message */
// 	 if (diff > 0) {
//             e.preventDefault();
// 	    alert("ADD: " + diff);
// 	} else if (diff < 0) {
//             e.preventDefault();
// 	    alert("SUBTRACT: " + diff * -1);
// 	}
//     });
// });

/**
 * ----------------------------------------------------------------------------
 * Create 5 more remit rows on document ready
 * ----------------------------------------------------------------------------
 */
$( document ).ready(function() {
    var remLineBody = $("#remit_row_body");

    /* TODO: Some more sensible way to know that 5
    |        more rows are not needed.
    */
    var icConvertBtn = $('#id_convert_to_ic');

    if (! icConvertBtn.length) {
        /* Add 5 additional remit rows */
        var i = 0;
        for (i = 0; i < 5; i++) {
            addRemitRow(remLineBody);
        }
    }
});

/**
 * ----------------------------------------------------------------------------
 * Show error list div only if needed (at least one error to display).
 * ----------------------------------------------------------------------------
 */
$( document ).ready(function() {
    // Todo
});


/**
 * ============================================================================
 * Validation helper functions
 * ============================================================================
 */

/*
|------------------------------------------------------------------------------
| Currency validation
|------------------------------------------------------------------------------
*/

/* Verify currency is checked */
function currencyChecked()
{
    var curRadioName = 'currency';

    if ($('input[name='+ curRadioName +']:checked').length) {
        return true;
      }
    else {
        return false;
    }
}


/* Verify currency is either `ic' or `nc' */
function currencyValid()
{
    var curRadioName = 'currency';

    if ($('input[name='+ curRadioName +']').val() == 'ic') {
        return true;
    } else if ($('input[name='+ curRadioName +']').val() == 'nc') {
        return true;
    } else {
        return false;
    }
}

/*
|------------------------------------------------------------------------------
| Bank voucher validation
|------------------------------------------------------------------------------
*/

/* Check if bank voucher number is blank */
function bvNumBlank()
{
    var retval = true;

    var bvNum = $("#id_bv_num");

    /* TODO: Use regexp to match */
    if (bvNum.val()) {
        retval = false;
    }

    return retval;
}

/* Check if bank voucher date is valid */
function bvDateValid()
{
    var retval = false;

    var bvDate = $("#id_bv_date");

    /* TODO: Use regexp to match */
    if (bvDate.val()) {
        retval = true;
    }

    return retval;
}

/* Check if bank voucher depositor is valid */
function bvDepositorValid()
{
    var retval = false;

    var bvDepositor = $("#id_bv_depositor");

    if (validName(bvDepositor.val())) {
        retval = true;
    }

    return retval;
}

/* Check if bank voucher amount is valid */
function bvAmountValid()
{
    var retval = false;

    var bvAmount = $("#id_bv_amount");

    if (validPosInt(bvAmount.val())) {
        retval = true;
    }

    return retval;
}


/*
|------------------------------------------------------------------------------
| Main info validation
|------------------------------------------------------------------------------
*/

function miFamilyCodeValid()
{
    var retval = false;

    var miFamilyCode = $("#id_mi_fcode");

    /* TODO: Use regexp to match */
    if (miFamilyCode.val()) {
        retval = true;
    }

    return retval;
}

function miSubmitterNameValid()
{
    var retval = false;

    var miSubmitterName = $("#id_mi_sname");

    if (validName(miSubmitterName.val())) {
        retval = true;
    }

    return retval;
}

function miSubmitterAddressValid()
{
    var retval = false;

    var miSubmitterAddress= $("#id_mi_saddress");

    /* TODO: Use regexp to match */
    if (miSubmitterAddress.val()) {
        retval = true;
    }

    return retval;
}

function miSubmitDateValid()
{
    var retval = false;

    var miSubmitDate= $("#id_mi_sdate");

    /* TODO: Use regexp to match */
    if (miSubmitDate.val()) {
        retval = true;
    }

    return retval;
}

function miTotalValid()
{
    var retval = false;

    var miTotal= $("#id_mi_total");

    if (validPosInt(miTotal.val())) {
        retval = true;
    }

    return retval;
}

function miDeliveredByValid()
{
    var retval = false;

    var miDeliveredBy= $("#id_mi_dname");

    if (validName(miDeliveredBy.val())) {
        retval = true;
    }

    return retval;
}

/*
|------------------------------------------------------------------------------
| Remittance line validation
|------------------------------------------------------------------------------
*/
function rlValid()
{
    var retval = true;
    var curRetval = true;

    var rlErrList = $("#fe_rl_err_list");

    /* Get all remit rows first */
    var remitRows = $("#remit_row_body tr");

    // Validate each row
    remitRows.each(function(i, obj){
        var name = $(this).children(":first").children(":first");
	/* TODO: Trim whitespaces in name, else causes false negative. */

	/* Only check for rows which have person name. */
	if (name.val() != '') {
	    curRetVal = remitLineValid(i, $(this));
	    if (curRetVal == false) {
	        retval = false;
	    }
	}
    });

    return retval;
}

/* Validate a single remittance line */
function remitLineValid(i, row)
{
    var retval = true;

    var rlErrList = $("#fe_rl_err_list");

    var cols = $(row).children().children();

    // Validate each column
    cols.each(function(j, obj){
        if (j == 0) {
	    // Person Name
            if (!validName($(this).val())) {
                rlErrList.append("<li>Row: " + (i+1) + " => Person Name not valid</li>");
		retval = false;
	    }
        } else if (j == 1) {
	    // Ritwik Name
            if (!validName($(this).val())) {
                rlErrList.append("<li>Row: " + (i+1) + " => Ritwik Name not valid</li>");
		retval = false;
	    }
        } else if (j == 2) {
	    // Swastyayani
	    if ($(this).val() != '' && !validPosNumber($(this).val())) {
                rlErrList.append("<li>Row: " + (i+1) + " => Swastyayani not valid</li>");
		retval = false;
	    }
	} else if (j == 3) {
	    // Istavrity
	    if (!validPosNumber($(this).val())) {
                rlErrList.append("<li>Row: " + (i+1) + " => Istavrity not valid</li>");
		retval = false;
	    }
	} else {
	    // Others
	    if ($(this).val() != '' && !validPosNumber($(this).val())) {
                rlErrList.append("<li>Row: " + (i+1) + " => Col: " + j + " => number not valid</li>");
		retval = false;
	    }
	}
    });

    return retval;
}

function validPosNumber(value)
{
    var retval = false;

    var posNumRegex = /^\d+(\.\d{1,2})?$/; 

    if(posNumRegex.test(value)) {
        retval = true;
    }

    return retval;
}

function validPosInt(value)
{
    var retval = false;

    var posIntRegex = /^[1-9]\d{0,}$/; 

    if(posIntRegex.test(value)) {
        retval = true;
    }

    return retval;

}

function validName(name)
{
    /* Todo: Fix regexp */
    var namePattern = new RegExp('^[a-zA-Z]+ +[a-zA-Z]+( +[a-zA-Z]+){0,}$');

    /* Trim leading and trailing white spaces */
    /**
     * TODO: Put trimming somewhere else. Although laravel trims whitespaces
     *       in the backend, we cannot count on it.
     */
    name = $.trim(name);

    if (namePattern.test(name)) {
        return true;
    } else {
        return false;
    }
}

/**
 * ============================================================================
 * Validate Create form when submit button is clicked.
 * ============================================================================
 */
$( document ).ready(function() {
    var submitFormBtn = $("#submit_remit");

    submitFormBtn.click(function(e){
	/**
	 * Prevent form from submitting. Will explicitly submit later if
	 * there are no form issues, or any failures because of syntax errors
         */
	e.preventDefault();

        /* Issue flag */
        var formIssue = false;
        formIssue = false;

	/* See if for multiple months */
	var forMonths = $("#id_for_months").val();

	/* Get the error lists */
	var curErrList = $("#fe_cur_err_list");
	var bvErrList = $("#fe_bv_err_list");
	var miErrList = $("#fe_mi_err_list");
	var rlErrList = $("#fe_rl_err_list");
	var totalErrList = $("#total_err_list");

	/* Clear all error lists from screen */
	curErrList.empty();
	bvErrList.empty();
	miErrList.empty();
	rlErrList.empty();
	totalErrList.empty();


        /**
	 * Verify currency
	 */
        if (! currencyChecked()) {
            formIssue = true;
            curErrList.append("<li>Currency Not Checked</li>")
        }
	if (! currencyValid()) {
            formIssue = true;
            curErrList.append("<li>Currency Not Valid</li>");
	}

	/**
	 * Verify bank voucher info (if present)
	 */
	var bvTable = $("#bv_table");
	if (bvTable.length) {
	    /* Todo: Bank voucher number */
	    if (!bvDateValid()){
                formIssue = true;
                bvErrList.append("<li>Bank Voucher: Deposit date not valid</li>");
	    }
	    if (!bvDepositorValid()){
                formIssue = true;
                bvErrList.append("<li>Bank Voucher: Depositor not valid</li>");
	    }
	    if (!bvAmountValid()){
                formIssue = true;
                bvErrList.append("<li>Bank Voucher: Amount not valid</li>");
	    }
	}

	/**
	 * Verify main info
	 */
        if (!miFamilyCodeValid()) {
            formIssue = true;
            miErrList.append("<li>MAIN: Family code not valid</li>");
	}
        if (!miSubmitterNameValid()) {
            formIssue = true;
            miErrList.append("<li>MAIN: Submitter name not valid</li>");
	}
        if (!miSubmitterAddressValid()) {
            formIssue = true;
            miErrList.append("<li>MAIN: Submitter address not valid</li>");
	}
        if (!miSubmitDateValid()) {
            formIssue = true;
            miErrList.append("<li>MAIN: Submit date not valid</li>");
	}
        if (!miTotalValid()) {
            formIssue = true;
            miErrList.append("<li>MAIN: Total not valid</li>");
	}

	/* For non-lot verify that total within bank voucher amount. */
	var bvTable = $("#bv_table");
	if (bvTable.length) {
            //
            var bvAmount = $("#id_bv_amount");
            var miTotal= $("#id_mi_total");

	    // Compare only if they are valid integers
	    // TODO: Test ony if valid??
	    if (validPosInt(bvAmount.val()) && validPosInt(miTotal.val())) {
	        if (miTotal.val() > bvAmount.val()) {
                    formIssue = true;
                    miErrList.append("<li>MAIN: Total exceeds bank voucher amount</li>");
		}
	    }
	}

	/**
	 * Verify Remit Lines
	 */
	if (!rlValid()) {
            formIssue = true;
	}


	/* Check total is not exceeded by sum of individuals */
	/* TODO: Is this elem needed? */
        var elem = $(this);
	if (miTotalValid()) {
            /* Get Head Total amount */    
            var headTotal = $("#id_mi_total").val();

	    /* Get adjust value */
            var adjustVal = $("#id_adjust_val").val();

	    /* Calculate total by adding all the sum */
	    var sumTotal = 0;
	    //sumTotal = rlSumTotal();
	    $(".col-val").each(function(){
                sumTotal += +$(this).val();
            });

	    /* Do any multi month and adjust value operation */
	    sumTotal *= forMonths;
	    sumTotal += parseFloat(adjustVal);
	    
	    /* See the difference */
	    var diff = headTotal - sumTotal;

	    /* Alert a message */
	     if (diff > 0) {
		formIssue = true;
                totalErrList.append("<li>TOTAL => ADD: " + diff + "</li>");
	    } else if (diff < 0) {
		formIssue = true;
                totalErrList.append("<li>TOTAL => SUBTRACT: " + (diff * -1) + "</li>");
	    }
	}


	/* If any issues with form do not submit */
	if (formIssue == true) {
	    console.log("Form Issue true");
            e.preventDefault();
	    $("html, body").animate({ scrollTop: 0 }, "slow");
	} else {
	    /* Submit the form if there are not issues. */
	    $(this).closest("form")[0].submit();
	}
    });

});


/**
 * Change names to uppercase while typing
 */
$( document ).ready(function() {
    $('.nwo-std-name').keyup(function(){
        this.value=this.value.toUpperCase();
    });
});

$( document ).ready(function() {
    $('.nwo-std-upper').keyup(function(){
        this.value=this.value.toUpperCase();
    });
});


/*
|------------------------------------------------------------------------------
| Code related to create form for families with old remittance
|------------------------------------------------------------------------------
*/
$( document ).ready(function() {
    /**
     * Convert numbers to IC
     */
    var icConvertBtn = $('#id_convert_to_ic');

    if (icConvertBtn) {
        icConvertBtn.click(function(e) {
	    $(".col-val").each(function(){
		if ($(this).val() > 0) {
		    var ncVal = $(this).val();
		    var icVal = (ncVal / 1.6).toFixed(2);
                    $(this).val(icVal);
		}
            });
	/* Disable the button once clicked */
	icConvertBtn.prop("disabled", true);
	});
    }

    /**
     * Clear all numbers
     */
    var numClearBtn = $('#id_clear_nums');

    if (numClearBtn) {
        numClearBtn.click(function(e) {
	    $(".col-val").each(function(){
                $(this).val("");
            });
	});
    }
});

/*
|------------------------------------------------------------------------------
| To make remit lines rows delete and copy.
|------------------------------------------------------------------------------
*/
// Delete
$( document ).ready(function() {
    $("body").on("click", '.nwo-rmc-rd', function() {
        console.log('Removing remit line row');
        var delRow = $(this).parent().parent();
	delRow.remove();
    });
});

// Copy
$( document ).ready(function() {
    $("body").on("click", '.nwo-rmc-rc', function() {
        console.log('Copying remit line row');
        var curRow = $(this).parent().parent();
	var prevRow = curRow.prev();
	prevRow.css('background-color', 'red');

	var curRowColVals = curRow.find(".col-val");
	var prevRowColVals = prevRow.find(".col-val");

	console.log(prevRowColVals);
	curRowColVals.each(function() {
	    console.log('Col val: ' + $(this).val())
	});
    });
});
