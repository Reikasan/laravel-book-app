<div class="login-card">
    <div class="login-card__header">
        <h1>Login</h1>
    </div>
    <div class="login-card__body">
        <form method="POST" action="/login">
            @csrf
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                <label for="email">Email</label>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control">
                <label for="password">Password</label>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn--primary">Login</button>
            </div>
        </form>
        <div class="login-card__divider">
            <div class="line">
            <span>or</span>
        </div>
        <form method="get" action={{route('guest-login')}}>
            <div class="form-group">
                <input type="submit" class="btn btn--secondary guest-login-btn" value="Try as guest" />
            </div>
        </form>
    </div>
    <div class="login-card__footer">
        <p>No account yet?</p>
        <a href="{{ route('register') }}">Register</a>
    </div>
</div>