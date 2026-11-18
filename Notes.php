<?php
require_once 'Day.php';
require_once 'Note.php';
require_once 'DayList.php';
require_once 'Listie.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['addNoteButton']) && isset($_SESSION['linkedList']))
{
    $days = $_SESSION['linkedList'];
    $header = $_POST["header"];
    $content = $_POST["content"];
    $date = DateTime::createFromFormat('!Y-m-d', $_POST["date"]);
        $note = new Note($content, $header);
        $current = $days->currentDay;
        $wanted = $date->format('Y-m-d');
        $days->insertByDate(new Day($date))->listOfNotes->add($note);


    header("Location: index.php");
    exit;
}
if (isset($_POST['deleteNoteButton']) && isset($_SESSION['linkedList']))
{
    $days = $_SESSION['linkedList'];
    $day = $days->currentDay;
    $i = $_POST['noteIndex'];

        $day->listOfNotes->remove($i);

        if ($day->listOfNotes->count === 0)
        {
            $days->removeCurrentDay();
        }
    header("Location: index.php");
    exit;
}
