<?php 

require './include/connection.php';

    function getStudentlist(){

        global $connection;

        $query = "SELECT * FROM horizonstudents";
        $query_run = mysqli_query($connection , $query);

        if($query_run){

            if(mysqli_num_rows($query_run) > 0){

                $res = mysqli_fetch_all($query_run , MYSQLI_ASSOC);

                $data = [

                    'status' =>200,
                    'message' => "Successfully fetch students" ,
                    'data' => $res
        
                ];
                header("HTTP/1.0 200 OK ");
                return json_encode($data);

            }else{

                $data = [

                    'status' =>404,
                    'message' => "No student Found" ,
        
                ];
                header("HTTP/1.0 404 No student Found");
                return json_encode($data);

            }


        }else{

            $data = [

                'status' =>500,
                'message' => "Internal Server Error" ,
    
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }

    function error422($message){

        $data = [

            'status' =>422,
            'message' => $message,

        ];
        header("HTTP/1.0 422 Unprosessable entitry");
        echo json_encode($data);
        exit();

    }

    function insertStudent($studentInput){

        global $connection;

        $firstName = mysqli_real_escape_string($connection , $studentInput['firstName']);
        $lastName = mysqli_real_escape_string($connection , $studentInput['lastName']);
        $city = mysqli_real_escape_string($connection , $studentInput['city']);
        $district = mysqli_real_escape_string($connection , $studentInput['district']);
        $province = mysqli_real_escape_string($connection , $studentInput['province']);
        $emailAddress = mysqli_real_escape_string($connection , $studentInput['emailAddress']);
        $mobileNumber = mysqli_real_escape_string($connection , $studentInput['mobileNumber']);

        if(empty(trim($firstName))){

            return error422('enter your first Name');
        }elseif(empty(trim($lastName))){

            return error422('enter your last name');

        }elseif(empty(trim($city))){
            return error422('enter your city');

        }elseif(empty(trim($district))){
            return error422('enter your district');

        }elseif(empty(trim($province))){
            return error422('enter your province');

        }elseif(empty(trim($emailAddress))){
            return error422('enter your email address');

        }elseif(empty(trim($mobileNumber))){
            return error422('enter your mobile number');

        }else{
            $query = "INSERT INTO horizonstudents (firstName , lastName , city , district , province , emailAddress , mobileNumber) 
            VALUES ('$firstName' , '$lastName' , '$city' , '$district' , '$province' , '$emailAddress' , '$mobileNumber')" ;

            $result = mysqli_query($connection , $query);

            if($result){
                $data = [

                    'status' =>201,
                    'message' => "student Insert Sucessfully" ,
        
                ];
                header("HTTP/1.0 201 Created");
                return json_encode($data);

            }else{
                $data = [

                    'status' =>500,
                    'message' => "Internal Server Error" ,
        
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);

            }
        }

    }

    function updateStudent($studentInput , $studentParams){

        global $connection;

        if(!isset($studentParams['indexNumber'])){

            return error422("student Index Number Not found in URL");
        }elseif($studentParams['indexNumber'] == null){
            return error422("Enter the Student Index Number");

        }

        $IndexNumber = mysqli_real_escape_string($connection , $studentParams['indexNumber']);

        $firstName = mysqli_real_escape_string($connection , $studentInput['firstName']);
        $lastName = mysqli_real_escape_string($connection , $studentInput['lastName']);
        $city = mysqli_real_escape_string($connection , $studentInput['city']);
        $district = mysqli_real_escape_string($connection , $studentInput['district']);
        $province = mysqli_real_escape_string($connection , $studentInput['province']);
        $emailAddress = mysqli_real_escape_string($connection , $studentInput['emailAddress']);
        $mobileNumber = mysqli_real_escape_string($connection , $studentInput['mobileNumber']);

        if(empty(trim($firstName))){

            return error422('enter your first Name');
        }elseif(empty(trim($lastName))){

            return error422('enter your last name');

        }elseif(empty(trim($city))){
            return error422('enter your city');

        }elseif(empty(trim($district))){
            return error422('enter your district');

        }elseif(empty(trim($province))){
            return error422('enter your province');

        }elseif(empty(trim($emailAddress))){
            return error422('enter your email address');

        }elseif(empty(trim($mobileNumber))){
            return error422('enter your mobile number');

        }else{
            $query = "UPDATE horizonstudents SET firstName='$firstName' , lastName='$lastName' , city='$city' ,
             district='$district' , province='$province' , emailAddress='$emailAddress' , mobileNumber='$mobileNumber'
            WHERE indexNumber='$IndexNumber' LIMIT 1" ;

            $result = mysqli_query($connection , $query);

            if($result){
                $data = [

                    'status' =>200,
                    'message' => "student Updated Sucessfully" ,
        
                ];
                header("HTTP/1.0 200 success");
                return json_encode($data);

            }else{
                $data = [

                    'status' =>500,
                    'message' => "Internal Server Error" ,
        
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);

            }
        }

    }

    function deleteStudent($studentParams){

        global $connection;

        if(!isset($studentParams['indexNumber'])){

            return error422("student Index Number Not found in URL");
        }elseif($studentParams['indexNumber'] == null){
            return error422("Enter the Student Index Number");

        }

        $IndexNumber = mysqli_real_escape_string($connection , $studentParams['indexNumber']);

        $query = "DELETE FROM horizonstudents WHERE indexNumber='$IndexNumber' LIMIT 1" ;
        $result = mysqli_query($connection , $query);

        if($result){

            $data = [

                'status' =>200,
                'message' => "student delete successfully" ,
    
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        }else{

            $data = [

                'status' =>404,
                'message' => "student not found" ,
    
            ];
            header("HTTP/1.0 404 not found");
            return json_encode($data);
        }


    }

?>