<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700"  type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/form.css">

    <?php if(isset($title)) :?>
        <title>TO DO | <?= htmlspecialchars($title) ?> </title>
    <?php else : ?>
        <title> TO DO</title>
    <?php endif ?>
</head>
<body>
<?php if (isset($_SESSION['logged_in'])): ?>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#hambureger-drop" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand"><a href="/todos">TODO</a></div>
            </div>

            <div class="collapse navbar-collapse" id="hambureger-drop">
                <ul class="nav navbar-nav text-center">
                    <li class=""><a href="todos">LISTS</a></li>
                    <li><a class="hidden-lg hidden-md hidden-sm" href="/logout">LOG OUT</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="navbar-text hidden-xs">Singed in as <?php if(isset($_SESSION['logged_in'])) echo htmlspecialchars($_SESSION['name']); ?></li>
                    <a class="btn navbar-btn hidden-xs" href="logout">LOG OUT </a>
                </ul>
            </div>
        </div>
    </nav>
<?php else : ?>
    <div class="page-header text-center h1">Todo</div>
<?php endif ?>
<section id="generated">
    <div class="container">
