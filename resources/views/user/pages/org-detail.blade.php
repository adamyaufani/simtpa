<x-user.layout>

    @push('css')
        <style>
            .bg-profile {
                background: url('{{ route('training.image') . '?q=' . $org->userProfile->organization_building_photo }}') left top no-repeat;
                background-size: cover;
            }
        </style>
    @endpush


    <div class="row gx-5">
        <div class="col-12">

            <div
                class="card mb-4   
            @if ($org->userProfile->organization_building_photo) bg-profile
            @else 
                bg-secondary bg-gradient @endif 
            
            ">
                <div class="card-body p-3 p-md-5">

                    <div class="d-flex flex-column flex-md-row">
                        <div class="flex-shrink-0">

                            @if ($org->userProfile->organization_logo)
                                <img src="{{ route('training.image') . '?q=' . $org->userProfile->organization_logo }}"
                                    width="60" class="align-self-start border border-3 border-white rounded" />
                            @else
                                <img src="{{ url('img/logo-badko.png') }}" width="60"
                                    class="align-self-start border border-3 border-white rounded" />
                            @endif

                        </div>
                        <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                            <h1 class="h3 text-white">TPA {{ $org->userProfile->institution_name }}</h1>
                            <p class="text-white fs-6 mb-1"><i class="bi bi-geo"></i> {{ $org->userProfile->address }},
                                {{ $org->userProfile->villageDetail->village_name }}, Kasihan, Bantul, DI. Yogyakarta.
                                {{ $org->userProfile->postal_code }}</p>
                            <p class="text-white fs-6 mb-1"><i class="bi bi-whatsapp"></i>
                                +{{ $org->userProfile->phone_number }}</p>
                            @if ($org->userProfile->website)
                                <p class="text-white fs-6"><i class="bi bi-browser-chrome"></i> <a
                                        href="{{ $org->userProfile->website }}"
                                        class="text-white">{{ $org->userProfile->website }}</a>
                                </p>
                            @endif
                            @if ($org->userProfile->gmap_address)
                                <p class="text-white fs-6"><i class="bi bi-geo-alt"></i> <a
                                        href="{{ $org->userProfile->gmap_address }}" class="text-white">Google Map</a>
                                </p>
                            @endif

                            <div class="d-flex gap-1 justify-content-start justify-content-md-end">
                                @if ($org->userProfile->facebook)
                                    <a href="{{ $org->userProfile->facebook }}" class="btn btn-sm btn-info"><i
                                            class="bi bi-facebook"></i></a>
                                @endif
                                @if ($org->userProfile->instagram)
                                    <a href="{{ $org->userProfile->instagram }}" class="btn btn-sm btn-warning"><i
                                            class="bi bi-instagram"></i></a>
                                @endif
                                @if ($org->userProfile->youtube)
                                    <a href="{{ $org->userProfile->youtube }}" class="btn btn-sm btn-danger"><i
                                            class="bi bi-youtube"></i></a>
                                @endif
                                @if ($org->userProfile->tiktok)
                                    <a href="{{ $org->userProfile->tiktok }}" class="btn btn-sm btn-dark"><i
                                            class="bi bi-tiktok"></i></a>
                                @endif
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


                    <div class="card">
                        <div class="card-header">
                            Tim Pengelola
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            @if ($administrator['director']->photo ) 
                                                <img class="img-thumbnail" width="70" src="{{ route('training.image').'?q='.$staff->photo }}" />
                                            @else
                                                @if ($administrator['director']->gender === 'perempuan')
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadzah.png') }}" />
                                                @else
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadz.png') }}" />    
                                                @endif
                                            @endif                                            
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="fs-6 mb-0 fw-bold text-capitalize">{{ $administrator['director']->name ?? '' }}</p>
                                            <p>Direktur</p>                                            
                                        </div>
                                      </div>                                  
                                </div>                                                               
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            @if ($administrator['vice_director']->photo ) 
                                                <img class="img-thumbnail" width="70" src="{{ route('training.image').'?q='.$staff->photo }}" />
                                            @else
                                                @if ($administrator['vice_director']->gender === 'perempuan')
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadzah.png') }}" />
                                                @else
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadz.png') }}" />    
                                                @endif
                                            @endif                                            
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="fs-6 mb-0 fw-bold text-capitalize">{{ $administrator['vice_director']->name ?? '' }}</p>
                                            <p>Wakil Direktur</p>                                            
                                        </div>
                                      </div>                                  
                                </div>                                                               
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            @if ($administrator['secretary']->photo ) 
                                                <img class="img-thumbnail" width="70" src="{{ route('training.image').'?q='.$staff->photo }}" />
                                            @else
                                                @if ($administrator['secretary']->gender === 'perempuan')
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadzah.png') }}" />
                                                @else
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadz.png') }}" />    
                                                @endif
                                            @endif                                            
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="fs-6 mb-0 fw-bold text-capitalize">{{ $administrator['secretary']->name ?? '' }}</p>
                                            <p>Sekretaris</p>                                            
                                        </div>
                                      </div>                                  
                                </div>                                                               
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            @if ($administrator['treasurer']->photo ) 
                                                <img class="img-thumbnail" width="70" src="{{ route('training.image').'?q='.$staff->photo }}" />
                                            @else
                                                @if ($administrator['treasurer']->gender === 'perempuan')
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadzah.png') }}" />
                                                @else
                                                    <img class="img-thumbnail" width="70" src="{{ url('img/ustadz.png') }}" />    
                                                @endif
                                            @endif                                            
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="fs-6 mb-0 fw-bold text-capitalize">{{ $administrator['treasurer']->name ?? '' }}</p>
                                            <p>Bendahara</p>                                            
                                        </div>
                                      </div>                                  
                                </div>                                                               
                             </div>

                        </div>
                     
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-user.layout>
