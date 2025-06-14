<x-guest-layout>
    <h2>Buat Akun Baru</h2>
    <p class="subheading">Bergabunglah dengan komunitas energi bersih.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input id="nama_lengkap" class="form-control" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autofocus autocomplete="name" />
            @error('nama_lengkap')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
             @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Daftar
            </button>
        </div>

        <div class="link-group">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </form>
</x-guest-layout>