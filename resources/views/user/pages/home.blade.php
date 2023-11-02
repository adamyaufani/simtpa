<x-user.layout>


            <div class="row gx-5">
                <div class="col-lg-8 offset-lg-2 mb-5 mb-lg-0">
                    <h3 class="fw-bolder mb-4">Agenda Mendatang</h3>                  
                   

                    <ul class="nav nav-tabs mb-3">  
                        <li class="nav-item d-none d-md-block">
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
 

</x-user.layout>
