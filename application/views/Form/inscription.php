


<?php echo validation_errors(); ?>

<?php echo form_open('Form/inscription'); ?>

<div class="wrap">
    <h1 class="text-left">Inscription</h1>
    <div class="bg">
        <div class="form-group   ">
            <h5 >Username</h5>
            <input type="text" name="username" class="form-control col-md-5 col-centered" value="<?= set_value('username'); ?>" size=""/>
        </div>
        <div class="form-group">
            <h5 >Password</h5>
            <input type="password" name="password" class="form-control col-md-5 col-centered" aria-describedby="passwordHelpBlock" value="<?= set_value('password'); ?>" size="10"/>
            <p id="passwordHelpBlock" class="form-text">
                Votre mot de passe doit faire min 5 caractère, peut contenir lettre,nombre et caractère spéciaux.
            </p>
        </div>
        <div class="form-group">
            <h5>Password Confirm</h5>
            <input type="password" name="passconf" class="form-control col-md-5 col-centered" value="<?= set_value('passconf'); ?>" size="50"/>
        </div>
        <div class="form-group">
            <h5>Email</h5>
            <input type="text" name="email" class="form-control col-md-5 col-centered" placeholder="name@example.com" value="<?= set_value('email'); ?>" size="50"/>
        </div>
        <div class="form-group">
            <h5>Band Name</h5>
            <input type="text" name="band" class="form-control col-md-5 col-centered" value="<?= set_value('band'); ?>" size="50"/>
        </div>
        <div class="check_CU">
            <input type="checkbox" name="CU" value="" class="check_CU"> J'ai lu et j'accepte les <a href=""> conditions d'utilisation </a><br>
        </div>
        <div class="bouton_inscription">
            <input type="submit" value="Inscription" name="accept_terms" class="bouton"/>
        </div>
    </div>

</div>
</form>



