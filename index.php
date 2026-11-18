<?php


require_once 'Day.php';
require_once 'Note.php';
require_once 'DayList.php';
require_once 'Notes.php';
require_once 'Serialization.php';
require_once 'Deserialization.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['linkedList']))
{
    $_SESSION['linkedList'] = new DayList();
    $temp = new DateTime();
    $temp->setTime(0, 0);
    $_SESSION['linkedList']->add(New Day($temp));
}
if (isset($_POST['destroysessButton'])) {
    session_destroy();
}
if (isset($_POST['previousButton'])) {
    $_SESSION['linkedList']->goToPrevious();
}
if (isset($_POST['nextButton'])) {
    $_SESSION['linkedList']->goToNext();
}
if (isset($_POST['startButton'])) {
    $_SESSION['linkedList']->goToFirst();
}
if (isset($_POST['endButton'])) {
    $_SESSION['linkedList']->goToLast();
}

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
    <h2><?php if (!is_null($_SESSION['linkedList']->currentDay))
    {echo $_SESSION['linkedList']->currentDay->date->format('d.m.Y');} ?></h2>
    <p>Days: <?= $_SESSION['linkedList']->count ?> | Notes on this day: <?= $_SESSION['linkedList']->currentDay?->listOfNotes->count ?? 0 ?></p>
</header>
<main>
<nav>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="submit" name="destroysessButton" value="DESTROY SESSION">
    </form>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="submit" name="previousButton" value="Previous day">
    </form>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="submit" name="nextButton" value="Next day">
    </form>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="submit" name="startButton" value="First day">
    </form>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="submit" name="endButton" value="Last day">
    </form>
</nav>
    <?php
if (!$_SESSION['linkedList']->currentDay->listOfNotes->count == 0) {
        for ($i = 0; $i < $_SESSION['linkedList']->currentDay->listOfNotes->count; $i++) {?>
            <article>
                    <?php
                    echo "<h2>";
                    echo $i;
                    echo ": ";
                    echo $_SESSION['linkedList']->currentDay->listOfNotes[$i]->header;
                    echo "</h2>";
                    echo nl2br(($_SESSION['linkedList']->currentDay->listOfNotes[$i]->content));
                    ?>
                <br>
                <form method="post" action="Notes.php" enctype="multipart/form-data"
                      onsubmit="return confirm(<?= htmlspecialchars(json_encode("Delete this note?")) ?>);">
                    <input type="hidden" name="noteIndex" value="<?= $i ?>">
                    <input type="submit" name="deleteNoteButton" value="delete">
                </form>
            </article>

            <?php }} ?>
    <form id="login" action="Notes.php" method="post">
        <fieldset>
            <legend>New note</legend>
            <label for="date">Date</label>
            <input id="date" name="date" type="date" required
                   value="<?= $_SESSION['linkedList']->currentDay?->date->format('Y-m-d') ?? date('Y-m-d') ?>">
            <br>
            <label for="header">header</label>
            <input id="header" name="header" type="text" maxlength="20">
            <br>
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="5" cols="40" maxlength="1000"></textarea>
            <br>
            <label for="Add note">Add note</label>
            <input type="submit" name="addNoteButton">
        </fieldset>
    </form>
</main>
<footer>
    <form method="post" action="Serialization.php">
        <input type="submit" name="saveButton" value="Save into a file"/>
    </form>
        <form method="post" action="Deserialization.php" enctype="multipart/form-data">
            <input type="file" name="diary" accept=".json,application/json" required>
            <input type="submit" name="loadButton" value="Load diary">
        </form>
</footer>
</body>

</html>

