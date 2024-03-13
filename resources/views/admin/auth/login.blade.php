<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Admin Login</h1>

    @if (Session::has('status'))
        password has been reset
    @endif

    <form action="{{ route('admin.login') }}" method="post">
        @csrf
        {{-- <label for="">Username</label>
        <input type="text" name="name"> --}}
        <label for="">Email</label>
        <input type="email" name="email">
        @error('email')
            {{ $message }}
        @enderror

        <label for="">Passowrd</label>
        <input type="password" name="password">
        @error('password')
            {{ $message }}
        @enderror
        <input type="submit" value="Login">
    </form>
    <a href="{{ route('admin.forgot-password') }}">Forgot Password? Click Here</a>

</body>

</html>
