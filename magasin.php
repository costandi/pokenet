<?php
session_start();

include './bdd.php';

$BDD = GenerBDD();

$un = 0;
$pb = 0;
$pt = 0;
$mn = 0;

fermerBDD($BDD);

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

	     <?php
	     $BDD = GenerBDD();
	     
	     $un = getUsername($BDD, $_SESSION["ID"]);
	     $pb = getPokeball($BDD, $_SESSION["ID"]);
	     $pt = getPotion($BDD, $_SESSION["ID"]);
	     $mn = getMoney($BDD, $_SESSION["ID"]);
	     
	     fermerBDD($BDD);
	     ?>
	 }
     });
     
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     xhr.send("action="+action);
 }
</script>
<?php include './Template/footer.php'; ?>
