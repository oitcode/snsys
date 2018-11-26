/* Javascript code for remittance creation. */

/* Add a new remittance line row */
function addRemitRow(remLineBody)
{
    /* Get the number of rows */
    var rowCount = $("#remit_row_body tr").length;

    console.log("Phew New RL Js");
    /* Create new row */
    var newRow = $("<tr></tr>");

    /**
     * Create new columns
     */

    /* Name */
    var newNameCol = $("<td></td>");
    var newNameInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx",
        "name": "remit-row[" + rowCount + "][name]",
        "id": "",
    });
    newNameInp.appendTo(newNameCol);
    newNameCol.appendTo(newRow);

    /* Ritwik Name */
    var newRitwikCol = $("<td></td>");
    var newRitwikInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx",
        "name": "remit-row[" + rowCount + "][ritwik-name]",
        "id": "",
    });
    newRitwikInp.appendTo(newRitwikCol);
    newRitwikCol.appendTo(newRow);

    /* Swastyayani */
    var newSwastyayaniCol = $("<td></td>");
    var newSwastyayaniInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][swastyayani]",
        "id": "",
    });
    newSwastyayaniInp.appendTo(newSwastyayaniCol);
    newSwastyayaniCol.appendTo(newRow);

    /* Istavrity */
    var newIstavrityCol = $("<td></td>");
    var newIstavrityInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][istavrity]",
        "id": "",
    });
    newIstavrityInp.appendTo(newIstavrityCol);
    newIstavrityCol.appendTo(newRow);

    /* Acharyavrity */
    var newAcharyavrityCol = $("<td></td>");
    var newAcharyavrityInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][acharyavrity]",
        "id": "",
    });
    newAcharyavrityInp.appendTo(newAcharyavrityCol);
    newAcharyavrityCol.appendTo(newRow);


    /* Dakshina */
    var newDakshinaCol = $("<td></td>");
    var newDakshinaInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][dakshina]",
        "id": "",
    });
    newDakshinaInp.appendTo(newDakshinaCol);
    newDakshinaCol.appendTo(newRow);

    /* Sangathani */
    var newSangathaniCol = $("<td></td>");
    var newSangathaniInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][sangathani]",
        "id": "",
    });
    newSangathaniInp.appendTo(newSangathaniCol);
    newSangathaniCol.appendTo(newRow);

    /* Ananda bazar */
    var newAnandaBazarCol = $("<td></td>");
    var newAnandaBazarInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][ananda-bazar]",
        "id": "",
    });
    newAnandaBazarInp.appendTo(newAnandaBazarCol);
    newAnandaBazarCol.appendTo(newRow);

    /* Pranami */
    var newPranamiCol = $("<td></td>");
    var newPranamiInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][pranami]",
        "id": "",
    });
    newPranamiInp.appendTo(newPranamiCol);
    newPranamiCol.appendTo(newRow);

    /* Swastyayani Awasista */
    var newSwaAwaCol = $("<td></td>");
    var newSwaAwaInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][swastyayani-awasista]",
        "id": "",
    });
    newSwaAwaInp.appendTo(newSwaAwaCol);
    newSwaAwaCol.appendTo(newRow);

    /* Ritwiki */
    var newRitwikiCol = $("<td></td>");
    var newRitwikiInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][ritwiki]",
        "id": "",
    });
    newRitwikiInp.appendTo(newRitwikiCol);
    newRitwikiCol.appendTo(newRow);

    /* Utsav */
    var newUtsavCol = $("<td></td>");
    var newUtsavInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][utsav]",
        "id": "",
    });
    newUtsavInp.appendTo(newUtsavCol);
    newUtsavCol.appendTo(newRow);

    /* Diksha Pranami  */
    var newDikshaPrCol = $("<td></td>");
    var newDikshaPrInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][diksha-pranami]",
        "id": "",
    });
    newDikshaPrInp.appendTo(newDikshaPrCol);
    newDikshaPrCol.appendTo(newRow);

    /* Acharya Pranami  */
    var newAcharyaPrCol = $("<td></td>");
    var newAcharyaPrInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][acharya-pranami]",
        "id": "",
    });
    newAcharyaPrInp.appendTo(newAcharyaPrCol);
    newAcharyaPrCol.appendTo(newRow);

    /* Parivrity  */
    var newParivrityCol = $("<td></td>");
    var newParivrityInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][parivrity]",
        "id": "",
    });
    newParivrityInp.appendTo(newParivrityCol);
    newParivrityCol.appendTo(newRow);

    /* Misc  */
    var newMiscCol = $("<td></td>");
    var newMiscInp = $("<input />", {
        "type": "text",
        "class": "nwo-std-5pc nwo-std-frminp col-val",
        "name": "remit-row[" + rowCount + "][misc]",
        "id": "",
    });
    newMiscInp.appendTo(newMiscCol);
    newMiscCol.appendTo(newRow);

    /* Append new row to form body */
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
    } else {
        console.log("Remittance line table body found");
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
        var headTotal = $("#head_total").val();

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
$( document ).ready(function() {
    var submitFormBtn = $("#submit_remit");

    submitFormBtn.click(function(e){
        var elem = $(this);

        /* Get Head Total amount */    
        var headTotal = $("#head_total").val();

	/* Calculate total by adding all the sum */
	var sumTotal = 0;
	$(".col-val").each(function(){
            sumTotal += +$(this).val();
        });

	/* See the difference */
	var diff = headTotal - sumTotal;

	/* Alert a message */
	 if (diff > 0) {
            e.preventDefault();
	    alert("ADD: " + diff);
	} else {
            e.preventDefault();
	    alert("SUBTRACT: " + diff * -1);
	}
    });
});

/**
 * ----------------------------------------------------------------------------
 * Create 5 more remit rows on document ready
 * ----------------------------------------------------------------------------
 */
$( document ).ready(function() {
    var remLineBody = $("#remit_row_body");

    /* Add 5 additional remit rows */
    var i = 0;
    for (i = 0; i < 5; i++) {
        addRemitRow(remLineBody);
    }
});

