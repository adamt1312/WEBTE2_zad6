<?php

require_once ("Database.php");

if (isset($_REQUEST['type'])) {
    $name = $_REQUEST['name'];
    $day = $_REQUEST['day'];
    $month = $_REQUEST['month'];
    $conn = (new Database())->getConnection();

    if ($name) {
        $stmt = $conn->prepare("SELECT id FROM days WHERE day=$day AND month=$month");
        $stmt->execute();

        $day_id = $stmt->fetchColumn();

        $stmt = $conn->prepare("INSERT IGNORE INTO records (day_id, country_id, type, value) VALUES 
                                                                 ($day_id, 'SK', 'name', $name)");
        $stmt->execute();
        $result = ["msg" => "Name: ". $name . " has been added to date: " . $day . "." . $month];
    }
    else {
        $result = ["msg" => "Invalid input name."];
        echo json_encode($result);
    }
}