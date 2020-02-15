<?php
session_start();

include_once './bdd.php';
include './Template/header.php';

$BDD = GenerBDD();
$eq = getEquipe($BDD, $_SESSION['ID']);
$PC = getPC($BDD, $_SESSION['ID']);
fermerBDD($BDD);
?>

<div class="w3-center w3-container">
    <img name="joelle" onclick="send(1, 0)" src="./decors/centrePokemon.png" alt="Soigner l'équipe" style="width: 15%; height: 15%" class="w3-btn w3-button">
    
    <div class="w3-row w3-center">
        <div class="w3-col s12 m6 l6 w3-center w3-container">
            <h2 class="w3-bold-pokefont">Votre équipe</h2>
            <div id="equipe">
                <?php echo displayEquipe($eq); ?>
            </div>
        </div>
        <div class="w3-col s12 m6 l6 w3-center w3-container">
            <h2 class="w3-bold-pokefont">Votre PC</h2>
            <div id="PC">
            <?php echo displayPC($PC); ?>
        </div>
        </div>
    </div>
</div>

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

<?php include './Template/footer.php'; ?>