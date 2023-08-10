<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Pengguna</h1>
        </div>
    </x-slot:title>

    @foreach($users as $user)
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="font-weight-bold">
                                    <a href="">
                                        {{ $user->username }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="badge badge-{{ $user->status['badge'] }}">
                                        {{ $user->status['message'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p>
                            {{ $user->fullname }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-layout>
