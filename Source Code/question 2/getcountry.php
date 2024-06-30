<?php 
    if(isset($_POST['countryCode'])){

        $SelectedcountryCode = $_POST['countryCode'];
        
        $url="https://restcountries.com/v3.1/alpha/$SelectedcountryCode";
        $data = file_get_contents($url);
        $data = json_decode($data , true);

        if(is_array($data) && !empty($data)){
            $country = $data[0];

            echo '<table class="table table-bordered table-striped">

            <tr><td><h5>Flag</h5><td><img src="'.($country['flags']['png']?? 'Data Not Available').'"/></td></td></tr>
            <tr><td><h5>Official Name</h5><td>'.($country['name']['official']?? 'Data Not Available').'</td></td></tr>
            <tr><td><h5>Capital City</h5><td>'.($country['capital'][0]?? 'Data Not Available').'</td></td></tr>
            <tr><td><h5>Region</h5><td>'.($country['region']?? 'Data Not Available').'</td></td></tr>
            <tr><td><h5>Subregion</h5><td>'.($country['subregion'] ?? 'Data Not Available').'</td></td></tr>
            <tr><td><h5>Currency</h5><td>'.implode(', ', array_column($country['currencies'], 'name')).'</td></td></tr>
            <tr><td><h5>Country Code</h5><td>'.($country['tld'][0]?? 'Data Not Available').'</td></td></tr>
            <tr><td><h5>Population</h5><td>'.(number_format($country['population'])?? 'Data Not Available').'</td></td></tr>
            <tr><td><h5>Area</h5><td>'.(number_format($country['area'])?? 'Data Not Available').'</td></td></tr>
            <tr><td><h5>Borders</h5><td>'.(isset($country['borders']) ? implode("," , $country['borders']) :'data not availabe').'</td></td></tr>
            
            <tr><td><h5>Google Map</h5><td>
            <iframe width="100%" height="200"
            frameborder="1" style="border:1"
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDq5iI8hb4HVJdL4ZZx7CRsUypIqB4t0WU&q='
            .($country['name']['common']?? 'Data Not Available').'&zoom=7"
            allowfullscreen>
            </iframe>
            </td></td></tr>
                     
            </table>';
        }
        else{
            echo 'not found';
        }
    }else{
        echo 'invalid';
    }

?>

