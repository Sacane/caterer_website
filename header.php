<?php
if(!empty($_SESSION['nom'])){
    echo "<header>"."Vous êtes authentifier sous le nom de"." ".$_SESSION['nom']."</header>";
}
?>
