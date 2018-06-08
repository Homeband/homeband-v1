<?php
if(!isset($isNew) || $isNew){
    $page = "groupes/musiques/ajouter";
    $titre = "Créer un Album";
} else {
    $isNew = false;
    $page = "groupes/musiques/modifier";
    $titre = "Fiche de l'album";
}

if(!isset($album)){
    $album = new Album();
}

    if(!empty($album->image)){
        $avatar_url = base_url("images/album/$album->image");
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
                        <!-- <a class="btn btn-homeband">Modifier l'image</a> -->
                </div>
                <div class="form-group">
                    <label for="nom">Nom de l'Album</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Titre de l'album" value=""/>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="date">Date de sortie</label>
                        <input id="date" name="date" class="form-control" placeholder="Date" type="date" value="" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="prix">Nombres de titres</label>
                        <input id="nbreTitres" name="nbreTitres" min="0" class="form-control" placeholder="Nombre de titres" type="number" value="nbreTitres"/>

                    </div>
                </div>
                <div id="listTitres">
               
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