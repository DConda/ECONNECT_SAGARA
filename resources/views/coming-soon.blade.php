<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Econnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F5F5F5;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            color: #2B5C2B;
            margin-bottom: 1rem;
        }

        p {
            color: #666;
            margin-bottom: 2rem;
        }

        .back-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #2B5C2B;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .back-button:hover {
            background-color: #234623;
        }
    </style>
</head>
<body>
    <h1>Coming Soon</h1>
    <p>This feature is currently under development. Please check back later!</p>
    <a href="{{ route('home') }}" class="back-button">Back to Home</a>
</body>
</html> 