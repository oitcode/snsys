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
        "class": "nwo-std-name nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx col-oblname",
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
        "class": "nwo-std-name nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx col-oblrtkname",
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
        "class": "nwo-std-5pc nwo-std-frminp col-val col-swas",
        "name": "remit-row[" + rowCount + "][swastyayani]",
        "id": "",
    });
    newSwastyayaniInp.appendTo(newSwastyayaniCol);
    newSwastyayaniCol.appendTo(newRow);

    /* Istavrity */
    var newIstavrityCol = $("<td></td>");
    var newIstavrityInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-ist",
        "name": "remit-row[" + rowCount + "][istavrity]",
        "id": "",
    });
    newIstavrityInp.appendTo(newIstavrityCol);
    newIstavrityCol.appendTo(newRow);

    /* Acharyavrity */
    var newAcharyavrityCol = $("<td></td>");
    var newAcharyavrityInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-acvt",
        "name": "remit-row[" + rowCount + "][acharyavrity]",
        "id": "",
    });
    newAcharyavrityInp.appendTo(newAcharyavrityCol);
    newAcharyavrityCol.appendTo(newRow);

    /* Dakshina */
    var newDakshinaCol = $("<td></td>");
    var newDakshinaInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-dks",
        "name": "remit-row[" + rowCount + "][dakshina]",
        "id": "",
    });
    newDakshinaInp.appendTo(newDakshinaCol);
    newDakshinaCol.appendTo(newRow);

    /* Sangathani */
    var newSangathaniCol = $("<td></td>");
    var newSangathaniInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-sng",
        "name": "remit-row[" + rowCount + "][sangathani]",
        "id": "",
    });
    newSangathaniInp.appendTo(newSangathaniCol);
    newSangathaniCol.appendTo(newRow);

    /* Ritwiki */
    var newRitwikiCol = $("<td></td>");
    var newRitwikiInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-rit",
        "name": "remit-row[" + rowCount + "][ritwiki]",
        "id": "",
    });
    newRitwikiInp.appendTo(newRitwikiCol);
    newRitwikiCol.appendTo(newRow);

    /* Pranami */
    var newPranamiCol = $("<td></td>");
    var newPranamiInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-pra",
        "name": "remit-row[" + rowCount + "][pranami]",
        "id": "",
    });
    newPranamiInp.appendTo(newPranamiCol);
    newPranamiCol.appendTo(newRow);

    /* Swastyayani Awasista */
    var newSwaAwaCol = $("<td></td>");
    var newSwaAwaInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-swaw",
        "name": "remit-row[" + rowCount + "][swastyayani-awasista]",
        "id": "",
    });
    newSwaAwaInp.appendTo(newSwaAwaCol);
    newSwaAwaCol.appendTo(newRow);

    /* Ananda bazar */
    var newAnandaBazarCol = $("<td></td>");
    var newAnandaBazarInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-ab",
        "name": "remit-row[" + rowCount + "][ananda-bazar]",
        "id": "",
    });
    newAnandaBazarInp.appendTo(newAnandaBazarCol);
    newAnandaBazarCol.appendTo(newRow);

    /* Parivrity  */
    var newParivrityCol = $("<td></td>");
    var newParivrityInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-pvt",
        "name": "remit-row[" + rowCount + "][parivrity]",
        "id": "",
    });
    newParivrityInp.appendTo(newParivrityCol);
    newParivrityCol.appendTo(newRow);

    /* Misc  */
    var newMiscCol = $("<td></td>");
    var newMiscInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-msc",
        "name": "remit-row[" + rowCount + "][misc]",
        "id": "",
    });
    newMiscInp.appendTo(newMiscCol);
    newMiscCol.appendTo(newRow);

    /* Utsav */
    var newUtsavCol = $("<td></td>");
    var newUtsavInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-uts",
        "name": "remit-row[" + rowCount + "][utsav]",
        "id": "",
    });
    newUtsavInp.appendTo(newUtsavCol);
    newUtsavCol.appendTo(newRow);

    /* Diksha Pranami  */
    var newDikshaPrCol = $("<td></td>");
    var newDikshaPrInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-dpr",
        "name": "remit-row[" + rowCount + "][diksha-pranami]",
        "id": "",
    });
    newDikshaPrInp.appendTo(newDikshaPrCol);
    newDikshaPrCol.appendTo(newRow);

    /* Acharya Pranami  */
    var newAcharyaPrCol = $("<td></td>");
    var newAcharyaPrInp = $("<input />", {
        "type": "number",
        "class": "nwo-std-5pc nwo-std-frminp col-val col-apr",
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

    //dAction.appendTo(newActionsCol);
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
 * Remove FE validation error message display div.
 * ----------------------------------------------------------------------------
 */
$( document ).ready(function() {
    var feErrDiv = $("#id_err_div");
    feErrDiv.toggle(false);
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
            var feErrDiv = $("#id_err_div");
	    feErrDiv.toggle(true);
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
	    // prevRow.css('background-color', 'red');

	    var curRowColVals = curRow.find(".col-val");
	    var prevRowColVals = prevRow.find(".col-val");

		/* Todo: Copy all these value in a loopish way.
		         Dont unroll the loop like this by hand.
	    */

	    //console.log(prevRowColVals);
	    /*
	    var i = 0;
	    prevRowColVals.each(function() {
	    	var temp = +$(this).val();
	        console.log(temp);
	        console.log('Col val: ' + temp + i);
	    	i++;
	    });
	    */

        curRow.find('.col-swas').val(prevRow.find('.col-swas').val());
        curRow.find('.col-ist').val(prevRow.find('.col-ist').val());
        curRow.find('.col-acvt').val(prevRow.find('.col-acvt').val());
        curRow.find('.col-dks').val(prevRow.find('.col-dks').val());
        curRow.find('.col-sng').val(prevRow.find('.col-sng').val());
        curRow.find('.col-rit').val(prevRow.find('.col-rit').val());
        curRow.find('.col-pra').val(prevRow.find('.col-pra').val());
        curRow.find('.col-swaw').val(prevRow.find('.col-swaw').val());
        curRow.find('.col-ab').val(prevRow.find('.col-ab').val());
        curRow.find('.col-pvt').val(prevRow.find('.col-pvt').val());
        curRow.find('.col-msc').val(prevRow.find('.col-msc').val());
        curRow.find('.col-uts').val(prevRow.find('.col-uts').val());
        curRow.find('.col-dpr').val(prevRow.find('.col-dpr').val());
        curRow.find('.col-apr').val(prevRow.find('.col-apr').val());
    });
});




$( document ).ready(function() {
    var bdd = $("#nwo-bdd");

	bdd.click(function () {
		var sd = $("#id_mi_sdate");
		sd.val($.trim(bdd.text()));
	});
});


/*
|==============================================================================
| Fill in the remittance create form with ajax served data.
|==============================================================================
|
*/

var ajaxDone = false;
$( document ).ready(function() {
    /* Form to submit */
    var form = $("#ajx-frm");

    /* Different places in form */
    var fc = $("#id_mi_fcode");
    var rlBody = $("#remit_row_body");
    var ajaxMsgDiv = $("#ajax_msg_div");


    fc.focusout(function () {
    	/*
    	| Do not repeat more than once.
    	|
    	*/
        if (ajaxDone == true) {
            return;
        }
    
    	/*
    	| If blank value do not do anything.
    	|
    	*/
        if (fc.val() == '') {
    		return;
    	}
    
    	/*
    	| If new family then just add some blank row.
    	| No need to do make any ajax calls. Just return!
    	|
    	*/
        if (fc.val() == 'new') {
    	    /* Clear lines and messages. */
    	    ajaxMsgDiv.empty();
    
	    /* Make family code input readonly */
            fc.prop('readonly', true);
    
    	    /* Set the flag. Although we did not do ajax literally. */
    	    ajaxDone = true;
    
    	    return;
        }

	/* Return if not ten digit family code */
	if (fc.val().length != 10) {
            ajaxMsgDiv.empty();
    
            var newMsgPara = $('<p style="color: red;"></p>');
            newMsgPara.text("Family code should be 10 digits");
            newMsgPara.appendTo(ajaxMsgDiv);

	    return;
	}
    
    	/**
	 * This was needed else was getting 419 status from web server
	 *
         * https://stackoverflow.com/questions/46466167/laravel-5-5-ajax-call-419-unknown-status
	 *
         */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        /*
        |--------------------------------------------
        | Make the ajax requrest.
        |--------------------------------------------
        |
        |
        */
        $.ajax({
            url: "/rmt/create/fcajax",
        
            /**
	     * Serializes the form elements?
             * From: https://stackoverflow.com/questions/1960240/jquery-ajax-submit-form
	     *
	     */
            data: form.serialize(),
        
            type: "POST",
            dataType : "json",
        })

        /**
         *-----------------------------------------------
         * Code to run if the request succeeds (is done);
         *-----------------------------------------------
         *
         * The response is passed to the function
         */
        .done(function( json ) {
	    /**
	     *---------------------
	     * Old remittance found
	     *---------------------
	     *
	     */
            if (json.msg == 'found') {
    	        ajaxMsgDiv.empty();
    
    	        /* Put in family code */
		fcVal = json.family.family_code;

		/* Check digit */
		if (fcVal <= 470026154) {
		    fcVal += json.family.fcode_check_digit;
		} else {
		    fcVal += 'N';
		}

    	        fc.val(fcVal);
    	        fc.prop('readonly', true);
    
               /* Put in address */
    	        var inpAddr = $("#id_mi_saddress");
    	        inpAddr.val(json.family.address);
    
    	        /* Put in submitter name */
    	        submitter = json.remittance.submitter.person;
    	        var submitterName = submitter.first_name + " ";
    	        if (submitter.middle_name != null) {
    	            submitterName += submitter.middle_name + " ";
    	        }
    	        submitterName += submitter.last_name + " ";
    	        var inpSubmitter = $("#id_mi_sname");
    	        inpSubmitter.val(submitterName);
    
    
		/*
		|----------------------------------
		| Fill in all the remittance lines.
		|----------------------------------
		|
		*/

    	        /* Clear all remittance lines if any */
    	        rlBody.empty();
    
		/* For each remittance line of previous record. */
                for(var i = 0; i < json.remittance.remittance_lines.length; i++) {
		    /* Add a new remit row */
                    addRemitRow(rlBody);
    
    	            var curRow = rlBody.children("tr").last();
    	            var remittanceLine = json.remittance.remittance_lines[i];
    	            person = remittanceLine.oblate.person;
    	            ritwik = remittanceLine.oblate.worker.person;
    
    	            /*
    	            |-----------------------
    	            | Fill in the values yo!
    	            |-----------------------
    	            |
    	            */
    
    
    	            /* Oblate Name */
    	            var personName = person.first_name + " ";
    	            if (person.middle_name != null) {
    	                personName += person.middle_name + " ";
    	            }
    	            personName += person.last_name;
    	            curRow.find(".col-oblname").first().val(personName);
    
    	            /* Ritwik Name */
    	            var ritwikName = ritwik.first_name + " ";
    	            if (ritwik.middle_name != null) {
    	                ritwikName += ritwik.middle_name + " ";
    	            }
    	            ritwikName += ritwik.last_name;
    	            curRow.find(".col-oblrtkname").first().val(ritwikName);
    
    	            /* All the numbers */
    	            curRow.find(".col-swas").first().val(
    	                remittanceLine.swastyayani
                        );
    	            curRow.find(".col-ist").first().val(
    	                remittanceLine.istavrity
                        );
    	            curRow.find(".col-acvt").first().val(
    	                remittanceLine.acharyavrity
                        );
    	            curRow.find(".col-dks").first().val(
    	                remittanceLine.dakshina
                        );
    	            curRow.find(".col-sng").first().val(
    	                remittanceLine.sangathani
                        );
    	            curRow.find(".col-rit").first().val(
    	                remittanceLine.ritwiki
                        );
    	            curRow.find(".col-pra").first().val(
    	                remittanceLine.pranami
                        );
    	            curRow.find(".col-swaw").first().val(
    	                remittanceLine.swastyayani_awasista
                        );
    	            curRow.find(".col-ab").first().val(
    	                remittanceLine.ananda_bazar
                        );
    	            curRow.find(".col-pvt").first().val(
    	                remittanceLine.parivrity
                        );
    	            curRow.find(".col-msc").first().val(
    	                remittanceLine.misc
                        );
    	            curRow.find(".col-uts").first().val(
    	                remittanceLine.utsav
                        );
    	            curRow.find(".col-dpr").first().val(
    	                remittanceLine.diksha_pranami
                        );
    	            curRow.find(".col-apr").first().val(
    	                remittanceLine.acharya_pranami
                        );
    
    	            curRow = curRow.next("tr");
                }

    	        //console.log(json);
    	        //alert(json.remittanceLines);
            } else {
                /*
		 *---------------------------
		 * Previous record NOT found.
		 *---------------------------
		 *
                 * Create a paragraph to display error msg and
                 * put the paragraph inside the div.
                 */
                ajaxMsgDiv.empty();
    
                var newMsgPara = $('<p style="color: red;"></p>');
                newMsgPara.text("Sorry no records!");
                newMsgPara.appendTo(ajaxMsgDiv);
    
    	    /* Return if no previoius record found.
    	     * No need to tell that ajaxDone is true.
    	     */
    	    return;
            }
    
            /* Set the flag. */
            ajaxDone = true;
        })
    
        /**
         *-----------------------------------
         * Ajax request FAIL
         *-----------------------------------
         *
         * Code to run if the request fails; the raw request and
         * status codes are passed to the function
         */
    
        .fail(function( xhr, status, errorThrown ) {
          alert( "Sorry, there was a problem!" );
          console.log( "Error: " + errorThrown );
          console.log( "Status: " + status );
          console.dir( xhr );
        })
    
    
        /**
         *-----------------------------------
         * Ajax PASS or FAIL. Any case.
         *-----------------------------------
         *
         * Code to run regardless of success or failure;
         */
        .always(function( xhr, status ) {
          //alert( "The request is complete!" );
        });
    });
});


/*
|==============================================================================
| Calculate family code check digit.
|==============================================================================
|
*/

function familyCodeCheckDigit(familyCode) {
    /**
     * Below algorithm to compute the check digit 
     * for a family code has been taken from 
     * Satsang Deoghar cobol code.
     */

    var checkDigit = -1;

    if (familyCode.length != 9) {
        return -1;
    }

    /* Pay careful attention:
     *
     * 1. First two digits are ignored.
     * 2. wsMship starts from rightside
     *    so, wsMship2 is familyCode[8].
     */
    wsMship1 = familyCode[9-1];
    wsMship2 = familyCode[9-2];
    wsMship3 = familyCode[9-3];
    wsMship4 = familyCode[9-4];
    wsMship5 = familyCode[9-5];
    wsMship6 = familyCode[9-6];
    wsMship7 = familyCode[9-7];

    wsDgtTot = wsMship1 * 2 + wsMship2 * 3 +
               wsMship3 * 4 + wsMship4 * 5 +
               wsMship5 * 6 + wsMship6 * 7 +
               wsMship7 * 8;

    wsRemainder = wsDgtTot % 11;

    if (wsRemainder == 0 || wsRemainder == 1) {
        checkDigit = 0;
    } else {
        checkDigit = 11 - wsRemainder;
    }

    return checkDigit;
}
