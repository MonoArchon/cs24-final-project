<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | SecureAssess</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #101b2d;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 15px;
            padding: 35px;
        }
    </style>
</head>

<body>

<div class="card login-card shadow">

    <div class="text-center mb-4">

        <h2 class="fw-bold">SecureAssess</h2>

        <p class="text-muted">
            AI-Assisted Security Assessment Platform
        </p>

    </div>

    <h4 class="mb-3">Sign in</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">

        @csrf

        <div class="mb-3">

            <label class="form-label">Email Address</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required
                   autofocus>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="mb-3">

            <label class="form-label">Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   required>

        </div>

        <button type="submit"
                class="btn btn-primary w-100">
            Login
        </button>

    </form>

    <div class="text-center mt-4">

        <small>
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </small>

    </div>

</div>

</body>
</html>