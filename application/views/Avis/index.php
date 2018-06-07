<h1> Avis des utilisateurs </h1>
<?php if(isset($erreur_api) && !$erreur_api) { ?>
    <table id="tabAvis" class="table table-hover table-bordered table-vertical-center table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom de l'utilisateur</th>
            <th scope="col">Date</th>
            <th scope="col">Commentaire</th>
            <th scope="col">Validé</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($comments as $avis){
            $date = new DateTime($avis->date_ajout);
            $ts = $date->getTimestamp();

            $statut = 0;
            $status_txt = "En attente";
            if($avis->est_verifie) {
                if (!$avis->est_accepte) {
                    $statut = 1;
                    $status_txt = "Non";
                } else {
                    $statut = 2;
                    $status_txt = "Oui";
                }
            }
            ?>
            <tr>
                <td>
                    <?= $avis->id_avis ?>
                </td>
                <td>
                    <?= $avis->username ?>
                </td>
                <td data-order="<?= $ts ?>">
                    <?= strftime("%d %B %Y", $ts) ?>
                </td>
                <td>
                    <?= $avis->commentaire ?>
                </td>
                <td>
                    <?php
                    switch($statut){
                        case 0:
                            ?>
                            <span class="badge badge-pill badge-info">En attente</span>

                            <?php
                            break;

                        case 1: ?>
                            <span class="badge badge-pill badge-danger">Non</span>
                            <?php
                            break;

                        case 2:
                            ?>
                            <span class="badge badge-pill badge-success">Oui</span>
                            <?php
                            break;
                    }
                    ?>
                </td>
                <td data-order="<?= $statut ?>">
                    <?php
                    switch($statut){
                        case 0:
                            ?>
                            <button class="btn btn-danger"><i class="fa fa-times-circle fa-lg"></i></button>
                            <button class="btn btn-success"><i class="fa fa-check-circle fa-lg"></i></button>

                            <?php
                            break;

                        case 1: ?>
                            <button class="btn btn-success"><i class="fa fa-check-circle fa-lg"></i></button>
                            <?php
                            break;

                        case 2:
                            ?>
                            <button class="btn btn-danger"><i class="fa fa-times-circle fa-lg"></i></button>
                            <?php
                            break;
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>
<?php } else { ?>
    <p class="alert alert-danger">
        Erreur lors de la récupération des avis des utilisateurs.<br />
        Veuillez réessayer plus tard.<br>
        Si le problème persiste, veuillez contacter un administrateur.
    </p>
<?php }