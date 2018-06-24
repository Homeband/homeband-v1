<?php


if(!isset($event)){
    $event = new Evenement();
}

if(!isset($ville)){
    $ville = new Ville();
}

if(!isset($adresse)){
    $adresse = new Adresse();
}

if(!empty($event->illustration)){
    $avatar_url = base_url("images/event/$event->illustration");
} else {
    $avatar_url = base_url("images/no_image.png");
}

if(!isset($isNew) || $isNew){
    $page = "groupes/evenements/ajouter";
    $titre = "Créer un évènement";
} else {
    $isNew = false;
    $page = "groupes/evenements/$event->id_evenements/modifier";
    $titre = "Fiche de l'évènement";
}
?>

<h1><?= $titre ?></h1>

<div class="row">
    <div class="col-sm-12 col-lg-offset-1 col-lg-10 infos-detail center-block">
        <div class="row">
            <?php echo form_open_multipart($page, array('id' => 'formEvenement', 'class' => 'col-sm-12 col-md-12 col-lg-12 col-xl-9')); ?>
            <h4>Informations</h4>
            <div class="ml-3 mb-5">
                <div>
                    <div class="form-group">
                        <label for="nom">Illustration</label><br />
                        <img alt="avatar" class="mb-3" style="max-height:350px; max-width:350px;" src="<?= $avatar_url ?>" /><br />
                        <input type="file" name="illustration" size="20" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="nom">Titre</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Titre de l'évènement"
                           value="<?= $event->nom ?>"/>
                </div>
                <div class="form-group">
                    <label for="biographie">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="5"
                              placeholder="Donnez ici une courte description de l'évènement"><?=
                        $event->description
                        ?></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="date">Date & heure</label>
                        <input id="date" name="date_heure" class="form-control" placeholder="Date" type="datetime-local" value="<?= $event->date_heure ?>" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="prix">Prix (€)</label>
                        <input id="prix" name="prix" class="form-control" placeholder="Prix" type="number" value="<?= $event->prix ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="ml-3" for="lien_facebook">Lien Facebook</label>
                    <div class="col-12 input-group group-link">
                        <div class="input-group-addon"><i class="fa fa-facebook fa-lg"></i></div>
                        <input id="lien_facebook" type="text" name="lien_facebook" class="form-control"
                               placeholder="Lien Facebook de l'évènement" value="<?= $event->lien_facebook ?>">
                    </div>
                </div>
            </div>

            <h4>Lieu de l'évènement</h4>
            <div class="ml-3">
                <div class="row">
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="date">Adresse </label>
                        <input id="date" name="rue" class="form-control" placeholder="Rue" type="text" value="" />
                    </div>
                    <div class="form-group col-sm-12 col-md-2">
                        <label for="prix">Numéro</label>
                        <input id="prix" name="numero" class="form-control" placeholder="N°" type="number" value=""/>
                    </div>
                    <div class="form-group col-sm-12 col-md-2">
                        <label for="prix">Boite</label>
                        <input id="prix" name="boite" class="form-control" placeholder="Boite" type="text" value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="code_postal">Code postal</label>
                        <input type="text" id="code_postal" name="code_postal" class="form-control" value="<?= isset($ville) ? $ville->code_postal : '' ?>" placeholder="Code postal"/>
                    </div>
                    <div class="form-group col-8">
                        <label for="villes">Ville</label>
                        <select id="villes" name="ville" class="form-control">
                            <option disabled="disabled" value="0" <?=  $adresse->id_villes == 0 ? "selected" : "" ?>>Choisissez une ville</option>
                        </select>
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