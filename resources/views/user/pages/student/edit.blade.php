<x-user.layout>

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
            <div class="d-flex flex-column">
                <h4 class="mb-3">Edit Santri</h4>
                <p class="mb-3">Yang diberi tanda * (bintang) wajib diisi.</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update_student', $student->id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        {{-- Name --}}
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">{{ __('Nama Lengkap *') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') ?? $student->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Gender --}}
                        <div class="row mb-3">
                            <label for="gender" class="col-sm-2 col-form-label">{{ __('Jenis Kelamin *') }}</label>
                            <div class="col-sm-10">
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                    name="gender">
                                    @foreach ($gender as $gender)
                                        <option value="{{ $gender->value }}"
                                            {{ $student->gender == $gender->value ? 'selected' : '' }}>
                                            {{ $gender->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Birth Place --}}
                        <div class="row mb-3">
                            <label for="birth_place" class="col-sm-2 col-form-label">{{ __('Tempat Lahir *') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('birth_place') is-invalid @enderror"
                                    id="birth_place" name="birth_place"
                                    value="{{ old('birth_place') ?? $student->birth_place }}">
                                @error('birth_place')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Birth Date --}}
                        <div class="row mb-3">
                            <label for="birth_date" class="col-sm-2 col-form-label">{{ __('Tanggal Lahir *') }}</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                    id="birth_date" name="birth_date"
                                    value="{{ old('birth_date') ?? $student->birth_date }}">
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="row mb-3">
                            <label for="address" class="col-sm-2 col-form-label">{{ __('Alamat') }}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') ?? $student->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Father's Name --}}
                        <div class="row mb-3">
                            <label for="father_name" class="col-sm-2 col-form-label">{{ __('Nama Ayah') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                    id="father_name" name="father_name"
                                    value="{{ old('father_name') ?? $student->father_name }}">
                                @error('father_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Mother's Name --}}
                        <div class="row mb-3">
                            <label for="mother_name" class="col-sm-2 col-form-label">{{ __('Nama Ibu') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                    id="mother_name" name="mother_name"
                                    value="{{ old('mother_name') ?? $student->mother_name }}">
                                @error('mother_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">{{ __('Nomor Telephone') }}</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') ?? $student->phone }}">

                                <small class="text-secondary">Contoh : 628561234567, tidak perlu gunakan +, dan tidak
                                    perlu gunakan pemisah (- atau spasi)</small>

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- School --}}
                        <div class="row mb-3">
                            <label for="school" class="col-sm-2 col-form-label">{{ __('Asal Sekolah') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('school') is-invalid @enderror"
                                    id="school" name="school" value="{{ old('school') ?? $student->school }}">
                                @error('school')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Join Date --}}
                        <div class="row mb-3">
                            <label for="join_date"
                                class="col-sm-2 col-form-label">{{ __('Tanggal Bergabung') }}</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('join_date') is-invalid @enderror"
                                    id="join_date" name="join_date"
                                    value="{{ old('join_date') ?? $student->join_date }}">
                                @error('join_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row mb-3">
                            <label for="status" class="col-sm-2 col-form-label">{{ __('Status Lulus') }}</label>
                            <div class="col-sm-10">
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="belum lulus"
                                        {{ $student->status == 'belum lulus' ? 'selected' : '' }}>
                                        Belum Lulus
                                    </option>
                                    <option value="lulus" {{ $student->status == 'lulus' ? 'selected' : '' }}>
                                        Lulus
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Ability Level Upon Entry --}}
                        <div class="row mb-3">
                            <label for="ability_level_upon_entry"
                                class="col-sm-2 col-form-label">{{ __('Tingkatan Saat Masuk TPA') }}</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control @error('ability_level_upon_entry') is-invalid @enderror"
                                    id="ability_level_upon_entry" name="ability_level_upon_entry"
                                    value="{{ old('ability_level_upon_entry') ?? $student->ability_level_upon_entry }}">
                                @error('ability_level_upon_entry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Birth Certificate --}}
                        <div class="row mb-3">
                            <label for="birth_certificate"
                                class="col-sm-2 col-form-label">{{ __('Akta Kelahiran *') }} </label>
                            <div class="col-sm-10">
                                <small class="text-secondary">File JPG, JPEG, ukuran maksimal 1 MB. Akta tidak perlu
                                    difoto penuh, cukup di bagian nama dan tanggal lahir saja.</small>
                                <input type="file"
                                    class="form-control @error('birth_certificate') is-invalid @enderror"
                                    id="birth_certificate" name="birth_certificate">

                                @error('birth_certificate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($student->birth_certificate)
                                    <img class="mt-3"
                                        src="{{ route('user.images') . '?q=' . $student->birth_certificate }}"
                                        alt="">
                                @endif
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


        </div>
    </div>

</x-user.layout>
