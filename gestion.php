<?php
session_start();
include './bdd.php';
include './Template/header.php';

$BDD = GenerBDD();

$eq = getEquipe($BDD, $_SESSION['ID']);
?>

<input type="button" name="joelle" value="Soigner tout ses pokemons" onclick="send(1, 0)">
    <div id='disEquipe'> <?php echo displayEquipe($eq, "Mettre en tete d équipe"); ?></div>
<?php
fermerBDD($BDD);
?>

<script>
 function send(use, pos){
     var xhr = new XMLHttpRequest();
     
     xhr.open('POST', 'ajaxGestion.php', false);
     xhr.addEventListener('readystatechange', function() {
	 if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
	     var v = xhr.responseText;

	     if (v != null)
		 document.getElementById("disEquipe").innerHTML = v;
	 }
     });
     
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     xhr.send("use="+use+"&pos="+pos);
 }
 
 
</script>

<?php
include './Template/footer.php';
?>
