<?php echo validation_errors(); ?>

<?php echo form_open('Form/connexions'); ?>

<div class="wrap">
    <h1 class="text-left">Connexion</h1>
    <div class="bg">
        <div class="form-group   ">
            <h5 >Nom d'utilisateur</h5>
            <input type="text" name="username" class="form-control col-md-5 col-centered" value="<?= set_value('username'); ?>" size=""/>
        </div>
        <div class="form-group">
            <h5 >Mot de passe</h5>
            <input type="password" name="password" class="form-control col-md-5 col-centered" aria-describedby="passwordHelpBlock" value="<?= set_value('password'); ?>" size="10"/>
        </div>
        <div class="check_CU">
           <p><a href="">Mot de passe oublié</a></p>
        </div>
        <div class="bouton_inscription">
            <input type="submit" value="Connexion" class="bouton"/>
        </div>
    </div>

</div>
</form>
