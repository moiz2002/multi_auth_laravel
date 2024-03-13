<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
      <h1>Reset Password</h1>
      <form action="{{route('password.reset.post')}}" method="post">
        @csrf
      <input type="hidden" name="email" value="{{$email}}">
      <input type="hidden" name="token" value="{{$token}}">
      <input type="password" name="password">
      <button type="submit">dsjfhe</button>
    </form>
</body>
</html>
