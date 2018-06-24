
<div class="container">
    <h1>Évènements</h1>
    <p>
        <a class="btn btn-outline-homeband" href="<?= base_url("groupes/evenements/ajouter"); ?>">
            <span><i class="fa fa-lg fa-plus mr-1"></i></span> Créer un évènement
        </a>
    </p>

    <?php
    if(isset($erreur_api) && !$erreur_api){ ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
                setlocale(LC_ALL,"fr_FR.UTF8");
                foreach($events as $event) {
                    $date = new DateTime($event->date_heure);
                    $ts = $date->getTimestamp();
            ?>
                <tr>
                    <th scope="row"><?= $event->nom ?></th>
                    <td><?= strftime("%d %B %Y", $ts) ?></td>
                    <td><?= strftime("%H:%M", $ts) ?></td>
                    <td><?= $event->description ?></td>
                    <td><?= $event->prix ?></td>
                    <td>
                        <a class="btn btn-info btn-action" href="<?= base_url("groupes/evenements/$event->id_evenements/modifier") ?>"><i class="fa fa-edit fa-lg"></i></a>
                        <!-- <a class="btn btn-danger btn-action"><i class="fa fa-trash fa-lg"></i></a> -->
                    </td>
                </tr>
            <?php
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
