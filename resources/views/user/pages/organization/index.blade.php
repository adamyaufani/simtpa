<x-user.layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    @endpush
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="row mb-5">
                    <form action="{{ route('user.update_organization',$administrator->id) }}"
                        method="POST">
                        @method('PUT')
                        @csrf

                        <div class="col-lg-12">
                            <h4 class="mb-3">Sturuktur Pengurus TPA</h4>

                            Induk Organisasi (input text)

                            <div class="mb-4">
                                <label for="director">Direktur TPA</label>
                                <select name="director"
                                    class="form-control {{ $errors->has('director') ? 'is-invalid' : '' }}"
                                    id="director">
                                    <option value="">Pilih Pengurus</option>
                                </select>
                                @error('director')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="vice_director">Wakil Direktur</label>
                                <select name="vice_director"
                                    class="form-control {{ $errors->has('vice_director') ? 'is-invalid' : '' }}"
                                    id="vice_director">
                                    <option value="">Pilih Pengurus</option>

                                    <option value="">nama Pengurus</option>

                                </select>
                                @error('vice_director')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="secretary">Sekretaris</label>
                                <select name="secretary"
                                    class="form-control {{ $errors->has('secretary') ? 'is-invalid' : '' }}"
                                    id="secretary">
                                    <option value="">Pilih Pengurus</option>

                                    <option value="">nama Pengurus</option>

                                </select>
                                @error('secretary')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="treasurer">Bendahara</label>
                                <select name="treasurer"
                                    class="form-control {{ $errors->has('treasurer') ? 'is-invalid' : '' }}"
                                    id="treasurer">
                                    <option value="">Pilih Pengurus</option>

                                    <option value="">nama Pengurus</option>

                                </select>
                                @error('treasurer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @if($administrator->director()->first()!=null)
            <script>
                $('#director').html("<option value='" +
                    "{{ $administrator->director()->first()->id }}" + "' selected>" +
                    "{{ $administrator->director()->first()->name }}" + "</option>");

            </script>
        @endif

        @if($administrator->viceDirector()->first()!=null)
            <script>
                $('#vice_director').html("<option value='" +
                    "{{ $administrator->viceDirector()->first()->id }}" + "' selected>" +
                    "{{ $administrator->viceDirector()->first()->name }}" + "</option>");

            </script>
        @endif

        @if($administrator->secretary()->first()!=null)
            <script>
                $('#secretary').html("<option value='" +
                    "{{ $administrator->secretary()->first()->id }}" + "' selected>" +
                    "{{ $administrator->secretary()->first()->name }}" + "</option>");

            </script>
        @endif

        @if($administrator->treasurer()->first()!=null)
            <script>
                $('#treasurer').html("<option value='" +
                    "{{ $administrator->treasurer()->first()->id }}" + "' selected>" +
                    "{{ $administrator->treasurer()->first()->name }}" + "</option>");

            </script>
        @endif

        <script>
            $(document).ready(function () {
                $('#director').select2({
                    theme: "bootstrap-5",
                    ajax: {
                        url: "{{ route('user.get_staff_by_name') }}",
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

                $('#vice_director').select2({
                    theme: "bootstrap-5",
                    ajax: {
                        url: "{{ route('user.get_staff_by_name') }}",
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

                $('#secretary').select2({
                    theme: "bootstrap-5",
                    ajax: {
                        url: "{{ route('user.get_staff_by_name') }}",
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

                $('#treasurer').select2({
                    theme: "bootstrap-5",
                    ajax: {
                        url: "{{ route('user.get_staff_by_name') }}",
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
    @endpush

</x-user.layout>
