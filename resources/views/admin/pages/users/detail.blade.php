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
                <div>
                    <div class="mb-2">
                        <span> Nama Lengkap :</span>
                        <h6 class="font-weight-bold">
                            {{ $user->fullname }}
                        </h6>
                    </div>
                    <div class="mb-2">
                        <span> Username :</span>
                        <h6 class="font-weight-bold">
                            {{ $user->username }}
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <i class="fa-solid fa-envelope"></i>
                        <span> Alamat Email :</span>
                        <h6 class="font-weight-bold">
                            {{ $user->email }}
                        </h6>
                    </div>
                    <div class="col-6 mb-2">
                        <i class="fa-solid fa-phone"></i>
                        <span> No. Telp :</span>
                        <h6 class="font-weight-bold">
                            {{ $user->phone }}
                        </h6>
                    </div>
                </div>
                <div>
                    <div>
                        <i class="fa-solid fa-building"></i>
                        <span> Organisasi </span>
                        <h6 class="font-weight-bold">
                            {{ $user->agency }}
                        </h6>
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
