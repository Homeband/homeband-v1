<div class="wrap">
    <div class="card">
        <div class="card-header my-card-header">
            <i class="zmdi zmdi-account-add zmdi-hc-lg"></i> Inscription
        </div>
        <div class="card-body my-card-body">
            <?php echo form_open('Welcome/inscription', array('class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

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
                    <small id="passwordHelpBlock" class="form-text">
                        Votre mot de passe doit faire minimum 5 caractères, peut contenir lettres,nombres et caractères spéciaux.
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Confirmation du mot de passe</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input type="password" name="passconf" class="form-control" value="<?= set_value('passconf'); ?>" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Email</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input type="text" name="email" class="form-control" placeholder="nom@example.com" value="<?= set_value('email'); ?>" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Nom du groupe</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input type="text" name="band" class="form-control" value="<?= set_value('band'); ?>" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Code postal</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="code_postal" type="text" name="code_postal" class="form-control" value="<?= set_value('code_postal'); ?>" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Ville</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <select id="villes" class="form-control" id="sel1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
            </div>

            <br/>

            <div class="text-center">
                <input type="checkbox" name="CU" value="" class=""> J'ai lu et j'accepte les <a href="" class="text-center"> conditions d'utilisation </a><br>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-12 text-center" >
                    <input type="submit" value="Inscription" class="btn btn-homeband"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>



