<h1> Evenements </h1>

<div class="input-group " >
    <h3> Prochain </h3>
    <input type="submit" value="Ajouter" class="btn btn-homeband"/>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nom de l'évènement</th>
        <th scope="col">Location</th>
        <th scope="col">Date</th>
        <th scope="col">Heure</th>
        <th scope="col">Adresse</th>


    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Festival de rock</td>
        <td>Botannique</td>
        <td>25 octobre</td>
        <td>17h</td>
        <td>24 centre de Bruxelles 1000 Bruxelles</td>
        <td> <input type="submit" value="Supprimer" class="btn btn-homeband"/> </td>
    </tr>
    </tbody>
</table>
<div class="container">
<h3> Ajouter </h3>
        <div class="card-body my-card-body">
            <?php echo form_open('', array('id'=> 'formInscription','class' => 'col-sm-10 col-md-8 col-lg-7 col-centered')); ?>

            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Nom de lévènement</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="evenements" type="text" name="evenements" class="form-control" value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Salle </label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input type="text" name="salle" class="form-control"  value="" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Date</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input type="text" name="date" class="form-control" value="" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Heure</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="heure" type="text" name="heure" class="form-control" value="<?= set_value('code_postal'); ?>" size="50"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-5 col-lg-4 col-form-label">Adresse</label>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <input id="adresse" name="adresse" class="form-control"> </input>
                </div>
            </div>

            <br/>

            <div class="form-group row">
                <div class="col-sm-12 col-md-12 text-center" >
                    <input type="submit" value="Ajouter" class="btn btn-homeband"/>
                </div>
            </div>
            </form>
        </div>
</div>



