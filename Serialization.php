
<?php
require_once 'index.php';
require_once 'Day.php';
require_once 'Note.php';


if (isset($_POST['saveButton'])) {

    $days = $_SESSION['days'];
    $temp = [];
    foreach ($days as $day) {
        $temp[] = $day->jsonSerialize();
    }


    header("Content-Type: application/json");
    header("Content-Disposition: attachment; filename=\"file.json\"");

    echo json_encode($temp, JSON_PRETTY_PRINT);
    exit;
}