<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course QR Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
        }
        img {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $course->name }}</h1>
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
</body>
</html>
