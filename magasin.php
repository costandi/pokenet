<?php
session_start();

include './bdd.php';
include './Template/header.php';
?>

Choisisser un article!<br/>
<input type="number" id="qtte" name="qtte" min="1" value="1" /><br/>    
<button onclick="send(1)">Potion</button>
<button onclick="send(2)">Pokeball</button>

<script>
 function send(action) {
     var xhr = new XMLHttpRequest();
     var qtte = parseInt(document.querySelector("#qtte").value, 10);
     
     xhr.open('POST', 'ajaxShop.php', false);
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
