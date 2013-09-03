<?php
require_once 'inc/model/header.php';

$logged = getUserinfos($bdd, $_SESSION['id']);

require_once 'inc/view/header.php';

?>