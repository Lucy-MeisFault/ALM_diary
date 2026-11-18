<?php
require_once 'Day.php';
require_once 'Note.php';
require_once 'Listie.php';
require_once 'DayList.php';
if (isset($_POST['loadButton'])) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $days = new DayList();
    $json = file_get_contents($_FILES['diary']['tmp_name']);
    $data = json_decode($json, true);
    foreach ($data as $dayData) {
        $date = DateTime::createFromFormat('!d.m.Y', $dayData['date']);
        $day = new Day($date);
        foreach (($dayData['listOfNotes']) as $noteData)
        {
                $note = new Note($noteData['content'], $noteData['header']);
                $day->listOfNotes->add($note);
        }
        $days->insertByDate($day);
    }
    $days->goToLast();
    $_SESSION['linkedList'] = $days;
    header("Location: index.php");
    exit;
}
