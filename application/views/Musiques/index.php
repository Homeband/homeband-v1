
<div class="container">
    <h1>Albums</h1>
    <p>
        <a class="btn btn-outline-homeband" href="<?= base_url("groupes/musiques/ajouter"); ?>">
            <span><i class="fa fa-lg fa-plus mr-1"></i></span> Ajouter un album
        </a>
    </p>

    <?php
    if(isset($erreur_api) && !$erreur_api){ ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Date de sortie</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
                setlocale(LC_ALL,"fr_FR.UTF8");
                foreach($albums as $album) {
                    $date = new DateTime($album->date_sortie);
                    $ts = $date->getTimestamp();
            ?>
                <tr>
                    <th scope="row"><?= $album->id_albums ?></th>
                    <td><?= $album->titre ?></td>
                    <td><?= strftime("%d %B %Y", $ts) ?></td>
                    <td>
                        <a class="btn btn-info btn-action" href="<?php base_url("groupes/musiques/$album->id_albums/modifier"); ?>"><i class="fa fa-edit fa-lg"></i></a>
                        <a class="btn btn-danger btn-action"><i class="fa fa-trash fa-lg"></i></a>
                    </td>
                </tr>
            <?php
                }
            ?>

            </tbody>
        </table>
    <?php } else { ?>
        <p class="alert alert-danger">
            Erreur lors de la récupération des albums<br />
            Veuillez réessayer plus tard.<br>
            Si le problème persiste, veuillez contacter un administrateur.
        </p>
    <?php } ?>
</div>
