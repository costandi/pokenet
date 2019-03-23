<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>

	<div class="round-button" name="boutonPokeball">
		<a href="index.php">
			<img src="decors/pokeball.png">
		</a>
	</div>

	<form action="traitement.php" method="POST">
		<h3>Inscrivez vous !</h3>
		<input type="text" required placeholder="Pseudo" name="nom" autofocus> <br/><br/>
		<input type="password" required placeholder="mot de passe" name="mdp" id="password"> <br/><br/>
		<input type="password" required placeholder="répètez le mot de passe" id="confirm_password"> <br/><br/>

		<input type="submit" value="s'inscrire" name="inscription">

	</form>

</body>
</html>


<style type="text/css">

	.round-button {
		position: relative;
		margin:5px;
		width: 80px;
		height: 0;
		padding-bottom: 80px;
		border-radius: 50%;
		border: 2px solid #f5f5f5;
		overflow: hidden;
		background: #464646;
		box-shadow: 0 0 3px gray;
	}
	.round-button:hover {
		background: red;
	}
	.round-button img {
		display: block;
		width: 77px;
		padding: 0;
		height: auto;
	}

</style>


<style type="text/css">

	*{
		padding: 0;
		margin: 0;
	}

	body {
		background: url("decors/fond.jpg") no-repeat;
	}


	form {
		position: absolute;
		left: 37%;
		top: 20%;
		border: solid 3px rgba(80,80,150,0.8);
		padding-left: 7%;
		padding-right: 7%;
		padding-bottom: 7%;
		border-radius: 30%;
		background-color: rgba(80,80,150,0.5);
	}

	form h3 {
		position: relative;
		margin-top: 70px;
		margin-bottom: 50px;
		font-size: 35px;
		text-align: center;
		color: rgba(255,230,0,0.9);
	}

	

	form input[type=text], [type=password] {
		border-color: rgba(80,80,150,0.8);
		border-radius: 15%;
		height: 30px;
		width: 200px;
		background-color: rgba(80,80,150,0.7);
		color: rgb(230,230,230);
		font-size: 20px;
	}

	form ::placeholder {
		color: rgb(180,180,180);
	}

	form input[type=submit] {
		position: relative;
		left: 18%;
		width: 150px;
		height: 50px;
		border-radius: 20%;
		background-color: rgb(100,100,255); 
		border-color: rgba(80,80,150,0.5);
		color: white;
		font-size: 20px;
	}

	form input[type=submit]:hover {
		background-color: rgba(100,100,255,0.8);
	}

	form input[type=submit]:active {
		box-shadow: inset -2px -2px 3px rgba(255, 255, 255, 0.6), inset 2px 2px 3px rgba(0, 0, 0, .6);
	}

	.round-button {
		position: relative;
		margin:5px;
		width: 80px;
		height: 0;
		padding-bottom: 80px;
		border-radius: 50%;
		border: 2px solid #f5f5f5;
		/*overflow: hidden;*/
		background: #464646;
		box-shadow: 0 0 3px gray;
	}
	.round-button:hover {
		background: red;
	}
	.round-button img {
		display: block;
		width: 77px;
		padding: 0;
		height: auto;
	}

</style>


<script>

	var password = document.getElementById("password");
	var confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("FFFFRRRRRAAAAAAAAAAAA");
		} else {
			confirm_password.setCustomValidity('');
		}
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;

</script>