<h1> Profil </h1>

<div class="container">

    <h4>Votre email</h4>
    <div class="infos-detail mb-4">
        <?php echo form_open('groupes/me', array('id' => 'formProfil', 'class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

        <div class="form-group row">
            <label for="username" class="col-md-5 col-lg-4 col-form-label">Email</label>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <input id="text" type="text" name="email" class="form-control" value="<?= $group->email; ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 col-md-12 text-center">
                <input type="submit" value="Modifier" class="btn btn-homeband"/>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="container">
    <h4>Modifier votre mot de passe</h4>
    <div class="infos-detail">
        <?php echo form_open(base_url('groupes/me/password'), array('id' => 'formInscription', 'class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>
        <div class="form-group row">
            <label for="username" class="col-md-5 col-lg-4 col-form-label">Nouveau mot de passe </label>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <input type="password" name="password" class="form-control" value="" size="50"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-md-5 col-lg-4 col-form-label">Confirmation</label>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <input type="password" name="confirm" class="form-control" value="" size="50"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-12 text-center">
                <input type="submit" value="Modifier" class="btn btn-homeband"/>
            </div>
        </div>
        </form>
    </div>
</div>
