<x-user.layout>

    @if(! auth()->check())
    <!-- Header-->
     <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">Pangkalan Data TPA Kapanewon Kasihan
                        </h1>
                        <p class="lead fw-normal text-white-50 mb-4">Unit TPA yang belum bergabung silakan klik tombol Daftar.</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-danger btn-lg px-4 me-sm-3" href="{{ route('user.login_form') }}">Login TPA</a>
                            <a class="btn btn-outline-light btn-lg px-4" href="{{ route('user.registration_form') }}">Daftar</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <img class="img-fluid rounded-3 my-5" src="https://badkokasihan.web.id/wp-content/uploads/2023/10/fasi-kasihan3.jpg"
                        alt="..." />
                </div>
            </div>
        </div>
    </header> 

    @endif


    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-8 offset-lg-2 mb-5 mb-lg-0">
                    <h2 class="fw-bolder mb-4">Agenda Mendatang</h2>                  
                   

                    <ul class="nav nav-tabs mb-3">  
                        <li class="nav-item">
                            <a class="nav-link   @if(url()->full() === route('user.homepage') ) active @endif"  href="{{ route('user.homepage') }}">Semua Kategori</a>
                        </li>                     
                     
                        @foreach($categories as $category)
                       
                            <li class="nav-item">
                                <a class="nav-link   @if(url()->full() === route('user.homepage') . '/?category=' . $category->id) active @endif"  href="{{ route('user.homepage').'?category='.$category->id }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        
                      </ul>                    
           

                    @foreach($trainings as $training)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('user.training_detail',$training->id) }}"
                                                class="stretched-link">
                                                {{ $training->name }}
                                            </a>
                                        </h5>
                                        {{-- <p class="card-text">
                                            {{ str()->limit($training->description,300) }}
                                        </p> --}}
                                        {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small> --}}
                                        {{-- </p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-user.layout>
