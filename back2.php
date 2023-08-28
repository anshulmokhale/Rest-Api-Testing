<?php

$host = "localhost";
$dbname = "test";
$username = "root";
$password = "";

try {
    $pd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pd->query("SELECT * FROM testtable1");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        $response = json_encode($result);
    } else {
        $response = json_encode(array("message" => "no data found"));
    }

    header("Content-Type: application/json");
    echo $response;
} catch (PDOException $e) {
    echo $e;
} catch (Exception $e) {
    echo $e;
}
