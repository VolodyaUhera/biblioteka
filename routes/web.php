<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello-world', function () {
   echo "Hello World";
});

Route::match(['get', 'post'], 'hello-world-2', function () {
    echo "Hello this is match method";
});

Route::any("hello-world-3", function () {
   $b = rand(10, 1000);
   $a = rand(1, 234);
   echo "$b " . "$a";
});

Route::get("/{name}/{age}", function (String $name, Int $age){
   echo "My age is $age, my name is $name";

//    file_get_contents()
});

Route::get('get-dolars-for-vitaliy', function () {
    $req_url = 'https://open.er-api.com/v6/latest/USD';
    $response_json = file_get_contents($req_url);

// Continuing if we got a result
    if(false !== $response_json) {

        // Try/catch for json_decode operation
        try {

            // Decoding
            $response = json_decode($response_json);

            // Check for success
            if('success' === $response->result) {
                foreach ($response->rates as $currency => $rate) {
                    $response->rates->$currency = round($rate, 2);

                }
            }

        }
        catch(Exception $e) {
            //
        }

    }

    $json_pretty = json_encode($response, JSON_PRETTY_PRINT);

    echo "<pre>" . $json_pretty. "</pre>";
});

Route::get('get-dollars-for-vitaliy-2', function () {

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );


    $req_url = 'https://open.er-api.com/v6/latest/USD';
    $response_json = file_get_contents($req_url, context: stream_context_create($arrContextOptions));

    $response = json_decode($response_json, true); // Convert the string to an array
    if ('success' === $response["result"]) { // Check if the request was successful
        foreach ($response["rates"] as $currency => $rate) {
            $response["rates"][$currency] =round($rate, 2); // Round each rate to two decimal places
        }
    }

    echo "<pre>";
    var_dump($response);
    echo "</pre>";
});

Route::get('file_get_contents_test', function () {

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );

    $req_url = 'https://www.markmyimages.com/';
    $response = file_get_contents(filename: $req_url, context: stream_context_create($arrContextOptions));

    var_dump($response);
});
