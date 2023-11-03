<x-layout>
<<<<<<< HEAD

    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

=======
    @push('page_css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}"
            rel="stylesheet">
    @endpush
>>>>>>> upstream/master
    <x-slot:title>
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 mr-2 text-gray-800">Daftar Pengguna</h1>
            <a href="{{ route('admin.create_new_user') }}" class="btn btn-sm btn-primary">
                tambah
            </a>
        </div>
    </x-slot:title>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="form-group d-flex align-items-center">
                    <span class="col-4 mr-0">Search</span>
                    <input type="text" name="term" id="term" class="form-control form-control-sm col-8">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama TPA</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-bottom-{{ $user->status['badge'] }}">
                                <td>
                                    <a href="{{ route('admin.detail_user', $user->id) }}">
                                        {{ $user->userProfile->institution_name }}</a>
                                </td>
                                <td> {{ $user->email }}</td>
                                <td>{{ $user->userProfile->phone_number }}</td>
                                <td> <span class="badge badge-{{ $user->status['badge'] }}">
                                        {{ $user->status['message'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    @push('js')
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/demo/datatables-demo.js') }}">
    </script>

        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "order": [
                        [1, "desc"]
                    ]
                });
            });
        </script>
    @endpush

</x-layout>
