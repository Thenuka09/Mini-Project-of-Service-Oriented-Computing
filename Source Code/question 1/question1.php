<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://covid-19-statistics.p.rapidapi.com/provinces?iso=CHN",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: covid-19-statistics.p.rapidapi.com",
		"X-RapidAPI-Key: 4034e2c397msh27430ace6ae51e4p17f74ejsn911be8a1ae04"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$data = json_decode($response, true);
    $details = $data['data'];
    // var_dump($data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provinces of China</title>

    <!-- add Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>

        h1{
            color:rgb(234,25,100);
            font-weight: bold;
            position: fixed;
            margin-bottom: 100px;
            background-color: white;
            width: 100%;
            height: 100px;
        }

        td{
            font-weight: bold;
        }

        th{
            font-size: 1.5rem;
            position:sticky;
            top:60px;
        }

        table{
            margin-top: 50px;
        }

    </style>
</head>
<body>

    <h1>Provinces names, latitudes, and longitudes in China...</h1>
    <br>

    <div class="container">

        <table border="1" width="100%" class="table table-striped">

            <tr class="table-dark">
                <th>province Names</th>
                <th>latitudes</th>
                <th>longitudes</th>
            </tr>

            <?php foreach($details as $detail){ ?>

                <tr>
                    <td> <?php echo $detail['province']; ?> </td>
                    <td> <?php echo $detail['lat']; ?> </td>
                    <td> <?php echo $detail['long']; ?> </td>

                </tr>

            <?php
            }
             ?>

        </table>
    </div>   
</body>
</html>