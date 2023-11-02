<x-user.layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    @endpush
    <form action="{{ route('user.fill_order', $training->id) }}" method="POST">

        @csrf
        <input type="hidden" name="training_id" value="{{ $training->id }}">
        <div class="row">
            <div class="col-12 col-md-9">
                <h4>Data Peserta</h4>
                <!-- peserta yang dimunculkan sesuai jenis kelamin yg dipilih saat create event -->

                @for ($i = 1; $i <= $participants; $i++)
                    <div class="card mb-3 participantss">
                        <div class="card-body">
                            <h5>Peserta {{ $i }}</h5>
                            <div class="mb-3">
                                <small class="form-label text-secondary"><b>Nama lengkap</b></small>
                                <select type="text" name="student_id[]" class="form-control select-student">
                                    <option>Pilih peserta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="col-12 col-md-3">
                <h4>Detail Pembayaran</h4>
                <div class="card">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td><span class="text-secondary">Harga Training</span></td>
                                <td><span class="ms-3">Rp. {{ $price }}</span></td>
                            </tr>
                            <tr>
                                <td><span class="text-secondary">Jumlah Peserta</span></td>
                                <td><span class="ms-3">{{ $participants }} orang</span></td>
                            </tr>
                            <tr>
                                <td><span class="text-secondary">Total</span></td>
                                <td>
                                    <span class="ms-3">Rp. {{ $totalPrice }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-2">
                    <button class="btn btn-primary" type="submit">Tambahkan ke Keranjang</button>
                </div>
            </div>
        </div>

    </form>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            var additionalData = {
                gender: "{{ $training->gender_requirement == 'laki-laki dan perempuan' ? '' : $training->gender_requirement }}",
                birth_date: "{{ $training->date_of_birth_requirement }}",
            };
            $(document).ready(function() {
                $('.select-student').select2({
                    theme: 'bootstrap-5',
                    ajax: {
                        url: "{{ route('user.student_by_name') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            // params.term contains the user input
                            // Add the additional data to the request
                            return {
                                q: params.term, // User input
                                extraData: additionalData // Additional data
                            };
                        },
                        processResults: function(data) {
                            console.log(data);
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>
    @endpush
</x-user.layout>
