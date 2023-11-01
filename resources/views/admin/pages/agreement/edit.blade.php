<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Syarat dan Persetujuan</h1>
        </div>
    </x-slot:title>

    <form action="{{ route('admin.update_agreement',$agreement->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <h4 class="mb-3">Detail Syarat dan Persetujuan</h4>
                        <div class="form-group">
                            <label for="categoryName">Tahun Mulai</label>
                            <input name="year_start" type="date"
                                class="form-control {{ $errors->has('year_start') ? 'is-invalid' : '' }}"
                                id="categoryName" value="{{ $agreement->year_start }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('year_start') }}
                            </small> </div>
                        <div class="form-group">
                            <label for="categoryName">Tahun Berakhir</label>
                            <input name="year_end" type="date"
                                class="form-control {{ $errors->has('year_end') ? 'is-invalid' : '' }}"
                                id="categoryName" value="{{ $agreement->year_end }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('year_end') }}
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Isi Persetujuan</label>
                            <textarea name="content" id="content"
                                class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                cols="30" rows="10">{{ $agreement->content }}</textarea>
                            <small class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </small>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block">Save</button>
            </div>
        </div>
    </form>

    @push('page_js')
        <script src="{{ asset('vendor/tinymce_6.7.1/tinymce/js/tinymce/tinymce.min.js') }}">
        </script>
        <script>
            tinymce.init({
                selector: 'textarea#content',
                plugins: 'lists',
                toolbar: 'undo redo | styles | bold italic',
                language: 'id'
            })

        </script>
    @endpush
</x-layout>
