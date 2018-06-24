<?php
if(!empty($groupe->illustration)){
    $avatar_url = base_url("images/group/$groupe->illustration");
} else {
    $avatar_url = base_url("images/no_image.png");
}

$membres = array();
?>

<input type="hidden" id="id_villes" value="<?= isset($ville) ? $ville->id_villes : 0 ?>" />
<h1>Informations sur le groupe</h1>

<div class="row">
    <div class="col-md-4 col-lg-3 infos-nav">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
               aria-controls="v-pills-home" aria-selected="true">Informations générales</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
               aria-controls="v-pills-profile" aria-selected="false">Liens</a>
            <a class="nav-link" id="v-pills-members-tab" data-toggle="pill" href="#v-pills-members" role="tab"
               aria-controls="v-pills-members" aria-selected="false">Membres</a>
        </div>
    </div>
    <div class="col-md-8 col-lg-9 infos-detail">
        <div class="row">
            <?php echo form_open_multipart('groupes/informations', array('id' => 'formInscription', 'class' => 'col-12')); ?>
            <div class="tab-content" id="v-pills-tabContent">

                <!-- Informations globales -->
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    <div>
                        <div class="form-group">
                            <label for="nom">Illustration</label><br />
                            <img alt="avatar" class="mb-3" style="max-height:350px; max-width:350px;" src="<?= $avatar_url ?>" /><br />
                            <input type="file" name="illustration" size="20" />
                        </div>
                        <!-- <a class="btn btn-homeband">Modifier l'image</a> -->
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom du groupe</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom de votre groupe"
                               value="<?= $groupe->nom ?>"/>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="code_postal">Code postal</label>
                            <input type="text" id="code_postal" name="code_postal" class="form-control" value="<?= isset($ville) ? $ville->code_postal : '' ?>" placeholder="Code postal"/>
                        </div>
                        <div class="form-group col-8">
                            <label for="villes">Ville</label>
                            <select id="villes" name="ville" class="form-control">
                                <option disabled="disabled" value="0" <?=  $groupe->id_villes == 0 ? "selected" : "" ?>>Choisissez une ville</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style">Style de musique</label>
                        <select id="style" name="style" class="form-control">
                            <option disabled="disabled" value="0" <?=  $groupe->id_styles == 0 ? "selected" : "" ?>>Choisissez un style</option>
                            <?php
                            if (isset($styles) && is_array($styles) && !empty($styles)) {
                                foreach ($styles as $item) {
                                    $selected = ($item->id_styles == $groupe->id_styles) ? "selected" : "";
                                    ?>
                                    <option <?= $selected ?> value="<?= $item->id_styles ?>"><?= $item->nom ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="biographie">Biographie</label>
                        <textarea id="biographie" name="biographie" class="form-control" rows="5"
                                  placeholder="Donnez ici une biographie de votre groupe"><?=
                            $groupe->biographie
                            ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contacts">Informations de contact</label>
                        <textarea id="contacts" name="contacts" class="form-control" rows="5"
                                  placeholder="Ces informations permettrons aux utilisateur de pouvoir vous contacter."><?= trim($groupe->contacts); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-12 ">
                            <input type="submit" value="Modifier" class="btn btn-homeband"/>
                        </div>
                    </div>

                </div>

                <!-- Liens -->
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-facebook fa-lg"></i></div>
                            <input id="text" type="text" name="lien_facebook" class="form-control"
                                   placeholder="Lien Facebook" value="<?= $groupe->lien_facebook ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-twitter fa-lg"></i></div>
                            <input id="text" type="text" name="lien_twitter" class="form-control"
                                   placeholder="Lien Twitter" value="<?= $groupe->lien_twitter ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-youtube fa-lg"></i></div>
                            <input id="text" type="text" name="lien_youtube" class="form-control"
                                   placeholder="Lien Youtube" value="<?= $groupe->lien_youtube ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-instagram fa-lg"></i></div>
                            <input id="text" type="text" name="lien_instagram" class="form-control"
                                   placeholder="Lien Instagram" value="<?= $groupe->lien_instagram ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-spotify fa-lg"></i></div>
                            <input id="text" type="text" name="lien_spotify" class="form-control"
                                   placeholder="Lien Spotify" value="<?= $groupe->lien_spotify ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-apple fa-lg"></i></div>
                            <input id="text" type="text" name="lien_itunes" class="form-control"
                                   placeholder="Lien Itunes" value="<?= $groupe->lien_itunes ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-soundcloud fa-lg"></i></div>
                            <input id="text" type="text" name="lien_soundcloud" class="form-control"
                                   placeholder="Lien Soundcloud" value="<?= $groupe->lien_soundcloud ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-bandcamp fa-lg"></i></div>
                            <input id="text" type="text" name="lien_bandcamp" class="form-control"
                                   placeholder="Lien Bandcamp" value="<?= $groupe->lien_bandcamp ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 ">
                            <input type="submit" value="Modifier" class="btn btn-homeband"/>
                        </div>
                    </div>
                </div>

                <!-- Membres -->
                <div class="tab-pane fade" id="v-pills-members" role="tabpanel" aria-labelledby="v-pills-members-tab">
                    <div class="col-12">
                        <div class="row mb-3">
                            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addMemberModal">Ajouter un membre</a>
                        </div>
                        <div class="row">
                            <table id="ListMembers" class="table" width="100%">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th></th>   <!-- Actions -->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($membres as $membre){
                                    ?>
                                    <tr>
                                        <td><?= $membre->nom ?></td>
                                        <td><?= $membre->prenom ?><</td>
                                        <td></td>
                                        <td></td>
                                        <td><a class="btn btn-danger" hfre="#">Supprimer</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="AddMemberModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <form id="formAddMember">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titreAddMember">Ajouter un membre</h5>
                    <button id="closeAddMember" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="AddMember_id_groupes" value="<?= $groupe->id_groupes ?>" />
                    <div class="form-group">
                        <label for="AddMember_nom">Nom</label>
                        <input type="text" id="AddMember_nom" name="nom" class="form-control" placeholder="Nom"/>
                    </div>
                    <div class="form-group">
                        <label for="AddMember_prenom">Prénom</label>
                        <input type="text" id="AddMember_prenom" name="prenom" class="form-control" placeholder="Prénom"/>
                    </div>
                    <div class="form-group">
                        <label for="AddMember_prenom">Date d'arrivée</label>
                        <input type="date" id="AddMember_date_debut" name="prenom" class="form-control" placeholder=""/>
                    </div>
                    <div class="form-group">
                        <label for="AddMember_prenom">Date de fin</label>
                        <input type="date" id="AddMember_date_fin" name="prenom" class="form-control" placeholder="Prénom"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="AddMember_est_date" name="est_date">&nbsp;<label for="AddMember_est_date">Afficher les dates</label></input>
                    </div>
        </form>
    </div>
    <div class="modal-footer">
        <input type="reset" class="btn btn-secondary" data-dismiss="modal" value="Annuler" />
        <input type="submit" class="btn btn-homeband" value="Ajouter" />
    </div>
</div>
</form>
</div>
</div>

</div>