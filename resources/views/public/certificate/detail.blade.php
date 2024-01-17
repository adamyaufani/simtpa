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
                        <div class="card-header">
                            <h5 class="mb-0">Sertifikat Lomba</h5>
                        </div>
                        <div class="card-body">
                            <p>
                                Penerima :
                                {{ $certificate->order->training->participant_type == 'santri' ? $certificate->student->name : $certificate->staff->name }}
                            </p>
                            <p>
                                Nama Event : {{ $certificate->order->training->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('js')
        <script src="{{ asset('js/jquery-datatable-1.13.6.min.js') }}"></script>
        <script src="{{ asset('js/datatable-1.13.6-bootstrap-5.min.js') }}"></script>

    @endpush

</x-user.layout>
