<!-- resources/views/emails/contact-received.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        img {
            max-width: 200px;
            height: auto;
        }

        .data {
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
        }

        .data p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- {{dd('dsf')}} --}}
        <h1>Contact Form Received</h1>
        {{-- <div class="logo">
            <img src="{{ asset('assets/img/logo/admartechwhite-02.png') }}" alt="Your Logo">
        </div> --}}
        <div class="data">
            <p><strong>First Name:</strong> {{ $data['name'] }}</p> <br>
            <p><strong>Email:</strong> {{ $data['email'] }}</p> <br>
            <p><strong>Phone No:</strong> {{ $data['phone_no'] }}</p> <br>
            <p><strong>Message:</strong> {{ $data['message'] }}</p> <br>
        </div>
    </div>
</body>

</html>
