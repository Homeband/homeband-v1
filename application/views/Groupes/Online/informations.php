

    <h1> Informations </h1>

    <div class="row">
        <div class="col-md-4 col-lg-3 infos-nav">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Informations générales</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Liens</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Albums</a>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 infos-detail">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="row">
                        <?php echo form_open('', array('id'=> 'formInscription','class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-9')); ?>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-facebook fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Facebook" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-twitter fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Twitter" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-youtube fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Youtube" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-instagram fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Instagram" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-spotify fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Spotify" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-apple fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Itunes" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-soundcloud fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Soundcloud" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 input-group group-link">
                                <div class="input-group-addon"><i class="fa fa-bandcamp fa-lg"></i></div>
                                <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Bandcamp" value="">
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
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                </div>
            </div>
        </div>
    </div>

</div>