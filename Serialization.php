<?php
require_once 'Day.php';
require_once 'Note.php';
require_once 'Listie.php';
require_once 'DayList.php';

if (isset($_POST['saveButton'])) {

session_start();
    $days = $_SESSION['linkedList'];
    $temp = new Listie();
    $days->goToFirst();
for ($i = 0; $i < $days->count; $i++) {
$temp->add($days->currentDay);
$days->goToNext();
}


    header("Content-Type: application/json");
    header("Content-Disposition: attachment; filename=\"file.json\"");

    echo json_encode($temp, JSON_PRETTY_PRINT);
    exit;
}