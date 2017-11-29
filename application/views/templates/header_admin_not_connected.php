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
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/form_inscription.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/group_space.css') ?>" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-md navbar-custom fixed-top">
    <a class="navbar-brand" href="<?= base_url('Welcome/groups') ?>">
        <img class="logo-header" src="<?= base_url('assets/images/Homeband_OneLine_White.png') ?>" alt="Homeband" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Welcome/connexion') ?>">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Welcome/inscription') ?>">Inscription</a>

            </li>
        </ul>
    </div>


</nav>

<main role="main" class="container-fluid my-fluid">
    <div class="starter-template my-fluid ">


        <?php

        $this->flash->setFlashMessages();

        if ($this->session->flashdata('flash_messages')) {
            $flashMessages = $this->session->flashdata('flash_messages');
            foreach ($flashMessages as $errorType => $messages) {
                foreach ($messages as $message) { ?>
                    <div class="alert alert-perso alert-<?= $errorType; ?>">
                        <?= $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php }
            }
        }
        ?>
