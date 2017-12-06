<!DOCTYPE html>

<html lang="fr">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">

    <!-- Theme Page Title -->
    <title>Homeband - Discover you local music !</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="HomeBand">
    <meta name="author" content="Bruyère Christopher & Gérard Nicolas">

    <!-- CSS Links -->

    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/group_space.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/Informations.css') ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.4.2/b-print-1.4.2/fh-3.1.3/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/datatables.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://use.fontawesome.com/a22cd7d676.js"> </script>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-custom fixed-top">
    <a class="navbar-brand" href="#">
        <img class="logo-header" src="<?= base_url('assets/images/Homeband_OneLine_White.png') ?>" alt="Homeband" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupes') ?>">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupes/informations') ?>">Informations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupes/evenements') ?>">Évènements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupes/profil') ?>">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupes/commentaires') ?>">Commentaires</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupes/newsletter') ?>">Newsletter</a>
            </li>
        </ul>
        <ul class="navbar-nav pull-right">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('groupes/deconnexion') ?>">Déconnexion</a>
            </li>

        </ul>
    </div>


</nav>

<main role="main" class="container-fluid my-fluid">
    <div class="starter-template my-fluid ">
        <div class="container main-container">

        <?php
            $errors = validation_errors();
            if(isset($errors)){
                $this->flash->setMessage($errors, $this->flash->getErrorType());
            }

            $this->flash->setFlashMessages();

            if ($this->session->flashdata('flash_messages')) {
                $flashMessages = $this->session->flashdata('flash_messages');
                foreach ($flashMessages as $errorType => $messages) {
                    foreach ($messages as $message) { ?>
                        <div class="alert alert-<?= $errorType; ?>"> <?= $message; ?> </div>
                    <?php }
                }
            }
        ?>


