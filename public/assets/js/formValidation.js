// document.getElementById("weight").addEventListener("input",function(){
// 	if(document.getElementById("weight").value==""){
// 		document.getElementById("weightValid").innerHTML="Weight Field Requireed.";
// 		prodCodeMsg.className="invalid";
// 	}

// });

// document.getElementById("email").addEventListener("input",function(){
// 	var patt=/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
// 	if(document.getElementById("email").value==""){
// 		document.getElementById("emailMsg").innerHTML="Required Email";
// 		// prodCodeMsg.className="invalid";
// 	}
// 	else{
// 		if(patt.test(document.getElementById("email").value)){
// 			document.getElementById("emailMsg").innerHTML="Email is valid!";
// 			// prodCodeMsg.className="valid";
// 		}
// 		else{
// 			document.getElementById("emailMsg").innerHTML="Email is invalid!";
// 			// prodCodeMsg.className="invalid";
// 		}
// 	}
// });

$('#email').on('input', function() {
    var email = $(this);
    var emailReg = new RegExp("^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$");
    valid = emailReg.test(email.val());

    if(valid){
		$('#emailMsg').text("Email is valid!");
		// $('#emailMsg').addClass('valid');
	}
	else{
		$('#emailMsg').text("Email is invalid!");
		// $('#emailMsg').removeClass('valid').addClass('invalid');
	}
});

$('#formCont').submit(function(event){
	var error = 0;
	if ($('#email').val()== ""){
		$('#emailMsg').text("Weight Field Requireed.");
		error++;
	}
	
 	if (error == 0){
 		alert("SUCCESSFUL");
 		$('form').reset();
 		$('span').text("");
 	}
 	console.log(error);
	event.preventDefault();
});
