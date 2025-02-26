<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'cryptonbets.com' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>{{ $title ?? 'Hello' }}</h2>
    </div>

    <div class="email-body">
        {{ $slot }}
    </div>

    <div class="email-footer">
        <p>&copy; CRYPTONBETS.COM | {{ date('Y') }} 2024-2025 - All rights reserved
            .</p>
    </div>
</div>
</body>
</html>
