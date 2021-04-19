<?php

require_once ("Database.php");

if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    $conn = (new Database())->getConnection();

    switch ($type) {
        case "SKholi":
        {
            $stmt = $conn->prepare("SELECT * FROM records INNER JOIN days ON records.day_id=days.id WHERE records.country_id=4 AND records.type='holiday'");
            $stmt->execute();
            $result = $stmt->fetchAll();
            echo json_encode($result);
            break;
        }
        case "SKmem":
        {
            $stmt = $conn->prepare("SELECT * FROM records INNER JOIN days ON records.day_id=days.id WHERE records.country_id=4 AND records.type='memory'");
            $stmt->execute();
            $result = $stmt->fetchAll();
            echo json_encode($result);
            break;
        }
        case "CZholi":
        {
            $stmt = $conn->prepare("SELECT * FROM records INNER JOIN days ON records.day_id=days.id WHERE records.country_id=5 AND records.type='holiday'");
            $stmt->execute();
            $result = $stmt->fetchAll();
            echo json_encode($result);
            break;
        }
        case "find":
        {
            if (!isset($_REQUEST['day']) || !isset($_REQUEST['month']) || !isset($_REQUEST['country'])) {
                $result = ["msg" => "Date and country must be set"];
                echo json_encode($result);
            }

            $day = $_REQUEST['day'];
            $month = $_REQUEST['month'];
            $country = $_REQUEST['country'];
            $stmt = $conn->prepare("SELECT id FROM days WHERE day=$day AND month=$month");
            $stmt->execute();
            $day_id = $stmt->fetchColumn();

            switch ($country) {
                case "SK":
                {
                    $stmt = $conn->prepare("SELECT * FROM records WHERE type='name' AND day_id=$day_id AND country_id=4");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if (!$result) {
                        $result = ["msg" => "No names found"];
                    }
                    echo json_encode($result);
                    break;
                }
                case "CZ":
                {
                    $stmt = $conn->prepare("SELECT * FROM records WHERE type='name' AND day_id=$day_id AND country_id=5");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if (!$result) {
                        $result = ["msg" => "No names found"];
                    }
                    echo json_encode($result);
                    break;
                }
                case "PL":
                {
                    $stmt = $conn->prepare("SELECT * FROM records WHERE type='name' AND day_id=$day_id AND country_id=2");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if (!$result) {
                        $result = ["msg" => "No names found"];
                    }
                    echo json_encode($result);
                    break;
                }
                case "HU":
                {
                    $stmt = $conn->prepare("SELECT * FROM records WHERE type='name' AND day_id=$day_id AND country_id=1");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if (!$result) {
                        $result = ["msg" => "No names found"];
                    }
                    echo json_encode($result);
                    break;
                }
                case "AT":
                {
                    $stmt = $conn->prepare("SELECT * FROM records WHERE type='name' AND day_id=$day_id AND country_id=3");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if (!$result) {
                        $result = ["msg" => "No names found"];
                    }
                    echo json_encode($result);
                    break;
                }
            }
        }
        case "findDay":
        {
            if (!isset($_REQUEST['name']) || !isset($_REQUEST['country'])) {
                $result = ["msg" => "Name and country must be set"];
                echo json_encode($result);
            }

            $name = $_REQUEST['name'];
            $country = $_REQUEST['country'];
            $stmt = $conn->prepare("SELECT id from countries WHERE code='$country'");
            $stmt->execute();
            $country_id = $stmt->fetchColumn();

            $stmt = $conn->prepare("SELECT day_id FROM records WHERE value='$name' AND country_id='$country_id'");
            $stmt->execute();
            $day_id = $stmt->fetchColumn();

            if ($day_id) {
                $stmt = $conn->prepare("SELECT day,month FROM days WHERE id=$day_id");
                $stmt->execute();
                $result = $stmt->fetchAll();
            }
            else {
                $result = ["msg" => "Day not found"];
            }
            echo json_encode($result);
            break;
        }
    }
}