<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Database.php';

$conn = (new Database())->getConnection();
if (isset($_REQUEST['name']) && isset($_REQUEST['day']) && isset($_REQUEST['month'])) {
    $name = $_REQUEST['name'];
    $day = $_REQUEST['day'];
    $month = $_REQUEST['month'];
    $stmt = $conn->prepare("SELECT id FROM days WHERE day=$day AND month=$month");
    $stmt->execute();
    $day_id = $stmt->fetchColumn();
    try {
        $stmt = $conn->prepare("INSERT INTO records (day_id, country_id, type, value) VALUES (:day_id, 4, 'name', :name)");
        $stmt->bindParam(":day_id", $day_id);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        $result = ["msg" => "Name day with name: " . $name . " and date: " . $day . "." . $month . " " . "has been added."];
        echo json_encode($result);
    } catch (error) {
        echo error;
    }
}
else {
    $result = ["msg" => "Invalid parameters."];
    echo json_encode($result);
}
