<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>

	<div class="round-button" name="boutonPokeball">
		<a href="index.php">
			<img src="pokeball.png">
		</a>
	</div>

	<form action="traitement.php" method="POST">

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



<script>

	var password = document.getElementById("password");
	var confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Les mots de passe ne sont pas identiques !");
		} else {
			confirm_password.setCustomValidity('');
		}
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;

</script>