<x-user.layout>
    <div class="d-flex justify-content-center">
        <div class="col-12 col-md-5">
            <h4 class="card-title">
                Pendaftaran Akun Baru
            </h4>

            <form action="{{ route('user.submit_registration') }}" method="POST" class="mt-5">
                @csrf
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="mb-4">
                    <label for="institution_name" class="form-label">Nama TPA <small class="text-secondary">(Kata 'TPA' tidak perlu ditulis. Contoh: Istiqomah)</small></label>
                    <input type="text" name="institution_name"
                        class="form-control
                            {{ $errors->has('institution_name') ? 'is-invalid' : '' }}"
                        id="institution_name" placeholder="Contoh : Istiqomah" value="{{ old('institution_name') }}">
                    @error('institution_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="inputEmail"
                        placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="inputAddress" class="form-label">Alamat</label>
                    <input type="address" name="address" placeholder="Contoh : Masjid Nurul Iman, Kembaran RT 01"
                        class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="inputAddress"
                        placeholder="Alamat" value="{{ old('address') }}">
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="village">Kalurahan</label>
                    <select name="village" class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}"
                        id="village">
                        <option value="">Pilih Kalurahan</option>
                        @foreach ($villages as $village)
                            <option value="{{ $village->id }}"
                                {{ old('village') == $village->id ? 'selected' : '' }}>
                                {{ $village->village_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('village')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="inputPhone" class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" placeholder="Contoh : 08561234567"
                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="inputPhone"
                        placeholder="Nomor Telepon" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="inputPassword"
                        placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="inputPasswordConfirmation" class="form-label">Ulangi Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        id="inputPasswordConfirmation" placeholder="Tulis ulang Password">
                </div>


                <div class="d-grid mb-2 ">
                    <button class="btn btn-primary btn-block">
                        Buat Akun
                    </button>
                </div>

                <div class="d-flex flex-row">
                    Sudah punya akun? <a href="{{ route('user.login_form') }}" class=" ms-2 mb-3">Login di sini</a>.
                </div>

            </form>
        </div>
    </div>
</x-user.layout>
