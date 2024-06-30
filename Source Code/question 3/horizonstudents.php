<?php

error_reporting(0); // to use hide the unnesserory errors

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $studentList = getStudentlist();
        echo $studentList;
        break;

    case 'POST':
        $inputData = file_get_contents("php://input");
        $inputData = json_decode($inputData, true);
        $insertStudent = insertStudent($inputData);
        echo $insertStudent;
        break;

    case 'PUT':
        $inputData = file_get_contents("php://input");
        $inputData = json_decode($inputData, true);
        $updateStudent = updateStudent($inputData, $_GET);
        echo $updateStudent;
        break;

    case 'DELETE':
        $deleteStudent = deleteStudent($_GET);
        echo $deleteStudent;
        break;

    default:
        $data = [
            'status' => 405,
            'message' => $requestMethod . " Method Not Allowed",
        ];

        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($data);
        break;
}
?>
