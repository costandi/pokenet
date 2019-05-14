<?php
session_start();

include_once './bdd.php';
include './Template/header.php';

$BDD = GenerBDD();
$eq = getEquipe($BDD, $_SESSION['ID']);
$PC = getPC($BDD, $_SESSION['ID']);
fermerBDD($BDD);
?>
<input type="button" name="joelle" value="Soigner l'équipe" onclick="send(1, 0)">
<table><tr>
    <td><div id="equipe" overflow="hidden"><?php echo displayEquipe($eq); ?></div></td>
    <td width ="20%"></td>
    <td><div id="PC" overflow="hidden"><?php echo displayPC($PC); ?></div></td>
</tr></table>

<?php include './Template/footer.php'; ?>

<script>
 function send(use, pos){
     var xhr = new XMLHttpRequest();
     
     xhr.open('POST', 'ajaxServeur/ajaxGestion.php', false);
     xhr.addEventListener('readystatechange', function() {
	 if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
	     var v = JSON.parse(xhr.responseText);
         
         updateEquipe(v[0]);
         updatePC(v[1]);
	 }
     });
     
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     xhr.send("use="+use+"&pos="+pos);
 }
 
 
</script>
