<?php
session_start();

include './bdd.php';
include './Template/header.php';
?>

Choisisser un article!<br/>
<button onclick="send(1)">Acheter une potion</button>
<button onclick="send(2)">Acheter une pokeball</button>

<script>
 function send(action) {
     var xhr = new XMLHttpRequest();
     
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
     xhr.send("action="+action);
 }
</script>
<?php include './Template/footer.php'; ?>
