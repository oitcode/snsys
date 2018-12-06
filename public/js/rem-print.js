$( document ).ready(function() {
    var printBtn = $("#id_print_page");

    printBtn.click(function(){
        console.log("PRINT: Going to print");
	alert("Print");
        window.print();
    });
});

/**
 * Below is done based on following:
 * https://developer.mozilla.org/en-US/docs/Web/Guide/Printing#Print_an_external_page_without_opening_it
 *
 * vvv MDN Solution
 */

function closePrint () {
  document.body.removeChild(this.__container__);
}

function setPrint () {
  this.contentWindow.__container__ = this;
  this.contentWindow.onbeforeunload = closePrint;
  this.contentWindow.onafterprint = closePrint;
  this.contentWindow.focus(); // Required for IE
  this.contentWindow.print();
}

/* Print a page */
function printPage (sURL) {
  var oHiddFrame = document.createElement("iframe");
  oHiddFrame.onload = setPrint;
  oHiddFrame.style.visibility = "hidden";
  oHiddFrame.style.position = "fixed";
  oHiddFrame.style.right = "0";
  oHiddFrame.style.bottom = "0";
  oHiddFrame.src = sURL;
  document.body.appendChild(oHiddFrame);
}

/* ^^^ MDN solution upto here */

/* Print all remittances in lot */

$( document ).ready(function() {
    var printLotBtn = $("#id_print_lot_btn");

    printLotBtn.click(function(){
	alert("Printing LOT");
	$("ul.lot-list li").each(function(i) {
	    var rmtId = $(this).text();
            printPage('http://snsys.localhost/rmt/print/' + rmtId);
	});
    });
});

//onclick="printPage('http://snsys.localhost/rmt/print/100');"

/**/

