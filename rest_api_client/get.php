<?php
include 'api.php';
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request(
    'GET',
    $base_url
);

$body_json = $response->getBody();
$result = json_decode($body_json);

// print_r($result->data);
// die;
// foreach ($result->data as $row) {
//     echo $row->nama;
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Guzzle Rest API Client CRUD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2 style="text-align: center;">UTS Rest API Client</h2>
        <h5 style="text-align: center;">Muhammad Fahru Rozi</h5>
        <br><br><br>
        
        <br>
    
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align: center;">Nim</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Alamat</th>
                    <th style="text-align: center;">Tanggal Lahir</th>
                    <th style="text-align: center;">Kode MK</th>
                    <th style="text-align: center;">Nama MK</th>
                    <th style="text-align: center;">SKS</th>
                    <th style="text-align: center;">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result->data as $row) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row->nim ?></td>
                        <td style="text-align: center;"><?php echo $row->nama ?></td>
                        <td style="text-align: center;"><?php echo $row->alamat ?></td>
                        <td style="text-align: center;"><?php echo $row->tanggal_lahir ?></td>
                        <td style="text-align: center;"><?php echo $row->kode_mk ?></td>
                        <td style="text-align: center;"><?php echo $row->nama_mk ?></td>
                        <td style="text-align: center;"><?php echo $row->sks ?></td>
                        <td style="text-align: center;"><?php echo $row->nilai ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <br><br>
    </div>

</body>

<script>
    if (window.performance) {
        console.info("window.performance works fine on this browser");
    }
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        window.location.replace(base_url + window.location.pathname);
    } else {
        console.info("This page is not reloaded");
    }
</script>

</html>