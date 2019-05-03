</div>
	
	<div id='droite'><br/>
	    <div id='g'><p id ='md'>_________________________________________________MENU</p></div>
	    <div id='d'>
		<ul>
		    <li><p><a href="combat.php">Se promener</a></p></li>
		    <li><p>Combattre d'autres joueurs!</p></li>
		    <li><p><a href="magasin.php">Magasin</a></p></li>
		    <li><p><a href="gestion.php">Gerez son équipe</a></p></li>
		</ul>
	    </div>
	</div>
	<div id='etatJ'>
	    <table id ="menuRapide">
		<tr>
		    <td>
			Nom : <div id="un"><?php echo $un; ?></div>
		    </td>
		    <td>	
			Pokeball : <div id="pb"><?php echo $pb;  ?></div>
		    </td>
		    <td>
			Potions : <div id="pt"><?php echo $pt; ?></div>
		    </td>
		    <td>
			Pokedollars : <div id ="mn"><?php echo $mn; ?></div>
		    </td>
		    <td>
			<form method='POST' action='index.php'>
			    <input type='submit' value='Déconnexion' id='deco' name='deco'/>
			</form> 
		    </td>
		    
		</tr>
	    </table>
	</div>
	
    </body>
</html>
<script>
 
 var statutB = 1;
 var fenetre = document.querySelector("#fenetre");
 var droite = document.querySelector("#droite");

 var g = document.querySelector("#g");
 var d = document.querySelector("#d");

 var etatJ = document.querySelector("#etatJ");
 
 g.addEventListener("click", function (){
     
     if (statutB == 1){
	 
	 d.style.visibility="hidden";
	 
	 droite.style.width="5%";
	 
	 g.style.width="90%";
	 
	 fenetre.style.width="94%";
	 
	 statutB = 0;
     }
     
     else if (statutB == 0){
	 
	 d.style.visibility="visible";
	 
	 droite.style.width="24%";
	 
	 g.style.width="20%";
	 
	 fenetre.style.width="75%";
	 
	 statutB = 1;
     }     
 });


 function updatePokeball(newVal){
     document.getElementById("pb").innerHTML = newVal;
 }

 function updatePotion(newVal){
     document.getElementById("pt").innerHTML = newVal;
 }

 function updateMoney(newVal){
     document.getElementById("mn").innerHTML = newVal;
 }

</script>
