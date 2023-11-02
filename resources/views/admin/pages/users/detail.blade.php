<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pengguna</h1>
        </div>
    </x-slot:title>

    {{-- <form action="{{ route('admin.store_new_user') }}" method="POST"> --}}
    {{-- @csrf --}}
    <div class="row mb-3">
        <div class="col-8 mx-auto">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Detail Pengguna</h4>
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
                        <div class="form-group d-flex">
                            <label for="email">Status Akun</label>
                            <h6 class="font-weight-bold ml-2">
                                <span class="badge badge-{{ $user->status['badge'] }}">
                                    {{ $user->status['message'] }}
                                </span>
                            </h6>
                        </div>
                        <div class="form-group d-flex flex-row">
                            
                            <x-verification-options :userId="$user->id" />
                            @if($user->status['badge'] === 'success')
                                <a href="https://wa.me/{{ $user->userProfile->phone_number }}?text=Assalamualaikum {{ $user->userProfile->institution_name }}, akun Anda telah diverifikasi. Silakan login kembali ke Pangkalan Data TPA Kapanewon Kasihan. Admin Badko TKA-TPA Kasihan" target="_blank" class="ml-3 btn btn-success"><i class="fab fa-whatsapp"></i> Chat Pengguna</a>
                            @endif
                        </div>
                        

                        {{ $user->userProfile['verification_status'] }}
                    </div>
                </div>
            </div>
            {{-- <button class="btn btn-success btn-block">Save</button> --}}
        </div>
    </div>
    {{-- </form> --}}

</x-layout>
