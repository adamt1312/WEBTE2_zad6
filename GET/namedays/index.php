<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../Database.php';

$conn = (new Database())->getConnection();

// GET NAMES FOR A SPECIFIC DATE
if (isset($_REQUEST['day']) && isset($_REQUEST['month']) & isset($_REQUEST['country'])) {
    $day = $_REQUEST['day'];
    $month = $_REQUEST['month'];
    $country = strtoupper($_REQUEST['country']);

    $stmt = $conn->prepare("SELECT id FROM days WHERE day=$day AND month=$month");
    $stmt->execute();
    $day_id = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT id FROM countries WHERE code='$country'");
    $stmt->execute();
    $country_id = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT value FROM records WHERE type='name' AND day_id=$day_id AND country_id=$country_id");
    try {
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    } catch (error) {
        echo error;
    }
}

// GET DATES FOR A SPECIFIC NAME DAY
elseif (isset($_REQUEST['name']) && isset($_REQUEST['country'])) {
    $name = $_REQUEST['name'];
    $country = $_REQUEST['country'];

    $stmt = $conn->prepare("SELECT id FROM countries WHERE code='$country'");
    $stmt->execute();
    $country_id = $stmt->fetchColumn();

    $stmt = $conn->prepare("SELECT day_id FROM records WHERE type='name' AND country_id=$country_id AND value='$name'");

    try {
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $days = $stmt->fetchAll();
        $dates = [];
        foreach ($days as $day) {
            $day_id = $day['day_id'];
            $stmt = $conn->prepare("SELECT day,month FROM days WHERE id=$day_id");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            array_push($dates, $stmt->fetch());
        }
        echo json_encode($dates, JSON_UNESCAPED_UNICODE);
    } catch (error) {
        echo error;
    }
}

else {
    $result = ["msg" => "Invalid parameters"];
    echo json_encode($result);
}
