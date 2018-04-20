
<div class="container">
    <h1>Évènements</h1>
    <p>
        <a class="btn btn-outline-homeband" href="<?= base_url("groupes/evenements/ajouter"); ?>">
            <span><i class="fa fa-lg fa-plus mr-1"></i></span> Créer un évènement
        </a>
    </p>

    <?php if(isset($erreur_api) && !$erreur_api){ ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom de l'évènement</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Adresse</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($events as $event) {
                if(isset($event->details) && !empty($event->details)){
                    foreach($event->details as $detail){
                        $date = new DateTime($detail->date_heure);
                        $ts = $date->getTimestamp();
            ?>
                    <tr>
                        <th scope="row"><?= $detail->id_details_evenements ?></th>
                        <td><?= $event->nom ?></td>
                        <td><?= strftime("%d %B %Y", $ts) ?></td>
                        <td><?= strftime("%d %B %Y", $ts) ?></td>
                        <td><?= $detail->id_adresses ?></td>
                        <td>
                            <a class="btn btn-info btn-action"><i class="fa fa-edit fa-lg"></i></a>
                            <a class="btn btn-danger btn-action"><i class="fa fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
            <?php
                    }
                }
            }
            ?>

            </tbody>
        </table>
    <?php } else { ?>
        <p class="alert alert-danger">
            Erreur lors de la récupération des évènements.<br />
            Veuillez réessayer plus tard.<br>
            Si le problème persiste, veuillez contacter un administrateur.
        </p>
    <?php } ?>
</div>
