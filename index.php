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
        echo '<meta http-equiv="refresh" content="0; URL=/" />';
    }

    if (isset($_POST['filetodelete'])) {
        echo '<script>';
        echo 'console.log("'.$_POST['filetodelete'].'")';
        echo '</script>';
        unlink("./uploads/" . $_POST['filetodelete']);
        echo '<meta http-equiv="refresh" content="0; URL=/" />';
    }

    if (isset($_POST['deco'])) {
        session_destroy();

        echo '<meta http-equiv="refresh" content="0; URL=/" />';
    }
    ?>
    <title>Benigne</title>
    <!--<script type="text/javascript" src="myscript.js"></script>-->
    <script type="text/javascript">

        function updateFile(event) {
            let name = event["target"]["files"][0]["name"];
            name = name.replace(" ", "_");
            document.getElementById("filename").value = name;
        }

        function onload() {
            let popup = document.getElementById("connectionPopup");
            if (popup == null)
                return;
            popup.style.display = 'none';
        }

        function openConnectionMenu() {
            let popup = document.getElementById("connectionPopup");
            if (popup.style.display == 'none') {
                window.console.log("caca");
                popup.style.display = 'block';
                document.getElementById("cross").style.display = "block";
                document.getElementById("profile").style.display = "none";
            }
            else {
                popup.style.display = 'none';
                document.getElementById("cross").style.display = "none";
                document.getElementById("profile").style.display = "block";
            }
        }

        function checkSelection(e) {
            let option = document.getElementById("filetodelete");
            if (option.options[option.selectedIndex].value == "none")
                e.preventDefault();
        }


    </script>
    <!--<link rel="stylesheet" href="css.css">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css">
    <link href='https://css.gg/profile.css' rel='stylesheet'>
    <link href='https://css.gg/math-plus.css' rel='stylesheet'>
    <!--    <link rel="icon" type="image/png" href="logo.png" />-->
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
            border-color: #afafaf;
            border-radius: 0.25em;
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
            height: 56px;
            background: var(--navbar-color);
        }

        #dotborder {
            position: absolute;
            top: 3px;
            right: 9px;
            width: 50px;
            height: 50px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            background: white;
        }

        #dotbg {
            position: absolute;
            top: 4px;
            right: 10px;
            width: 48px;
            height: 48px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            background: var(--navbar-color);
        }

        #githubnavbar {
            position: absolute;
            top: 5px;
            right: 11px;
            width: 46px;
            height: 46px;
            z-index: 1;

        }

        #connectionPopup {
            display: none;
            background-color: rgba(122, 122, 122,1);
            width: 15em;
            height: 6em;
            border-radius: 1em;
            position: absolute;
            left: 2em;
            top: 3.3em;
            margin-bottom: 1em;
        }

        #connectioninput {
            background-color: var(--navbar-color);
        }
        select {
            width: 15em;
        }


    </style>
</head>

<body onload="onload();">
<div class="navbar">

    <?php
    if (!isset($_SESSION['pseudo']) or $_SESSION['pseudo'] == null) {
    ?>
    <span class="gg-profile" id="profile" style="margin-left: 1.4em; transform: scale(1.8); cursor: pointer" onclick="openConnectionMenu();"></span>
    <img src="cross.png" id="cross" style="padding-bottom: 3em; padding-top:2.5em; padding-left: 0.5em; transform: rotate(45deg); width: 3.6em;
    position: absolute; display: none; cursor: pointer" onclick="openConnectionMenu()">
    <div id="connectionPopup">

        <form action="/" method="post" class="searchandupload" style="padding-left: 1.625em;">
            <span>Se connecter :</span>
            <div ><input id="connectioninput" type="text" name="pseudo" ></div>
            <input type="submit" value="connect" style="background: linear-gradient( <?php echo random_int(0, 360) ?> deg, var(--button-color1), var(--button-color2));">
        </form>
        <?php
        }
        ?>
    </div>

    <label style="margin-left: 1em;
    position: absolute;
    padding-top: 0.75em;"><?php
        if (isset($_SESSION['pseudo'])) {
            if ($_SESSION['pseudo'] != null) {
                echo $_SESSION['pseudo'] . ' - ' . $_SESSION['role'];
            }
        }
        ?></label>
    <a href="https://github.com/BenigneDemetz/site" target="_blank">
        <span id="dotborder"></span>
        <span id="dotbg"></span>
        <img src="githubviolet.png" id="githubnavbar">
    </a>
    <?php
    if (isset($_SESSION['pseudo'])) {
        if ($_SESSION['pseudo'] != null) {
            $string = file_get_contents("profiles.json");
            $json_a = json_decode($string, true);
            echo '
                    <form action="index.php" method="post" class="searchandupload" style="position: absolute; right: 5em; padding-top: 0.65em;">
                        <input type="submit" value="Se déconnecter" style="background: linear-gradient(' . random_int(0, 360) . 'deg, var(--button-color1), var(--button-color2));" name="deco">
                    </form>';
        }
    }
    ?>
</div>


<div style="margin: 1em 1em 1em 1em;">
    <div class="searchandupload">

        <div style="display: flex; flex-direction: row; padding-bottom: 12px; border-bottom: rgba(145,145,145,0.5);
    border-bottom-width: 1px;border-bottom-style: double; height: fit-content; width: 100%">
            <form action="index.php" method="get" class="searchandupload" style="">
                <span>Rechercher :</span>
                <div class="inputtext"><input type="text" name="id"></div>
                <input type="submit" value="Chercher"
                       style="background: linear-gradient(<?php echo random_int(0, 360) ?>deg, var(--button-color1), var(--button-color2));">
            </form>
            <?php
            if (isset($_SESSION) and $_SESSION['role'] == "admin") {
            ?>
            <form action="/" method="post" style="position: absolute; right: 1em" onsubmit="checkSelection(event)">
                <select name="filetodelete" id="filetodelete">
                    <option style="width: min-content" value="none">Selectionner un fichier</option>
                    <?php
                    $files = scandir('./uploads/');
                    foreach ($files as $file) {
                        if ($file == "." or $file == "..") {
                            continue;
                        }
                        echo '<option value="' . $file .'">' . $file . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Supprimer" style="background: linear-gradient(<?php echo random_int(0, 360) ?>deg, var(--button-color1), var(--button-color2));">
            </form>
            <?php
            }
            ?>
        </div>


        <form action="upload.php" method="post" enctype="multipart/form-data" class="searchandupload" style="padding-top: 6px; padding-bottom: 12px; border-bottom: rgba(145,145,145,0.5);
          border-bottom-width: 1px;border-bottom-style: double;">


            <div class="file-input">
                <input type="file" name="filetoup" id="file" class="file" required onchange="updateFile(event)">
                <label for="file">Select file</label>
                <span class="text-upload">Nom du fichier :</span>
                <input type="text" name="name" class="custom-file-input" id="filename" required>
            </div>


            <input type="submit" value="Upload fichier" name="submit"
                   style="background: linear-gradient(<?php echo random_int(0, 360) ?>deg, var(--button-color1), var(--button-color2));">

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

            <input type="submit" value="Upload lien" name="submit"
                   style="background: linear-gradient(<?php echo random_int(0, 360) ?>deg, var(--button-color1), var(--button-color2));">

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


            $files = scandir('./uploads/');
            foreach ($files as $file) {
                if ($file == "." or $file == "..") {
                    continue;
                }
                echo '<a href=uploads/' . $file . ' target=”_blank” style="overflow: hidden; text-overflow-start: clip; text-overflow-middle: ellipsis; text-overflow-end: clip; text-overflow-min-width: 0 3ch;">' . $file . '</a>';
            }

        ?>
    </div>
</div>
</body>
</html>
