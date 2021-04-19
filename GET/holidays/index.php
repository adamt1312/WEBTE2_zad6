<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../Database.php';

if (isset($_REQUEST['lang'])) {
    $lang = $_REQUEST['lang'];
    $conn = (new Database())->getConnection();

    switch ($lang) {
        case "sk":
        {
            $stmt = $conn->prepare("SELECT records.value,days.day,days.month FROM records INNER JOIN days ON records.day_id=days.id WHERE records.country_id=4 AND records.type='holiday' ORDER BY days.month ");
            try {
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
            catch (error) {
                echo error;
            }
            break;
        }
        case "cz":
        {
            $stmt = $conn->prepare("SELECT records.value,days.day,days.month FROM records INNER JOIN days ON records.day_id=days.id WHERE records.country_id=5 AND records.type='holiday' ORDER BY days.month");
            try {
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
            catch (error) {
                echo error;
            }
            break;
        }
    }

}