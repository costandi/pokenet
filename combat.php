<!DOCTYPE html>
<html>
<head>
	<title>Fight !</title>
</head>
<body>



	<div>

	</div>



	<form>
		<input type="button" id="attaque" value="attaque">
		<input type="button" id="attaque1" value="charge">
		<input type="button" id="attaque2" value="null">
		<input type="button" id="attaque3" value="null">
		<input type="button" id="attaque4" value="null">


		<br/>


		<input type="button" id="objets" value="objets">
		<input type="button" id="pokeball" value="pokeball">
		<input type="button" id="potion" value="potion">

	</form>

</body>
</html>

<style>

	* {
		margin: 0;
		padding: 0;
	}

	input {

		border: 0;
		line-height: 2.5;
		padding: 0 20px;
		font-size: 1rem;
		text-align: center;
		color: #fff;
		text-shadow: 1px 1px 1px #000;
		border-radius: 10px;
		background-color: rgba(220, 0, 0, 1);
		background-image: linear-gradient(to top left,
			rgba(0, 0, 0, .2),
			rgba(0, 0, 0, .2) 30%,
			rgba(0, 0, 0, 0));
		box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),
		inset -2px -2px 3px rgba(0, 0, 0, .6);

	}

	input:hover {
		background-color: rgba(255, 0, 0, 1);
	}

	input:active {
		box-shadow: inset -2px -2px 3px rgba(255, 255, 255, .6),
		inset 2px 2px 3px rgba(0, 0, 0, .6);
	}

	#attaque1, #attaque2, #attaque3, #attaque4 {
		visibility: hidden;
	}

	#potion, #pokeball {
		visibility: hidden;
	}


</style>

<script type="text/javascript">
	var attaque = document.querySelector("#attaque");
	var attaque1 = document.querySelector("#attaque1");
	var attaque2 = document.querySelector("#attaque2");
	var attaque3 = document.querySelector("#attaque3");
	var attaque4 = document.querySelector("#attaque4");


	var objets = document.querySelector("#objets");
	var potion = document.querySelector("#potion");
	var pokeball = document.querySelector("#pokeball");


	attaque.addEventListener("click", function ()
	{
		attaque.style.visibility = "hidden";

		attaque1.style.visibility = "visible";
		attaque2.style.visibility = "visible";
		attaque3.style.visibility = "visible";
		attaque4.style.visibility = "visible";

		objets.style.visibility = "hidden";
	});





	objets.addEventListener("click", function ()
	{
		attaque.style.visibility = "hidden";

		pokeball.style.visibility = "visible";
		potion.style.visibility = "visible";

		objets.style.visibility = "hidden";
	});



	attaque1.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		objets.style.visibility = "visible";
	});




	attaque2.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		objets.style.visibility = "visible";
	});




	attaque3.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		objets.style.visibility = "visible";
	});




	attaque4.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";

		attaque1.style.visibility = "hidden";
		attaque2.style.visibility = "hidden";
		attaque3.style.visibility = "hidden";
		attaque4.style.visibility = "hidden";

		objets.style.visibility = "visible";
	});




	pokeball.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";

		pokeball.style.visibility = "hidden";
		potion.style.visibility = "hidden";

		objets.style.visibility = "visible";
	});


	potion.addEventListener("click", function ()
	{
		attaque.style.visibility = "visible";

		pokeball.style.visibility = "hidden";
		potion.style.visibility = "hidden";
	
		objets.style.visibility = "visible";
	});











	
</script>



<?php




?>