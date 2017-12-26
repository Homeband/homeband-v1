

    <h1>Informations sur le groupe</h1>

    <div class="row">
        <div class="col-md-4 col-lg-3 infos-nav">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Informations générales</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Liens</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Albums</a>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 infos-detail">
            <div class="row">
                <?php echo form_open('groupes/informations', array('id'=> 'formInscription','class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-9')); ?>
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Informations globales -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="form-group">
                            <label for="nom">Nom du groupe</label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom de votre groupe" value="<?= $groupe->nom ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="biographie">Biographie</label>
                            <textarea id="biographie" name="biographie" class="form-control" rows="5" placeholder="Donnez ici une biographie de votre groupe"><?=
                                $groupe->biographie
                            ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="contacts">Informations de contact</label>
                            <textarea id="contacts" name="contacts" class="form-control" rows="5" placeholder="Ces informations permettrons aux utilisateur de pouvoir vous contacter."><?= trim($groupe->contacts); ?></textarea>
                        </div>

                    </div>

                    <!-- Liens -->
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-facebook fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_facebook" class="form-control" placeholder="Lien Facebook" value="<?= $groupe->lien_facebook ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-twitter fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_twitter" class="form-control" placeholder="Lien Twitter" value="<?= $groupe->lien_twitter ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-youtube fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_youtube" class="form-control" placeholder="Lien Youtube" value="<?= $groupe->lien_youtube ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-instagram fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_instagram" class="form-control" placeholder="Lien Instagram" value="<?= $groupe->lien_instagram ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-spotify fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_spotify" class="form-control" placeholder="Lien Spotify" value="<?= $groupe->lien_spotify ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-apple fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_itunes" class="form-control" placeholder="Lien Itunes" value="<?= $groupe->lien_itunes ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-soundcloud fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_soundcloud" class="form-control" placeholder="Lien Soundcloud" value="<?= $groupe->lien_soundcloud ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 input-group group-link">
                                    <div class="input-group-addon"><i class="fa fa-bandcamp fa-lg"></i></div>
                                    <input id="text" type="text" name="lien_bandcamp" class="form-control" placeholder="Lien Bandcamp" value="<?= $groupe->lien_bandcamp ?>">
                                </div>
                            </div>
                    </div>

                    <!-- Albums -->
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 " >
                        <input type="submit" value="Modifier" class="btn btn-homeband"/>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

</div>