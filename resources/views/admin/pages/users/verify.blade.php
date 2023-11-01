<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Konfirmasi Pengguna</h1>
        </div>
    </x-slot:title>

    <div class="col-xl-8 mx-auto">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Detail pengguna</h5>
            </div>

            <div class="card-body">
                @if(session()->has('succeed'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('succeed') }}
                    </div>
                @endif

                <div class="col-12">
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <p>
                            <strong>{{ $user->email }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Nama Organisasi</label>
                        <p>
                            <strong>{{ $user->userProfile->institution_name }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat</label>
                        <p>
                            <strong>{{ $user->userProfile->address }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Nama Desa</label>
                        <p>
                            <strong>{{ $user->userProfile->villageDetail->village_name }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Nomor Telepon</label>
                        <p>
                            <strong>{{ $user->userProfile->phone_number }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Facebook</label>
                        <p>
                            <strong>{{ $user->userProfile->facebook }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Instagram</label>
                        <p>
                            <strong>{{ $user->userProfile->instagram }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Twitter</label>
                        <p>
                            <strong>{{ $user->userProfile->twitter }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Website</label>
                        <p>
                            <strong>{{ $user->userProfile->website }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Youtube</label>
                        <p>
                            <strong>{{ $user->userProfile->youtube }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Tiktok</label>
                        <p>
                            <strong>{{ $user->userProfile->tiktok }}</strong>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat google map</label>
                        <p>
                            <strong>{{ $user->userProfile->gmap_address }}</strong>
                        </p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.accept_user_registration',$user->id) }}"
                        class="btn btn-success">
                        Terima Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-layout>
