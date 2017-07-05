function contador(){
    var UsersConnected;
		function ajaxRequest() {
		var url = 'js/registeredUsers.json';
	 	var request = new XMLHttpRequest();

		 request.onreadystatechange = function(){
			 if(request.readyState == 4 && request.status == 200){
				 var response = request.responseText;
				 response = JSON.parse(response);
				 UsersConnected = response.numberOfUsersOnline;
				 return UsersConnected;
			 }
		 };

			 request.open("GET", url);
			 request.send();
		}
		ajaxRequest();

		function incrementUsers(){
		  
		     UsersConnected *= Math.floor(Math.random() * 2) + 1; ;

		     return (UsersConnected);
		}

		setInterval(function(){ incrementUsers() }, 3000);

		function showConnectedUsers(){

			var span = document.getElementById('registered-users');
			span.innerHTML=UsersConnected;

		}

		setInterval(function(){ showConnectedUsers() }, 3000);

}
