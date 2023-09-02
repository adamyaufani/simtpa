<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Syarat dan Persetujuan Baru</h1>
        </div>
    </x-slot:title>

    <form action="{{ route('admin.store_new_agreement') }}" method="POST">
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
                                id="categoryName" value="{{ old('year_start') }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('year_start') }}
                            </small> </div>
                        <div class="form-group">
                            <label for="categoryName">Tahun Berakhir</label>
                            <input name="year_end" type="date"
                                class="form-control {{ $errors->has('year_end') ? 'is-invalid' : '' }}"
                                id="categoryName" value="{{ old('year_end') }}">
                            <small class="invalid-feedback">
                                {{ $errors->first('year_end') }}
                            </small>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block">Save</button>
            </div>
        </div>
    </form>
</x-layout>
