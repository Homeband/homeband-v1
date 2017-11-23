


<?php echo validation_errors(); ?>

<?php echo form_open('form'); ?>

<div class="wrap">
    <h1>Inscription</h1>
  <div class="bg">
      <div class="form-group row">
          <h5 class="col-3 col-form-label">Username</h5>
          <div class="col-6">
              <input type="text" name="username" class="form-control" value="<?= set_value('username'); ?>" size=""/>
          </div>
      </div>
      <div class="form-group row">
          <h5 class="col-3 col-form-label">Password</h5>
          <div class="col-6">
              <input type="password" name="password" class="form-control" aria-describedby="passwordHelpBlock" value="<?= set_value('password'); ?>" size="10"/>
              <p id="passwordHelpBlock" class="form-text">
                  Votre mot de passe doit faire min 5 caractère, peut contenir lettre,nombre et caractère spéciaux.
              </p>
          </div>
      </div>
      <div class="form-group row">
          <h5 class="col-3 col-form-label">Password Confirm</h5>
          <div class="col-6">
              <input type="password" name="passconf" class="form-control" value="<?= set_value('passconf'); ?>" size="50"/>
          </div>
      </div>
      <div class="form-group row">
          <h5 class="col-3 col-form-label">Email</h5>
          <div class="col-6">
              <input type="text" name="email" class="form-control" value="<?= set_value('email'); ?>" size="50"/>
          </div>
      </div>
      <div class="form-group row">
          <h5 class="col-3 col-form-label">Band Name</h5>
          <div class="col-6">
              <input type="text" name="band" class="form-control" value="<?= set_value('band'); ?>" size="50"/>
          </div>
      </div>
      <div class="check_CU">
          <input type="checkbox" name="CU" value="" class="check_CU"> J'ai lu et j'accepte les <a href=""> conditions d'utilisation </a><br>
      </div>
      <div class="bouton_inscription">
          <input type="submit" value="Inscription"/>
      </div>

  </div>

</div>
</form>



