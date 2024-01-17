<x-user.layout>

    @push('css')
        {{-- <link rel="stylesheet" href="{{ asset('css/datatable-bootstrap-5.min.css') }}">
        --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @endpush
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%"></th>
                                        <th style="width: 40%">Nama Event</th>
                                        <th style="width: 55%">Nama Peserta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certificates as $certificate)
                                        <tr>
                                            <td></td>
                                            <td>
                                                <a
                                                    href="{{ route('public.download_certificate', $certificate->id) }}">
                                                    {{ $certificate->order->training->name }}
                                                </a>
                                            </td>
                                            <td>
                                                @if(
                                                    $certificate->order->training->participant_type == 'santri')
                                                    {{ $certificate->student->name }}
                                                @elseif(
                                                    $certificate->order->training->participant_type == 'staff')
                                                    {{ $certificate->staff->name }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                .on('order.dt search.dt', function () {
                    let i = 1;

                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function (cell) {
                            this.data(i++);
                        });
                })
                .draw();

        </script>
    @endpush

</x-user.layout>
