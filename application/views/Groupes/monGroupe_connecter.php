
<div class="container">
    <h1> Informations </h1>
    <nav class="nav nav-tabs my-nav-tabs" id="myTab" role="tablist">
        <a class="nav-item nav-link active" id="nav-infos-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Informations générales</a>
        <a class="nav-item nav-link" id="nav-liens-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Liens</a>
        <a class="nav-item nav-link" id="nav-albums-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Albums</a>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-infos-tab">
           <div>

           </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-liens-tab">
            <div class="row justify-content-md-center">
                <?php echo form_open('', array('id'=> 'formInscription','class' => 'col-sm-10 col-md-8 col-lg-8')); ?>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-facebook fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Facebook" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-twitter fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Twitter" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-youtube fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Youtube" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-instagram fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Instagram" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-spotify fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Spotify" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-apple fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Itunes" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-soundcloud fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Soundcloud" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-12 input-group group-link">
                            <div class="input-group-addon"><i class="fa fa-bandcamp fa-lg"></i></div>
                            <input id="text" type="text" name="evenements" class="form-control" placeholder="Lien Bandcamp" value="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 text-center" >
                        <input type="submit" value="Modifier" class="btn btn-homeband"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-albums-tab">
            nicolas le petit pd
        </div>
    </div>
</div>