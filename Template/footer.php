    </div>

	</div>
	<footer id="footer" class="w3-row w3-bar w3-deep-purple w3-display-bottommiddle" style="position: fixed;">
	    <div class="w3-container w3-col s3 m3 l3">
		Pseudo : <?php echo $un;?>
	    </div>
	    <div class="w3-container w3-col s3 m3 l3">
		Potion(s) : <?php echo $pt;?>
	    </div>
	    <div class="w3-container w3-col s3 m3 l3">
		Pokeball(s) : <?php echo $pb;?>
	    </div>
	    <div class="w3-container w3-col s3 m3 l3">
		Pokédollar(s) : <?php echo $mn;?>
	    </div>
	</footer>
	<style>
	.w3-pokefont {
	    font-family: 'pokemon_hollownormal';
	}

	.w3-bold-pokefont {
	    font-family: 'pokemon_solidnormal';
	}
	 body {
	     background-image: url("./decors/fondSombre.png");
	     background-attachment: fixed;
	 }
	</style>
	<script>
	 function w3_open() {
	     document.getElementById("main").style.marginLeft = "25%";
	     document.getElementById("mySidebar").style.width = "25%";
	     document.getElementById("mySidebar").style.display = "block";
	     document.getElementById("openNav").style.display = 'none';
	 }
	 function w3_close() {
	     document.getElementById("main").style.marginLeft = "0%";
	     document.getElementById("mySidebar").style.display = "none";
	     document.getElementById("openNav").style.display = "inline-block";
	 }

	 function updatePokeball(newVal){
	     document.getElementById("pb").innerHTML = newVal;
	 }

	 function updatePotion(newVal){
	     document.getElementById("pt").innerHTML = newVal;
	 }

	 function updateMoney(newVal){
	     document.getElementById("mn").innerHTML = newVal;
	 }

	function updateVie(i){
		document.getElementById("vie").innerHTML = "il vous reste "+i+" pv !";
		maBarreVie.value = i;
	}

	 function updateEquipe(newVal){
	     document.getElementById("equipe").innerHTML = newVal;
	 }

	 function updatePC(newVal){
	     document.getElementById("PC").innerHTML = newVal;
	 }
	</script>
    </body>
</html>