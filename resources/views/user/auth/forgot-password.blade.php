<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>forgot passsword? Enter email</h1>
@if (Session::has('status'))
     sent
     @elseif (Session::has('email'))
     {{Session()->email}}

@endif
<form action="{{route('user.forgot-password')}}" method="post">
    @csrf
    <input type="email" name="email" placeholder="user@example.com" id="">
    <button type="submit">request a link</button>
</form>

</body>
</html>
