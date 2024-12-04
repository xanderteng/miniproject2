<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }
        form label {
            font-size: 14px;
            display: block;
            margin-top: 15px;
        }
        form input {
            width: 95%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            font-size: 14px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required value="{{ old('email') }}">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        @if($errors->has('email'))
            <p class="error">{{ $errors->first('email') }}</p>
        @endif

        <button type="submit">Submit</button>
    </form>
</body>
</html>
