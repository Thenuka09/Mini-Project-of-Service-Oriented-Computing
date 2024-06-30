<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>

       .container h1{
            color:rgb(234,25,100);
            font-weight: bold;

        }

        label{

            font-weight: bold;
            font-size: 1.5rem;
        }

        option{

            font-weight: bold;
        }

        option :hover{
            color: red;
        }

        select{
            width: 100%;
            color: black;
            background-color: white;
            font-weight: bold;
            border: 1px solid black;
            border-radius: 5px;
            height: 40px;
        }

        select:hover{
            color: red;
        }

        table tr{
            border: 2px solid gray;
        }

        table tr td{
            font-weight: bold;
        }

        table tr td h5{
            font-weight: bold;
        }

        hr{
            border: 2px solid  gray;

        }

    </style>
</head>
<body>

    <div class="container p-5 my-5 border">

        <h1>Country Informations</h1>
        <br>

        <form>
            <div> 
                <label for="countrySelect">Select a country :</label>
                <select id="countrySelect">

                <?php 
                    $url = "https://restcountries.com/v3.1/all";
                    $data = file_get_contents($url);
                    $data = json_decode($data, true);

                    if(is_array($data)){
                        foreach($data as $country){
                            echo '<option value="' . $country['cca3'] . '">' .$country['name']['common'] .'</option>';
                        }
                    }
                ?>
                </select>
            </div>
        </form>

        <hr>

        <div id="countryInformation"></div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $('#countrySelect').change(function(){
            var SelectedcountryCode = $(this).val();
            $.ajax({
                url:'getcountry.php',
                type:'POST',
                data: {countryCode:SelectedcountryCode },
                success: function(response){
                    $('#countryInformation').html(response);
                }

            });
        });
    </script>
    
</body>
</html>