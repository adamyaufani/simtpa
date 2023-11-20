<x-user.layout>
    @push('css')
        {{-- <link rel="stylesheet" href="{{ asset('css/datatable-bootstrap-5.min.css') }}">
        --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @endpush


    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <h4 class="mb-3">Staf TPA</h4>
                <div>
                    <a href="{{ route('user.create_staff') }}" class="btn btn-primary btn-sm"><i
                            class="bi bi-plus"></i>
                        Tambah Staf Baru
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 70%">Nama</th>
                                <th style="width: 25%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ $staff->name }}
                                    </td>

                                    <td class="text-md-end text-sm-center">
                                        {{-- <div class="col-12 d-flex mt-3"> --}}
                                        <a href="{{ route('user.staff_edit', $staff->id) }}"
                                            class="btn btn-outline-warning btn-sm mr-3"> <i class="bi bi-pencil"></i>
                                            Edit
                                        </a>
                                        {{-- <form action="{{ route('user.delete_staff', $staff->id) }}"
                                                            method="POST" onsubmit="return confirmDelete()">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-outline-danger btn-sm">
                                                                hapus
                                                            </button>
                                                        </form> --}}
                                        {{-- </div> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    @push('js')
        <script src="{{ asset('js/jquery-datatable-1.13.6.min.js') }}"></script>
        <script src="{{ asset('js/datatable-1.13.6-bootstrap-5.min.js') }}"></script>
        <script>
            function confirmDelete() {
                // Display the alert message
                return confirm("Hapus data ini? Data yang sudah dihapus tidak bisa dikembalikan dengan cara apapun.");
            }

            const table = new DataTable('#example', {
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0
                }],
                order: [
                    [1, 'asc']
                ]
            });

            table
                .on('order.dt search.dt', function() {
                    let i = 1;

                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });
                })
                .draw();
        </script>
    @endpush
</x-user.layout>
