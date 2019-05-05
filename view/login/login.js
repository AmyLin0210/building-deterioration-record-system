let login = document.getElementById("login__button");
let errorMessage = document.getElementById("error__message");

login.addEventListener("click", ()=>{
	$.ajax({
		url:'/building-deterioration-record-system/controllers/login.php',
		type:'POST',
		data:{
            account: $('#login__account').val(),
            password: $('#login__password').val()
		},
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response) {
			if( response.search('false') != -1 ) {
                errorMessage.classList.add("error__message--show");
            }
            else {
                window.alert(response);
            }
		}
	});
})