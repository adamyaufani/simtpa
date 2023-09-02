<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pengguna Baru</h1>
        </div>
    </x-slot:title>

    <form action="{{ route('admin.store_new_user') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-8 mx-auto">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="mb-3">Detail Pengguna</h4>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input name="email" type="email"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    id="email" value="{{ $user->email }}">
                                <small class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="agency">Nama Organisasi</label>
                                <input name="agency" type="text"
                                    class="form-control {{ $errors->has('agency') ? 'is-invalid' : '' }}"
                                    id="agency" value="{{ $user->agency }}">
                                <small class="invalid-feedback">
                                    {{ $errors->first('agency') }}
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Nama Lengkap</label>
                                <input name="fullname" type="text"
                                    class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}"
                                    id="fullname" value="{{ $user->fullname }}">
                                <small class="invalid-feedback">
                                    {{ $errors->first('fullname') }}
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input name="phone" type="text"
                                    class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                    id="phone" value="{{ $user->phone }}">
                                <small class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </small>
                            </div>
                            <div class="form-group d-flex">
                                <label for="email">Status Akun</label>
                                <h6 class="font-weight-bold ml-2">
                                    <span class="badge badge-{{ $user->status['badge'] }}">
                                        {{ $user->status['message'] }}
                                    </span>
                                </h6>
                            </div>
                            <div class="form-group d-flex">
                                <x-verification-options :userId="$user->id" />
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block">Save</button>
            </div>
        </div>
    </form>

</x-layout>
