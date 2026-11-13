<?php


require_once 'index.php';
require_once 'Day.php';
require_once 'Note.php';
require_once "Serialization.php";
require_once "Deserialization.php";
session_start();



$days = [];
$currentDay = new Day(date('l jS\; F Y'), null, null);

$currentDay->listOfNotes[$currentDay->getNoteCount()] = new Note($currentDay, "big things happening", "content content content");
$_SESSION["currentDay"]= $currentDay;
$days[] = $currentDay;
$_SESSION["days"]= $days;
/*$db = new PDO('mysql:host=localhost;dbname=DELTA_3B;charset=utf8',
    'root',
    '',
    [PDO::ATTR_EMULATE_PREPARES => false]
);

$sql = "SELECT id, name, fee, vacancies FROM courses";

$stmt = $db->query($sql);

$kurzy = $stmt->fetchAll(PDO::FETCH_CLASS, Kurz::class);*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Diary</h1>
    <h2><?php echo"$currentDay->date" ?></h2>
</header>
<main>

    <?php
        for ($i = 0; $i < $currentDay->getNoteCount(); $i++) {?>
            <article>
                    <?php
                    echo "<h2>";
                    echo $currentDay->listOfNotes[$i]->position;
                    echo ": ";
                    echo $currentDay->listOfNotes[$i]->header;
                    echo "</h2>";
                    echo $currentDay->listOfNotes[$i]->content;
                    ?>
                <br>
                <button>Delete</button>
            </article>
        <?php
    }
    ?>

    <form id="login" action="Notes.php" method="post">
        <fieldset>
            <legend>New note</legend>
            <label for="header">name:</label>
            <input id="header" name="header" type="text" maxlength="20">
            <br>
            <label for="content">Content</label>
            <input id="content" name="content" type="text" maxlength="1000">
            <br>
            <label for="Add note">Add note</label>
            <input type="submit">

        </fieldset>
    </form>
</main>
<footer>
    <form method="post" action="Serialization.php">
        <input type="submit" name="saveButton"
               value="Save into a file"/>

        <input type="submit" name="loadButton"
               value="Load from a file"/>
    </form>
</footer>
</body>
</html>

