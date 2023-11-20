<x-user.layout>

    @push('css')
        <style>
            .bg-profile {
                background: url('{{ route('user.images') . '?q=' . $org->userProfile->organization_building_photo }}') left top no-repeat;
                background-size: cover;
            }
        </style>
    @endpush


    <div class="row gx-5">
        <div class="col-12">        

            <div class="card mb-4   
            @if($org->userProfile->organization_building_photo) 
                bg-profile
            @else 
                bg-secondary bg-gradient 
            @endif 
            
            ">
                <div class="card-body p-3 p-md-5">

                    <div class="d-flex flex-column flex-md-row">
                        <div class="flex-shrink-0">

                            @if($org->userProfile->organization_logo)
                                <img src="{{ route('user.images') . '?q=' . $org->userProfile->organization_logo }}"
                            width="60" class="align-self-start border border-3 border-white rounded" />
                            @else
                            <img src="{{  url('img/logo-badko.png') }}"
                                width="60" class="align-self-start border border-3 border-white rounded" />
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                            <h1 class="h3 text-white">TPA {{ $org->userProfile->institution_name }}</h1>
                            <p class="text-white fs-6 mb-1"><i class="bi bi-geo"></i> {{ $org->userProfile->address }},
                                {{ $org->userProfile->villageDetail->village_name }}, Kasihan, Bantul, DI. Yogyakarta.
                                {{ $org->userProfile->postal_code }}</p>
                            <p class="text-white fs-6 mb-1"><i class="bi bi-whatsapp"></i>
                                +{{ $org->userProfile->phone_number }}</p>
                            <p class="text-white fs-6"><i class="bi bi-geo-alt"></i> <a
                                    href="{{ $org->userProfile->gmap_address }}" class="text-white">Google Map</a></p>
                            <div class="d-flex gap-1 justify-content-start justify-content-md-end">
                                <a href="{{ $org->userProfile->facebook }}" class="btn btn-sm btn-outline-info"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="{{ $org->userProfile->instagram }}" class="btn btn-sm btn-outline-light"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="{{ $org->userProfile->youtube }}" class="btn btn-sm btn-outline-danger"><i
                                        class="bi bi-youtube"></i></a>
                                <a href="{{ $org->userProfile->tiktok }}" class="btn btn-sm btn-outline-dark"><i
                                        class="bi bi-tiktok"></i></a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card">
                <div class="card-body p-3 p-md-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-info bg-gradient mb-4">
                                <div class="card-body d-flex flex-row align-items-center">
                                    <p class="flex-fill">Staf Pengajar</p>
                                    <p class="fs-1">{{ $org->staffs->count() }}</p>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success bg-gradient mb-4">
                                <div class="card-body d-flex flex-row align-items-center">
                                    <p class="flex-fill">Santri Putra</p>
                                    <p class="fs-1">{{ $org->students->where('gender', 'laki-laki')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning bg-gradient mb-4">
                                <div class="card-body d-flex flex-row align-items-center">
                                    <p class="flex-fill">Santri Putri</p>
                                    <p class="fs-1"> {{ $org->students->where('gender', 'perempuan')->count() }}</p>
                                </div>
                            </div>
                        </div>               
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-user.layout>
