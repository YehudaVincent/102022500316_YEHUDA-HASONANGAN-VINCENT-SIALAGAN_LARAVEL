<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <main class="container login-container">
        <h2>Login Admin</h2>
        <p>Masuk untuk mengelola katalog obat.</p>

        @if ($errors->any())
            <div class="login-error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="form-card">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn" style="border:none; cursor:pointer; width:100%;">Masuk</button>
        </form>
    </main>
</body>
</html>
