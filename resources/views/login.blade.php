<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>
  <link rel="stylesheet" href="{{'css/estilos.css'}}">
</head>
<body>
  <div class="container">
    <form method="POST">
      @csrf
      <h1>Login</h1>
      <div>
        <label for="email">Email @error('email'){{$message}} @enderror </label>
        <input id="email" type="email" name="email" value="{{old('email')}}" autofocus>
      </div>
      <div>
        <label for="password">Password @error('password'){{$message}} @enderror </label>
        <input id="password" type="password" name="password">
      </div>
      <div>
        <label for="checkbox">Recuerdame</label>
        <input id="remember" type="checkbox" name="remember">
      </div>
      <div>
        <button type="submit">Login</button>
      </div>
    </form>
  </div>
</body>
</html>