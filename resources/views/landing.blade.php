<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Econnect - Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />
</head>
<body>
    <div class="landing-container">
        <div class="content">
            <h1>Welcome to</h1>
            <div class="logo">
                <img src="{{ asset('images/econnect-logo.png') }}" alt="Econnect Logo" />
            </div>
            <p class="subtitle">Tap anywhere to continue</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.querySelector('.landing-container');
            container.addEventListener('click', function () {
                window.location.href = '{{ route("login") }}';
            });
        });
    </script>
</body>
</html>
