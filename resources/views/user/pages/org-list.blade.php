<x-user.layout>

    @push('css')
        {{-- <link rel="stylesheet" href="{{ asset('css/datatable-bootstrap-5.min.css') }}">
        --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @endpush
    <h4 class="card-title mb-3">
        Data TPA se Kapanewon Kasihan
    </h4>
    <div class="row gx-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 25%">Nama TPA</th>                               
                                <th style="width: 45%">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organizations as $org)
                                <tr>
                                    <td></td>
                                    <td><a
                                        href="{{ route('public.detail_org', $org->id) }}">
                                        TPA {{ $org->userProfile->institution_name }}
                                    </a></td>
                                 
                                    <td>{{ $org->userProfile->address }} {{ $org->userProfile->villageDetail->village_name }}</span></td>
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
