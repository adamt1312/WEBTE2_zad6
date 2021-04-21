<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Database.php';

$conn = (new Database())->getConnection();
if (isset($_REQUEST['name']) && isset($_REQUEST['day']) && isset($_REQUEST['month'])) {
    switch ($_REQUEST['month']) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            if ($_REQUEST['day'] < 1 || $_REQUEST['day'] > 31) {
                $result = ["msg" => "Day must be between 1 - 31"];
                echo json_encode($result);
                return;
            }
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            if ($_REQUEST['day'] < 1 || $_REQUEST['day'] > 30) {
                $result = ["msg" => "Day must be between 1 - 30"];
                echo json_encode($result);
                return;
            }
            break;
        case 2:
            if ($_REQUEST['day']  < 1 || $_REQUEST['day']  > 29) {
                $result = ["msg" => "Day must be between 1 - 29"];
                echo json_encode($result);
                return;
            }
            break;
        default:
            $result = ["msg" => "Month must be between 1 - 12"];
            echo json_encode($result);
            return;
    }

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
