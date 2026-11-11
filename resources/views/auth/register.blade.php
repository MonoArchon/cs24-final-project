<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | SecureAssess</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #101b2d;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            width: 100%;
            max-width: 450px;
            border-radius: 15px;
            padding: 35px;
        }
    </style>
</head>

<body>

<div class="card register-card shadow">

    <div class="text-center mb-4">

        <h2 class="fw-bold">SecureAssess</h2>

        <p class="text-muted">
            Create your assessor account
        </p>

    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">

        @csrf

        <div class="mb-3">

            <label class="form-label">Full Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   required>

        </div>

        <div class="mb-3">

            <label class="form-label">Email Address</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required>

        </div>

        <div class="mb-3">

            <label class="form-label">Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label class="form-label">Confirm Password</label>

            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>

        </div>

        <button type="submit"
                class="btn btn-primary w-100">
            Create Account
        </button>

    </form>

    <div class="text-center mt-4">

        <small>
            Already registered?
            <a href="{{ route('login') }}">Login</a>
        </small>

    </div>

</div>

</body>
</html>