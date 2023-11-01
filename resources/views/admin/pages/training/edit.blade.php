<x-layout>

    @push('page_css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
            integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Event</h1>
        </div>
    </x-slot:title>

    <form class="row mb-3" action="{{ route('admin.update_training',$training->id) }}"
        method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Detail Event</h4>
                    <div class="form-group">
                        <label for="trainingName">Nama Event</label>
                        <input name="name" type="text"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            id="trainingName" aria-describedby="name" value="{{ $training->name }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingName">Banner Event</label>
                        <input name="image" type="file"
                            class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                            id="trainingImage" value="{{ old('image') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingDescription">Deskripsi</label>
                        <textarea name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            id="trainingDescription" rows="3">{{ $training->description }}</textarea>
                        <small class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingPlace">Tempat</label>
                        <input name="place" type="text"
                            class="form-control {{ $errors->has('place') ? 'is-invalid' : '' }}"
                            id="trainingPlace" aria-describedby="place" value="{{ $training->place }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('place') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Tanggal</h4>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input name="start_date" type="datetime-local"
                            class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                            id="startDate" value="{{ $training->start_date }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input name="end_date" type="datetime-local"
                            class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                            id="endDate" value="{{ $training->end_date }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </small>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Kategori</h4>
                    <div class="form-group">
                        <label for="categoryName">Cari berdasarkan nama kategori</label>
                        <select class="form-control" name="category_id[]" id="select_category" multiple="multiple">
                            @foreach($detailedTrainingCategories as $category)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">
                                {{ $errors->first('category_id') }}
                            </small>
                        @enderror
                    </div>
                    <p>atau</p>
                    <a href="{{ route('admin.create_new_category') }}" target="_blank"
                        class="btn btn-primary">
                        Tambah kategori baru
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Kuota</h4>
                    <div class="form-group">
                        <label for="trainingQuota">Kuota per organisasi</label>
                        <small>(Kosongkan untuk kuota tak terbatas)</small>
                        <input name="quota" type="number"
                            class="form-control {{ $errors->has('quota') ? 'is-invalid' : '' }}"
                            id="trainingQuota" aria-describedby="quota" value="{{ $training->quotaPerOrg->quota }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('quota') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Jenis Kelamin Peserta</h4>
                    <div class="form-group">
                        <label for="trainingQuota">Jenis Kelamin Peserta</label>
                        <select id=""
                            class="form-control {{ $errors->has('gender_requirement') ? 'is-invalid' : '' }}"
                            name="gender_requirement">
                            <option value="">Pilih jenis kelamin</option>
                            @foreach($genderRequirements as $gender)
                                <option value="{{ $gender->value }}"
                                    {{ $training->gender_requirement == $gender->value ? 'selected' : '' }}>
                                    {{ $gender->value }}
                                </option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback">
                            {{ $errors->first('gender_requirement') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Lahir sebelum tanggal</h4>
                    <div class="form-group">
                        <label for="trainingQuota">Peserta harus yang lahir sebelum tanggal</label>
                        <input type="date" name="date_of_birth_requirement"
                            class="form-control {{ $errors->has('date_of_birth_requirement') ? 'is-invalid' : '' }}"
                            value="{{ $training->date_of_birth_requirement }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('date_of_birth_requirement') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4
                        class="mb-3 {{ $errors->has('cost') ? 'text-danger' : '' }}">
                        Biaya
                    </h4>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input {{ $errors->has('cost') ? 'is-invalid' : '' }}"
                            type="radio" name="cost" id="paid" value="paid"
                            {{ $training->cost == 'paid' ? 'checked' : '' }}>
                        <label class="form-check-label" for="paid">Berbayar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input {{ $errors->has('cost') ? 'is-invalid' : '' }}"
                            type="radio" name="cost" id="free" value="free"
                            {{ $training->cost == 'free' ? 'checked' : '' }}>
                        <label class="form-check-label" for="free">Gratis</label>
                    </div>
                    <br>
                    <small class="text-danger">
                        {{ $errors->first('cost') }}
                    </small>
                </div>
            </div>
            <button class="btn btn-success btn-block">Simpan</button>
        </div>
    </form>

    @push('page_js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-single').select2({
                    theme: "bootstrap",
                    ajax: {
                        url: "{{ route('admin.get_trainer_by_name') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            console.log(data);
                            return {
                                results: $.map(data, function (item) {
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

                $("input[name='cost']").change(function () {
                    if ($(this).val() === "paid") {
                        // Add the price field to the DOM

                        let price_normal = "{{ $training->price_normal }}";

                        $('<div class="form-group mt-3" id="priceField">' +
                            '<label for="price_normal">Harga</label>' +
                            '<input type="text" class="form-control" id="price_normal" name="price_normal"' +
                            ` value="${ price_normal }">` +
                            '</div>').insertAfter('.text-danger:last');
                    } else if ($(this).val() === "free") {
                        // Remove the price field from the DOM
                        $("#priceField").remove();
                    }
                });
            });

        </script>

        <script>
            $(document).ready(function () {
                $('#select_category').select2({
                    theme: "bootstrap",
                    ajax: {
                        url: "{{ route('admin.get_category_by_name') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            console.log(data);
                            return {
                                results: $.map(data, function (item) {
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

        @if($training->cost=='paid')
            <script>
                $(document).ready(function () {
                    let price_normal = "{{ $training->price_normal }}";
                    let invalid_class =
                        "{{ $errors->has('price_normal') ? 'is-invalid' : '' }}";

                    $('<div class="form-group mt-3" id="priceField">' +
                        '<label for="price_normal">Harga</label>' +
                        `<input type="text" class="form-control ${invalid_class}" id="price_normal" name="price_normal"
                            value="${ price_normal }">` +
                        `<span class="invalid-feedback">` +
                        "{{ $errors->first('price_normal') }}" +
                        '</span>' +
                        '</div>').insertAfter('.text-danger:last');
                });

            </script>
        @endif

        {{-- @if(old('category_id')!=null) --}}
        {{-- <script>
            const category_id = "{{ $training->category_id }}";
        const category_name =
        "{{ App\Models\Category::find($training->category_id)->name }}";
        $("#select_category").html('<option value="' + category_id + '" selected>' + category_name +
            '</option>');

        </script> --}}
        {{-- @endif --}}
    @endpush
</x-layout>
