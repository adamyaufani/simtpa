<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 mr-2 text-gray-800">Daftar Pengguna</h1>
            <a href="{{ route('admin.create_new_user') }}" class="btn btn-sm btn-primary">
                tambah
            </a>
        </div>
    </x-slot:title>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @foreach($users as $user)
        <div class="card mb-2 border-bottom-{{ $user->status['badge'] }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div>
                            <p>
                                Nama Lengkap :
                            </p>
                            <h6 class="font-weight-bold">
                                <a href="{{ route('admin.detail_user',$user->id) }}"
                                    class="stretched-link">
                                    {{ $user->fullname }}
                                </a>
                            </h6>
                        </div>
                        {{-- <div> --}}
                        {{-- <p> --}}
                        {{-- Username : --}}
                        {{-- </p> --}}
                        {{-- <h6 class="font-weight-bold"> --}}
                        {{-- {{ $user->username }} --}}
                        {{-- </h6> --}}
                        {{-- </div> --}}
                        <div>
                            <p>
                                Alamat Email :
                            </p>
                            <h6 class="font-weight-bold">
                                {{ $user->email }}
                            </h6>
                        </div>
                        <div>
                            <p>
                                Nomor Telepon :
                            </p>
                            <h6 class="font-weight-bold">
                                {{ $user->phone }}
                            </h6>
                        </div>
                        <div>
                            <p>
                                Status Pendaftaran :
                            </p>
                            <h6 class="font-weight-bold">
                                <span class="badge badge-{{ $user->status['badge'] }}">
                                    {{ $user->status['message'] }}
                                </span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{ $users->links() }}

</x-layout>
