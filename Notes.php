<?php

require_once 'Day.php';
require_once 'Note.php';
require_once 'index.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $header = $_POST["header"] ?? "";
    $content = $_POST["content"] ?? "";
    $currentDay = $_SESSION['currentDay'];
echo "tried it";

        $currentDay->listOfNotes[$currentDay->getNoteCount()] = new Note($currentDay, $content, $header);

    $_SESSION['currentDay'] = $currentDay;
    exit;


}
