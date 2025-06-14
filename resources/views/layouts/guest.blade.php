<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-t">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }
            .auth-container {
                text-align: center;
            }
            .logo {
                font-size: 2rem;
                font-weight: 700;
                color: white;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 2rem;
            }
            .logo::before {
                content: "⚡";
                font-size: 2.2rem;
            }
            .auth-card {
                background: white;
                padding: 2.5rem;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 450px;
                text-align: left;
            }
            .auth-card h2 {
                font-size: 1.8rem;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 0.5rem;
                text-align: center;
            }
            .auth-card .subheading {
                font-size: 1rem;
                color: #7f8c8d;
                margin-bottom: 2rem;
                text-align: center;
            }

            /* Mengambil style form dari layout/app.blade.php */
            .form-group {
                margin-bottom: 1.5rem;
            }
            .form-group label {
                display: block;
                font-weight: 600;
                color: #2c3e50;
                margin-bottom: 0.5rem;
            }
            .form-control {
                width: 100%;
                padding: 0.85rem;
                border: 2px solid #e9ecef;
                border-radius: 8px;
                font-size: 1rem;
                transition: border-color 0.3s ease;
                box-sizing: border-box; /* Pastikan padding tidak merusak layout */
            }
            .form-control:focus {
                outline: none;
                border-color: #16a085;
            }
            .text-danger {
                color: #e74c3c;
                font-size: 0.875rem;
                margin-top: 0.25rem;
                display: block;
            }
            .btn {
                width: 100%;
                padding: 0.85rem 1.5rem;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 1rem;
                text-align: center;
                display: inline-block;
                text-decoration: none;
            }
            .btn-primary {
                background: linear-gradient(135deg, #16a085, #27ae60);
                color: white;
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(22, 160, 133, 0.3);
            }
            .link-group {
                margin-top: 1.5rem;
                text-align: center;
                font-size: 0.9rem;
            }
            .link-group a {
                color: #16a085;
                text-decoration: none;
                font-weight: 500;
            }
            .link-group a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <a href="/" class="logo">
                SmartEnergy
            </a>

            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>