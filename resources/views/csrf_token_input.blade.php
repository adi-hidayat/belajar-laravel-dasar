<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Token</title>
    <style>
        input {
            display: inline-block;
            margin-bottom : 10px;
        }
    </style>
</head>
<body>
    @isset($name)
        <h1>Hello  {{ $name }}!</h1>
    @endisset
    <form method="POST" action="">
        @csrf
        <input type="text" name="name" placeholder="Type your name">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit">
    </form>
</body>
</html>