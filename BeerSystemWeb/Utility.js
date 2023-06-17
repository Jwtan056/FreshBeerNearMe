//Contains all the javascript used in the project

function CheckPassword(){
	
}

function ComparePasswordOnChange(){
	var userpassword = document.getElementById('Password').value;
	var userrepassword = document.getElementById('RePassword').value;
	
	if(userpassword !== userrepassword){
		alert("Passwords do not match");
		document.getElementById('RePassword').value = "";
	}
}

function UnlockRePassword(){
	var userpassword = document.getElementById('Password').value;
	console.log(userpassword);
	if(userpassword !== ""){
		document.getElementById('RePassword').disabled = false;
	}else{
		document.getElementById('RePassword').disabled = true;
	}
}