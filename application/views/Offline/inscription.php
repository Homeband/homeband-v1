<div class="wrap">
    <div class="card">
        <div class="card-header my-card-header">
            <i class="zmdi zmdi-account-add zmdi-hc-lg"></i> Inscription
        </div>
        <div class="card-body my-card-body">
            <?php echo form_open('groupes/inscription', array('id'=> 'formInscription','class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

            <div class="form-group row">
                <label for="login" class="col-md-5 col-lg-4 col-form-label">Nom d'utilisateur</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="login" type="text" name="login" class="form-control" value="<?= set_value('username'); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="mot_de_passe" class="col-md-5 col-lg-4 col-form-label">Mot de passe</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="mot_de_passe" type="password" name="mot_de_passe" class="form-control " value="<?= set_value('password'); ?>" />
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
                <label for="nom" class="col-md-5 col-lg-4 col-form-label">Nom du groupe</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="nom" type="text" name="nom" class="form-control" value="<?= set_value('band'); ?>" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="style" class="col-md-5 col-lg-4 col-form-label">Style de musique</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <select id="style" name="style" class="form-control">
                        <option disabled="disabled" value="0" selected="selected">Choisissez un style</option>
                        <?php
                        if (isset($styles) && is_array($styles) && !empty($styles)) {
                            foreach ($styles as $item) {
                                ?>
                                <option value="<?= $item->id_styles ?>"><?= $item->nom ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="code_postal" class="col-md-5 col-lg-4 col-form-label">Code postal</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="code_postal" type="text" name="code_postal" class="form-control" value="<?= set_value('code_postal'); ?>" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="ville" class="col-md-5 col-lg-4 col-form-label">Ville</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <select id="villes" name="ville" class="form-control"> </select>
                </div>
            </div>

            <br/>

            <div class="text-center">
                <input type="checkbox" id="checkCU" name="CU" value="" class=""> J'ai lu et j'accepte les <a target="_blank" href="<?= base_url("groupes/cgu")?>" class="text-center"> conditions générales d'utilisation </a><br>
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



