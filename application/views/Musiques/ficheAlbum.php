<?php
if(!isset($isNew) || $isNew){
    $page = "groupes/musique/ajouter";
    $titre = "Créer un Album";
} else {
    $isNew = false;
    $page = "groupes/musique/modifier";
    $titre = "Fiche de l'album";
}

if(!isset($album)){
    $album = new Album();
}

?>

<h1><?= $titre ?></h1>

<div class="row">
    <div class="col-sm-12 col-lg-offset-1 col-lg-10 infos-detail center-block">
        <div class="row">
            <?php echo form_open($page, array('id' => 'formEvenement', 'class' => 'col-sm-12 col-md-12 col-lg-12 col-xl-9')); ?>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="form-group">
                    <label for="nom">Nom de l'Album</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Titre de l'album" value="<?= $event->nom ?>"/>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="date">Date de sortie</label>
                        <input id="date" name="date" class="form-control" placeholder="Date" type="datetime-local" value="<?= $event->date_heure ?>" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="prix">Nombres de titres</label>
                        <input id="prix" name="prix" class="form-control" placeholder="Nombre de titres" type="number" value="nbreTitres"/>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-offset-8 col-md-4">
                    <label for="date">Titre 1</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Titre n° 1"
                           value="<?= $event->nom ?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <input type="submit" value="Valider" class="btn btn-homeband"/>
                    <input type="button" value="Annuler" class="btn btn-homeband"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

</div>