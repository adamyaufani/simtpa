<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pengguna</h1>
        </div>
    </x-slot:title>

    {{-- <form action="{{ route('admin.store_new_user') }}" method="POST"> --}}
    {{-- @csrf --}}
    <div class="row mb-3">
        <div class="col-md-8 mx-auto">
            <div class="card mb-3 p-3">
                <div class="card-body">                    
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Nama TPA                          
                        </div>
                        <div class="col-md-9">
                            <div class="bg-light" style="width:100%">
                                <p class="alert bg-light">{{ $user->userProfile->institution_name }}                                
                                        <span class="badge badge-{{ $user->status['badge'] }}">
                                            {{ $user->status['message'] }}
                                        </span>                                
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                              Email                           
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Alamat                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->address }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                           Kalurahan                          
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->villageDetail->village_name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Nomor Telepon                          
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->phone_number }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Facebook                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->facebook }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Instagram                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->instagram }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Twitter                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->twitter }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Website                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->website }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Youtube                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->youtube }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Tiktok                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->tiktok }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center"> 
                            Alamat Google Map                         
                        </div>
                        <div class="col-md-9">
                            <p class="alert bg-light">{{ $user->userProfile->gmap_address }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-md-flex align-items-center py-3"> 
                            <x-verification-options :userId="$user->id" />
                                @if ($user->status['badge'] === 'success')
                                    <a href="https://wa.me/{{ $user->userProfile->phone_number }}?text=_Assalamualaikum_ *TPA {{ $user->userProfile->institution_name }}* 
                                        %0ASaat ini akun Anda telah kami verifikasi.%0ASilakan login kembali ke Pangkalan Data TPA Kapanewon Kasihan https://tpa.badkokasihan.web.id/login.%0A%0AHormat kami,%0AAdmin Badko TKA-TPA Kasihan"
                                        target="_blank" class="ml-3 btn btn-success"><i class="fab fa-whatsapp"></i> Chat
                                        Pengguna</a>
                                @endif
                        </div>
                    </div>

                    
                </div>
            </div>
            {{-- <button class="btn btn-success btn-block">Save</button> --}}
        </div>
    </div>
    {{-- </form> --}}

</x-layout>
