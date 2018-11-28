$( document ).ready(function() {
    var printBtn = $("#id_print_page");

    printBtn.click(function(){
        console.log("PRINT: Going to print");
	alert("Print");
        window.print();
    });
});
