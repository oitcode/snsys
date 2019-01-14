// $( document ).ready(function() {
//     var ajaxBtn = $("#id_ajax_btn");
//     ajaxBtn.click(function(){
// 	console.log('Yyo');
// 
// 	// $.ajaxSetup({
// 	//     headers: {
// 	//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 	//     }
// 	// });
// 
//         // Using the core $.ajax() method
//         $.ajax({
// 
//             type: "POST",
//             // dataType : "json",
//             url: "/ajax/page/process",
//             data: '_token = <?php echo csrf_token() ?>',
// 
// 	    // success:function(data) {
// 	    //     console.log('Ola ka gola');
// 	    // }
//         })
//               // Code to run if the request succeeds (is done);
//               // The response is passed to the function
//               .done(function( json ) {
//                  $( "<h1>" ).text( json.msg ).appendTo( "body" );
//                  //$( "<div class=\"content\">").html( json.html ).appendTo( "body" );
//               })
//               // Code to run if the request fails; the raw request and
//               // status codes are passed to the function
//               .fail(function( xhr, status, errorThrown ) {
//                 alert( "Sorry, there was a problem!" );
//                 console.log( "Error: " + errorThrown );
//                 console.log( "Status: " + status );
//                 console.dir( xhr );
//               })
//               // Code to run regardless of success or failure;
//               .always(function( xhr, status ) {
//                 alert( "The request is complete!" );
//               });
//     });
// 
// });
