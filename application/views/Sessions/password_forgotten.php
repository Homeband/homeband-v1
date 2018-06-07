<div class="wrap">
    <div class="card">
        <div class="card-header my-card-header">
            <i class="zmdi zmdi-account zmdi-hc-lg"></i> Mot de passe oublié
        </div>
        <div class="card-body my-card-body">
            <?php echo form_open('', array('class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

                <div class="form-group row">
                    <label for="email" class="col-md-5 col-lg-4 col-form-label">Adresse E-mail</label>
                    <div class="col-sm-12 col-md-7 col-lg-8">
                        <input id="email" type="text" name="email" class="form-control" value="<?= set_value('email'); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-12 text-center" >
                        <input type="submit" value="Envoyer" class="btn btn-homeband"/>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


