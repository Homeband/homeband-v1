<?php

?>

<div class="wrap">
    <div class="card">
        <div class="card-header my-card-header">
            <i class="zmdi zmdi-account zmdi-hc-lg"></i> Connexion
        </div>
        <div class="card-body my-card-body">
            <?php echo form_open('Welcome/connexion', array('class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

                <div class="form-group row">
                    <label for="username" class="col-md-5 col-lg-4 col-form-label">Nom d'utilisateur</label>
                    <div class="col-sm-12 col-md-7 col-lg-8">
                        <input id="username" type="text" name="username" class="form-control" value="<?= set_value('username'); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-lg-4 col-form-label">Mot de passe</label>
                    <div class="col-sm-12 col-md-7 col-lg-8">
                        <input id="password" type="password" name="password" class="form-control " value="<?= set_value('password'); ?>" />
                    </div>
                </div>
                <br />
                <div class="form-group row">
                    <div class="col-sm-12 col-md-12 text-center" >
                        <input type="submit" value="Connexion" class="btn btn-homeband"/>
                    </div>
                </div>

                <div>
                    <p class="centered"><a href="#">Mot de passe oublié ?</a></p>
                </div>

            </form>
        </div>
    </div>
</div>


