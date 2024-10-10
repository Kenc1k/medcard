<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedCard - Welcome</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #007BFF; /* Blue background */
            font-family: Arial, sans-serif;
        }
        
        .welcome-container {
            text-align: center;
            color: white;
        }

        .typing {
            font-size: 4rem;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden; /* Hide the text that hasn't been revealed yet */
            border-right: 4px solid white; /* A blinking cursor effect */
            width: 0;
            animation: typing 1s steps(10) forwards, blink 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink {
            from { border-color: white; }
            to { border-color: transparent; }
        }

        .use-service-button {
            opacity: 0;
            margin-top: 20px;
            padding: 15px 30px;
            background-color: white;
            color: #007BFF;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            animation: fadeIn 2s 1.6s forwards; 
        }

        .use-service-button:hover {
            background-color: #0056b3;
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

    </style>
</head>
<body>

<div class="welcome-container">
    <h1 class="typing"> Welcome to MedCard</h1>
    <button class="use-service-button" onclick="location.href='Frontend/main.php'">Use Service</button>
</div>

</body>
</html>
