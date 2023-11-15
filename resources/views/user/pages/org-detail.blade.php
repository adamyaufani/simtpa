<x-user.layout>


    <div class="row gx-5">
        <div class="col-12">
            <div class="card mb-4  bg-secondary bg-gradient-200">
                <div class="card-body p-5">

                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="{{ url('img/logo-badko.png') }}" width="60"
                                class="align-self-start border border-3 border-white rounded" />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h1 class="h3 text-white">{{ $org->userProfile->institution_name }}</h1>
                            <p class="text-white fs-6 mb-1"><i class="bi bi-geo"></i> {{ $org->userProfile->address }},
                                {{ $org->userProfile->villageDetail->village_name }}, Kasihan, Bantul, DI. Yogyakarta.
                                {{ $org->userProfile->postal_code }}</p>
                            <p class="text-white fs-6 mb-1"><i class="bi bi-whatsapp"></i>
                                +{{ $org->userProfile->phone_number }}</p>
                            <p class="text-white fs-6"><i class="bi bi-geo-alt"></i> <a
                                    href="{{ $org->userProfile->gmap_address }}" class="text-white">Google Map</a></p>
                            <div class="d-flex gap-1 justify-content-end">
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
                <div class="card-body p-5">
                    <div class="d-flex justify-content-center gap-5">
                        <div class="card w-25 bg-info">
                            <div class="card-body d-flex flex-row align-items-center">
                                <p class="flex-fill">Staf Pengajar</p>
                                <p class="fs-1">5</p>
                            </div>
                        </div>
                        <div class="card w-25  bg-success">
                            <div class="card-body d-flex flex-row align-items-center">
                                <p class="flex-fill">Santri Putra</p>
                                <p class="fs-1">15</p>
                            </div>
                        </div>
                        <div class="card w-25  bg-warning">
                            <div class="card-body d-flex flex-row align-items-center">
                                <p class="flex-fill">Santri Putri</p>
                                <p class="fs-1">15</p>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-user.layout>
