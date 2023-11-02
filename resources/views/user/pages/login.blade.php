<x-user.layout>

        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-5">
                <h4 class="card-title">
                    Login
                </h4>
                <form action="{{ route('user.login_attempt') }}" method="POST" class="mt-5">
                    @error('login_failed')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    @csrf
                    <div class="mb-4">
                        <label for="inputEmail" class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email"
                            value="{{ old('email') }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword"
                            placeholder="Password">
                    </div>
                   

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>

                    <div class="mt-2 mb-3 d-flex flex-row justify-content-between">
                        <a href="{{ route('user.registration_form') }}" class="mb-3">
                            Buat Akun
                        </a>
                        <a href="{{ route('user.ask_reset_password_form') }}">Lupa Password?</a>
                    </div>

                </form>
            </div>
        </div>
</x-user.layout>
