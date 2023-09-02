<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pengguna Baru</h1>
        </div>
    </x-slot:title>

    <form action="{{ route('admin.store_new_user') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="mb-3">Detail Pengguna</h4>
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input name="email" type="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                id="email" value="{{ old('email') }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="agency">Nama Organisasi</label>
                            <input name="agency" type="text"
                                class="form-control {{ $errors->has('agency') ? 'is-invalid' : '' }}"
                                id="agency" value="{{ old('agency') }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('agency') }}
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                id="password" value="{{ old('password') }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password"
                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                id="password_confirmation" value="{{ old('password_confirmation') }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </small>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block">Save</button>
            </div>
        </div>
    </form>

</x-layout>
