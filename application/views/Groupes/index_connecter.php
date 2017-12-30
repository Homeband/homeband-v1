<?php
    if(!isset($groupe)){
        $groupe = new Groupe();
    }
?>
<h1> Bienvenue <?= $groupe->nom ?></h1>
<p>Ceci est votre page de gestion, vous pourrez changer vos informations, ajouter des newsletter, ajouter des évènements et voir vos commentaires</p>

