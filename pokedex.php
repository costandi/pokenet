<?php
session_start();

include_once './bdd.php';
include './Template/header.php';

$BDD = GenerBDD();
?>
<div id ="pkd" overflow="hidden">
<?php displayPkd($BDD); ?>
</div>

<?php include './Template/footer.php'; ?>
