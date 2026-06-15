<!DOCTYPE html>
<html>
<head>
    <title>Login — Edu Seria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #f5f5f3; padding: 2rem; }
        .card { background: #fff; border: 1px solid #e5e5e5; border-radius: 12px; padding: 2.5rem 2rem; width: 100%; max-width: 400px; }
        .brand { text-align: center; margin-bottom: 2rem; }
        .brand-icon { width: 48px; height: 48px; border-radius: 8px; background: #534AB7; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 12px; }
        .brand-icon i { font-size: 24px; color: #EEEDFE; }
        .brand h1 { font-size: 22px; font-weight: 500; color: #111; }
        .brand p { font-size: 14px; color: #666; margin-top: 4px; }
        .field { margin-bottom: 1rem; }
        .field label { display: block; font-size: 13px; color: #555; margin-bottom: 6px; }
        .field input { width: 100%; padding: 9px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px; outline: none; }
        .field input:focus { border-color: #534AB7; box-shadow: 0 0 0 3px rgba(83,74,183,0.12); }
        .btn { width: 100%; padding: 10px; border-radius: 8px; background: #534AB7; color: #fff; border: none; font-size: 15px; font-weight: 500; cursor: pointer; margin-top: 0.5rem; }
        .btn:hover { background: #3C3489; }
        .footer { text-align: center; font-size: 13px; color: #666; margin-top: 1.25rem; }
        .footer a { color: #534AB7; text-decoration: none; font-weight: 500; }
        .errors { background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 10px 14px; margin-bottom: 1rem; font-size: 13px; color: #b91c1c; }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand">
            <div class="brand-icon"><i class="ti ti-school"></i></div>
            <h1>Edu Seria</h1>
            <p>Sign in to your account</p>
        </div>

        @if($errors->any())
        <div class="errors">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="field">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn">Sign in</button>
        </form>

        <p class="footer">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
    </div>
</body>
</html>