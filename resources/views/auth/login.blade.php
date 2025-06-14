<x-guest-layout>
    <h2>Masuk ke Akun Anda</h2>
    <p class="subheading">Selamat datang kembali!</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; font-size: 0.9rem;">
            <label for="remember_me" style="display: flex; align-items: center; margin-bottom: 0; font-weight: 500; color: #555;">
                <input id="remember_me" type="checkbox" name="remember" style="margin-right: 0.5rem;">
                <span>Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color: #16a085; text-decoration: none;">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Masuk
            </button>
        </div>

        <div class="link-group">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </form>
</x-guest-layout>