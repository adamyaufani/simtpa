<x-layout>
    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Surat Baru</h1>
        </div>
    </x-slot:title>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.store_letter') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="letter-number">Nomor Surat</label>
                    <input type="text" name="letter_number" id="letter-number"
                        class="form-control {{ $errors->has('letter_number') ? 'is-invalid' : '' }}"
                        value="{{ old('letter_number') }}">
                    @if($errors->has('letter_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('letter_number') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="subject">Hal</label>
                    <input type="text" name="subject" id="subject"
                        class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}"
                        value="{{ old('subject') }}">
                    @if($errors->has('subject'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="attachment">Lampiran</label>
                    <textarea name="attachment" id="attachment" cols="10" rows="10"
                        class="form-control {{ $errors->has('attachment') ? 'is-invalid' : '' }}">{{ old('attachment') }}</textarea>
                    @if($errors->has('attachment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('attachment') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="content">Isi Surat</label>
                    <textarea name="content" id="content" cols="10" rows="10"
                        class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
                    @if($errors->has('content'))
                        <div class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                    @endif
                </div>
                <button class="btn btn-success btn-block" type="submit">Simpan</button>
            </form>
        </div>
    </div>

    @push('page_js')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('vendor/tinymce_6.7.1/tinymce/js/tinymce/tinymce.min.js') }}">
        </script>
        <script>
            function confirmSubmit() {
                var confirmSubmission = confirm(
                    "Anda yakin ingin menghapus event ini? Event yang sudah dihapus tidak dapat dikembalikan dengan cara apapun."
                );
                return confirmSubmission;
            }

            const table = new DataTable('#dataTable');

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

            tinymce.init({
                selector: 'textarea',
                plugins: 'lists',
                toolbar: 'undo redo | styles | bold italic',
                language: 'id',
            })

        </script>
    @endpush

</x-layout>
