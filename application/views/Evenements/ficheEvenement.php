<?php
if(!isset($isNew) || $isNew){
    $page = "groupes/evenements/ajouter";
    $titre = "Créer un évènement";
} else {
    $isNew = false;
    $page = "groupes/evenements/modifier";
    $titre = "Fiche de l'évènement";
}

if(!isset($event)){
    $event = new Evenement();
}

if(!empty($event->illustration)){
    $avatar_url = base_url("images/event/$event->illustration");
} else {
    $avatar_url = base_url("images/no_image.png");
}

?>

<h1><?= $titre ?></h1>

<div class="row">
    <div class="col-sm-12 col-lg-offset-1 col-lg-10 infos-detail center-block">
        <div class="row">
            <?php echo form_open_multipart($page, array('id' => 'formEvenement', 'class' => 'col-sm-12 col-md-12 col-lg-12 col-xl-9')); ?>
            <div class="tab-content" id="v-pills-tabContent">
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
                        <input id="date" name="date" class="form-control" placeholder="Date" type="datetime-local" value="<?= $event->date_heure ?>" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="prix">Prix (€)</label>
                        <input id="prix" name="prix" class="form-control" placeholder="Prix" type="number" value="<?= $event->prix ?>"/>

                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Default checkbox
                        </label>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-offset-8 col-md-4">

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