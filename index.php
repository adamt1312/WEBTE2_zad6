<?php

require_once 'Database.php';
$DB = new Database();
$conn = $DB->getConnection();

////XML to database
//$xml = simplexml_load_file("meniny.xml");
//$countries = [  "SK" =>"Slovensko",
//                "CZ"=>"Česká Republika",
//                "AT"=>"Rakúsko",
//                "HU"=>"Maďarsko",
//                "PL"=>"Poľsko"];
//
//$countries2 = [ "SK" =>"",
//                "SKd" =>"",
//                "CZ"=>"",
//                "AT"=>"",
//                "HU"=>"",
//                "PL"=>""];
//
//$day = "";
//$month = "";
//$stmtDay = $conn->prepare("INSERT IGNORE INTO days (day, month) VALUES (:day,:month)");
//$stmtDay->bindParam(':day',$day);
//$stmtDay->bindParam(':month',$month);
//
//$code = "";
//$title = "";
//$stmtCountries = $conn->prepare("INSERT IGNORE INTO countries (code,title) VALUES (:code,:title)");
//$stmtCountries->bindParam(':code',$code);
//$stmtCountries->bindParam(':title',$title);
//
//$day_id = "";
//$country_id = "";
//$type ="";
//$value ="";
//$stmtRecords = $conn->prepare("INSERT IGNORE INTO records (day_id,country_id,type,value) VALUES (:day_id,:country_id,:type,:value)");
//$stmtRecords->bindParam(':day_id',$day_id);
//$stmtRecords->bindParam(':country_id',$country_id);
//$stmtRecords->bindParam(':type',$type );
//$stmtRecords->bindParam(':value',$value);
//
//
//foreach ($xml->children() as $row) {
//    $day = substr($row->den, 2, 2);
//    $month = substr($row->den, 0, 2);
//    $stmtDay->execute();
//
//    $d = $conn->prepare("SELECT id FROM days where day=$day and month=$month");
//    $d->execute();
//    $day_id = $d->fetchColumn();
//
//    foreach (array_keys(((array)$row)) as $item) {
//        if (array_key_exists($item, $countries)) {
//            $code = $item;
//            $title = $countries[$item];
//            $stmtCountries->execute();
//
//            $c = $conn->prepare("SELECT id FROM countries where code='$code'");
//            $c->execute();
//            $country_id = $c->fetchColumn();
//            $type = "name";
//
//            foreach (explode(",", $row->$item) as $name) {
//                $value = trim($name);
//                $stmtRecords->execute();
//            }
//        }
//    }
//
//    if ($row->SKd) {
//        $type = "name";
//        $c = $conn->prepare("SELECT id FROM countries where code='SK'");
//        $c->execute();
//        $country_id = $c->fetchColumn();
//        foreach (explode(",", $row->SKd) as $name) {
//            $value = trim($name);
//            $stmtRecords->execute();
//        }
//    }
//
//    if ($row->SKsviatky) {
//        $type = "holiday";
//        $c = $conn->prepare("SELECT id FROM countries where code='SK'");
//        $c->execute();
//        $country_id = $c->fetchColumn();
//        $value = $row->SKsviatky;
//        $stmtRecords->execute();
//
//    }
//
//    if ($row->CZsviatky) {
//        $type = "holiday";
//        $c = $conn->prepare("SELECT id FROM countries where code='CZ'");
//        $c->execute();
//        $country_id = $c->fetchColumn();
//        $value = $row->CZsviatky;
//        $stmtRecords->execute();
//    }
//
//    if ($row->SKdni) {
//        $type = "memory";
//        $c = $conn->prepare("SELECT id FROM countries where code='SK'");
//        $c->execute();
//        $country_id = $c->fetchColumn();
//        $value = $row->SKdni;
//        $stmtRecords->execute();
//    }
//}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WEBTE2 - API</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Carme&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</head>
<body>
    <div id="container">
        <div id="titleWrapper">
            <h1>WEBTE6 - API</h1>
        </div>


        <div class="contentWrapper">
            <div class="exampleWrapper">
                <div class="descriptionWrapper" style="padding-right: 20px">
                    <p id="title1">Which names have nameday at a given day?</p>
                </div>
                <div class="formWrapper">
                    <form action="/action_page.php" style="border-left: 2px solid black;">
                        <div class="form-group">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Choose country</option>
                                <option value="SK">SK</option>
                                <option value="CZ">CZ</option>
                                <option value="HU">HU</option>
                                <option value="AT">AT</option>
                                <option value="PL">PL</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="day">Day</label>
                            <input type="number" class="form-control" id="day" name="day" min="1" max="31">
                        </div>

                        <div class="form-group">
                            <label for="month">Month</label>
                            <input type="number" class="form-control" id="month" name="month" min="1" max="12">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-info">Send request</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="exampleWrapper">
                <div class="formWrapper">
                    <form action="/action_page.php" style="border-right: 2px solid black;">
                        <div class="form-group">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Choose country</option>
                                <option value="SK">SK</option>
                                <option value="CZ">CZ</option>
                                <option value="HU">HU</option>
                                <option value="AT">AT</option>
                                <option value="PL">PL</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="day">Name</label>
                            <input type="text" class="form-control" id="day" name="name">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-info">Send request</button>
                        </div>
                    </form>
                </div>
                <div class="descriptionWrapper" style="padding-left: 20px">
                    <p id="title1">On which day does the given name have a name day?</p>
                </div>
            </div>

            <div class="exampleWrapper">
                <div class="descriptionWrapper" style="padding-right: 20px">
                    <p id="title1">Add new name day with a given name and day.</p>
                </div>
                <div class="formWrapper">
                    <form action="/action_page.php" style="border-left: 2px solid black;">
                        <div class="form-group">
                            <label for="day">Name</label>
                            <input type="text" class="form-control" id="day" name="name">
                        </div>

                        <div class="form-group">
                            <label for="day">Day</label>
                            <input type="number" class="form-control" id="day" name="day" min="1" max="31">
                        </div>

                        <div class="form-group">
                            <label for="month">Month</label>
                            <input type="number" class="form-control" id="month" name="month" min="1" max="12">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-info">Add new</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="exampleWrapper" style="flex-direction: column; width: 780px;">
                <p id="title1">You can fetch other info too...</p>
                <div class="buttonsWrapper">
                    <button type="button" class="btn btn-info" id="allSkBtn">Get all holidays in SK</button>
                    <button type="button" class="btn btn-info" id="allCzBtn">Get all holidays in CZ</button>
                    <button type="button" class="btn btn-info" id="allSkBtn2">Get all memorial days in SK</button>
                </div>

                <p id="resultPar"></p>

            </div>
        </div>



        <div class="contentWrapper">
            <hr style="height: 2px; color: black; width: 90%">
            <h1>API Documentation</h1>
            <p>Lorem sadasfj jkdjakljl</p>
            <p>Lorem sadasfj jkdjakljl</p>
            <p>Lorem sadasfj jkdjakljl</p>
        </div>

        <footer>Adam Trebichalský, 98014</footer>
    </div>
<script src="api.js"></script>
</body>
</html>