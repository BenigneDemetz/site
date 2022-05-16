<!DOCTYPE html>
<html>
<head>
    <?php

    session_start();
    if (isset($_POST['pseudo'])) {
        $pseudo = $_POST['pseudo'];
        $string = file_get_contents("profiles.json");
        $json_a = json_decode($string, true);
        if (in_array($pseudo, array_keys($json_a))) {
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['role'] = $json_a[$pseudo]['role'];

        }
        else {
            echo "pas connecté";
        }
    }

    if (isset($_POST['deco'])) {
        session_destroy();

        echo '<meta http-equiv="refresh" content="0; URL=/" />';
    }
    ?>
    <title>Benigne</title>
    <!--<script type="text/javascript" src="myscript.js"></script>-->
    <script type="text/javascript">
        $("#file").change(function(){
            console.log("caca");
        });
    </script>
    <!--<link rel="stylesheet" href="css.css">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        :root {
            --bg-color: #060615;
            --button-color1: #be6eff;
            --button-color2: #2d27a1;
            --navbar-color: #392670;
            --text-color: antiquewhite;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            flex-direction: column;
            color: var(--text-color);
            text-d
        }

        a {
            color: var(--text-color);
        }

        input[type="file"] {
        }


        input[type="text"] {
            border-color: #4b4b4b;
            border-width: 1px;
            width: available;
            background: var(--bg-color);
            box-shadow: 0px 0px 0px;
            color: var(--text-color);
        }

        input[type="submit" i] {
            width: 10em;
            border-radius: 0.8em;
            color: var(--text-color);
            border-width: 0px;
        }

        .file {
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
            position: absolute;

        }

        .file-input label {
            display: block;
            position: relative;
            width: 200px;
            height: 2em;
            border-radius: 0.8em;
            background: linear-gradient(<?php echo random_int(0,360)?>deg, var(--button-color1), var(--button-color2));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            cursor: pointer;
            margin-bottom: 1em;
        }

        #fileslist {
            display: flex;
            flex-direction: row;
            gap: 1em;
            flex-flow: row wrap;
        }

        .searchandupload {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .navbar {
            width: available;
            height: 3.5em;
            background: var(--navbar-color);
        }

    </style>
</head>

<body>
<div class="navbar">
    <label style="margin-left: 1em"><?php
        if (isset($_SESSION['pseudo'])) {
            if ($_SESSION['pseudo'] != null) {
                echo $_SESSION['pseudo'] . ' - ' . $_SESSION['role'];
        }
        }
        ?></label>
    <?php
    if (isset($_SESSION['pseudo'])) {
    if ($_SESSION['pseudo'] != null) {
        $string = file_get_contents("profiles.json");
        $json_a = json_decode($string, true);
        echo '
                    <form action="index.php" method="post" class="searchandupload" style="position: absolute; right: 1em">
                        <input type="submit" value="Se déconnecter" style="background: linear-gradient(' . random_int(0,360) . 'deg, var(--button-color1), var(--button-color2));" name="deco">
                    </form>';
    }}
    ?>
</div>
<div style="margin: 1em 1em 1em 1em;">
<div class="searchandupload">

    <div style="display: flex; flex-direction: row; padding-bottom: 12px; border-bottom: rgba(145,145,145,0.5);
    border-bottom-width: 1px;border-bottom-style: double; height: fit-content; width: 100%">
        <form action="index.php" method="get" class="searchandupload" style="">
            <span>Rechercher :</span>
            <div class="inputtext"><input type="text" name="id"></div>
            <input type="submit" value="Chercher" style="background: linear-gradient(<?php echo random_int(0,360)?>deg, var(--button-color1), var(--button-color2));">
        </form>
        <?php
        if (!isset($_SESSION['pseudo']) or $_SESSION['pseudo'] == null) {
                echo '
        <form action="index.php" method="post" class="searchandupload" style="position: absolute; right: 1em">
            <span>Se connecter :</span>
            <div class="inputtext"><input type="text" name="pseudo" placeholder="sabri"></div>
            <input type="submit" value="connect" style="background: linear-gradient(' . random_int(0,360) . 'deg, var(--button-color1), var(--button-color2));">
        </form>';
            }
        ?>
    </div>


    <form action="upload.php" method="post" enctype="multipart/form-data" class="searchandupload" style="padding-top: 6px; padding-bottom: 12px; border-bottom: rgba(145,145,145,0.5);
          border-bottom-width: 1px;border-bottom-style: double;">


        <div class="file-input">
            <input type="file" name="filetoup" id="file" class="file" required>
            <label for="file">Select file</label>
            <span class ="text-upload">Nom du fichier :</span>
            <input type="text" name="name" class="custom-file-input" required>
        </div>


        <input type="submit" value="Upload fichier" name="submit" style="background: linear-gradient(<?php echo random_int(0,360)?>deg, var(--button-color1), var(--button-color2));">

    </form>
    <form action="index.php" method="post" class="searchandupload" style="padding-top: 6px; padding-bottom: 12px; border-bottom: rgba(145,145,145,0.5);
          border-bottom-width: 1px;border-bottom-style: double;">

        <div style="display: flex; flex-direction: column; gap: 4px">
            <div>
                <span style="padding-right: 4px">Lien :</span>
                <input type="text" name="link" required="">
            </div>
            <div>
                <span style="padding-right: 4px">Nom :</span>
                <input type="text" name="name" required="">
            </div>
        </div>

        <input type="submit" value="Upload lien" name="submit" style="background: linear-gradient(<?php echo random_int(0,360)?>deg, var(--button-color1), var(--button-color2));">

    </form>
    <br>
</div>

<div id="fileslist">
    <?php


    if (isset($_GET['id'])) {

        if ($_GET['id'] == 'timbres') {
            echo '<a href="timbresb.pdf" download>timbres</a>';
        }

        if ($_GET['id'] == 'film') {
            echo ' <meta http-equiv="refresh" content="0; URL=helo/film" />';
        }

        $string = file_get_contents("liens.json");
        $json_a = json_decode($string);
        foreach ($json_a as $key => $value) {
            if ($_GET['id'] == $key) {
                echo ' <meta http-equiv="refresh" content="0; URL=' . $value . '" />';
            }
        }

    }


    if (isset($_POST['link'])) {

        $link = $_POST['link'];
        $name = $_POST['name'];

        $string = file_get_contents("liens.json");
        $json_a = json_decode($string, true);
        $json_a[$name] = $link;
        $fp = fopen('liens.json', 'w');
        fwrite($fp, json_encode($json_a));
        fclose($fp);

    }

    if (isset($_SESSION['pseudo'])) {
        if ($_SESSION['pseudo'] != null) {
            if ($_SESSION['pseudo']) {
                echo "Je n'ai commencé à faire que site qu'il n'y a qu'une ou deux semaine pour partager des fichiers avec des amis.
                Il me permet juste de vous montrer que j'aime développer lorsque j'ai un but derriere et pas developper betement comme à l'iut.
                Je continue de le modifier au fil du temps. Je n'ai fais le formulaire de connection que ce week-end.";
            }
        }
    }
    else {
        $files = scandir('./uploads/');
        foreach ($files as $file) {
            if ($file == "." or $file == "..") {
                continue;
            }
            echo '<a href=uploads/' . $file . ' target=”_blank” style="overflow: hidden; text-overflow-start: clip; text-overflow-middle: ellipsis; text-overflow-end: clip; text-overflow-min-width: 0 3ch;">' . $file . '</a>';
        }
    }

    ?>
</div>
</div>
</body>
</html>
