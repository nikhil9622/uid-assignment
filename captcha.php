<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $secretKey = "6LfUg8goAAAAAOBzxMUGKU5S_rXgp4PIfOSSkAuw"; // Replace with your Secret Key

    // Get the reCAPTCHA response from the form
    $response = $_POST["g-recaptcha-response"];

    // Verify the reCAPTCHA response
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        "secret" => $secretKey,
        "response" => $response
    ];

    $options = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded",
            "method" => "POST",
            "content" => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $captchaResponse = json_decode($result);

    if ($captchaResponse->success) {
        // reCAPTCHA verification successful - process the form submission
        // Your code to process the form data goes here
    } else {
        // reCAPTCHA verification failed
        // Handle this as needed (e.g., show an error message)
    }
}
?>
