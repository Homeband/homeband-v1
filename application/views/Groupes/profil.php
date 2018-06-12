<h1> Profil </h1>
<h3> Votre email</h3>

    <div class="container">
        <div class="card-body my-card-body">
            <?php echo form_open('', array('id'=> 'formInscription','class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Nouvelle adresse mail </label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="text" type="text" name="evenements" class="form-control" value="votre adresse mail">
                </div>
            </div>
            <br/>

            <div class="form-group row">
                <div class="col-sm-12 col-md-12 text-center" >
                    <input type="submit" value="Modifier" class="btn btn-homeband"/>
                </div>
            </div>
            </form>
        </div>
    </div>
<div class="container">
<h3> Changer votre mot de passe </h3>
        <div class="card-body my-card-body">
            <?php echo form_open('', array('id'=> 'formInscription','class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Ancien mot de passe</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="password" type="text" name="evenements" class="form-control" value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Nouveau mot de passe </label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input type="password" name="salle" class="form-control"  value="" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Réécrire le mot de passe</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input type="password" name="date" class="form-control" value="" size="50"/>
                </div>
            </div>
            <br/>
            <div class="form-group row">
                <div class="col-sm-12 col-md-12 text-center" >
                    <input type="submit" value="Modifier" class="btn btn-homeband"/>
                </div>
            </div>
            </form>
        </div>
</div>
