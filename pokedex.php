<?php
session_start();

include_once './bdd.php';
include './Template/header.php';

$BDD = GenerBDD();
?>
<link rel='stylesheet' type='text/css' href='style/stylePokedex.css'>
<div id ="pkd" overflow="auto">
<?php displayPkd($BDD); ?>
</div>

<?php include './Template/footer.php'; ?>
