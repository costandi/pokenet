<?php
session_start();

include './bdd.php';
include './Template/header.php';
?>
<div class="w3-center">
    <h1 class="w3-pokefont w3-jumbo">Choisisser un article!</h1><br/>
    <input type="number" id="qtte" name="qtte" min="1" value="1" class="w3-input"/><br/>    
    <button class="w3-btn w3-deep-purple w3-hover-grey w3-bold-pokefont w3-xlarge" onclick="send(1)">Potion</button>
    <button class="w3-btn w3-deep-purple w3-hover-grey w3-bold-pokefont  w3-xlarge" onclick="send(2)">Pokeball</button>
</div>

<script>
 function send(action) {
     var xhr = new XMLHttpRequest();
     var qtte = parseInt(document.querySelector("#qtte").value, 10);
     
     xhr.open('POST', 'ajaxServeur/ajaxShop.php', false);
     xhr.addEventListener('readystatechange', function() {
	 if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

   	     var tab = JSON.parse(xhr.responseText);

	     alert(tab[0]);

	     updatePokeball(tab[1]);
             updatePotion(tab[2]);
             updateMoney(tab[3]);
             
             
	 }
     });
     
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     
     xhr.send("action="+action+"&qtte="+qtte);
 }
</script>
<?php include './Template/footer.php'; ?>
