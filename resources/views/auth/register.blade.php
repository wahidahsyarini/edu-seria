<!DOCTYPE html>
<html>
<head>
    <title>Register — Edu Seria</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: sans-serif;
            background: #f5f5f3;
            padding: 2rem;
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 400px;
        }
        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #534AB7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 24px;
        }
        .brand h1 { font-size: 22px; font-weight: 600; color: #111; }
        .brand p  { font-size: 14px; color: #666; margin-top: 4px; }
        .field { margin-bottom: 1rem; }
        .field label {
            display: block;
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
        }
        .field input,
        .field select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            background: #fff;
            color: #111;
        }
        .field input:focus,
        .field select:focus {
            border-color: #534AB7;
            box-shadow: 0 0 0 3px rgba(83,74,183,0.12);
        }
        .btn {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            background: #534AB7;
            color: #fff;
            border: none;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        .btn:hover { background: #3C3489; }
        .footer {
            text-align: center;
            font-size: 13px;
            color: #666;
            margin-top: 1.25rem;
        }
        .footer a { color: #534AB7; text-decoration: none; font-weight: 500; }
        .errors {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 1rem;
            font-size: 13px;
            color: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand">
            <div class="brand-icon">🎓</div>
            <h1>Edu Seria</h1>
            <p>Create your account</p>
        </div>

        @if($errors->any())
        <div class="errors">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="field">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" placeholder="Your name" value="{{ old('name') }}" required>
            </div>
            <div class="field">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label for="role">I want to join as</label>
                <select id="role" name="role">
                    <option value="learner" {{ old('role') == 'learner' ? 'selected' : '' }}>Learner</option>
                    <option value="educator" {{ old('role') == 'educator' ? 'selected' : '' }}>Educator</option>
                </select>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn">Create account</button>
        </form>

        <p class="footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
    </div>
</body>
</html>