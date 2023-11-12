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
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nama Lengkap *') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ $student->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <form method="POST"
                                    action="{{ route('user.update_student',$student->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    {{-- Name --}}
                                    <div class="mb-3">
                                        <label for="name"
                                            class="form-label">{{ __('Nama Lengkap') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name"
                                            value="{{ old('name') ?? $student->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Gender --}}
                                    <div class="mb-3">
                                        <label for="gender"
                                            class="form-label">{{ __('Jenis Kelamin') }}</label>
                                        <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                            name="gender">
                                            @foreach($gender as $gender)
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

                                    {{-- Birth Place --}}
                                    <div class="mb-3">
                                        <label for="birth_place"
                                            class="form-label">{{ __('Tempat Lahir') }}</label>
                                        <input type="text"
                                            class="form-control @error('birth_place') is-invalid @enderror"
                                            id="birth_place" name="birth_place"
                                            value="{{ old('birth_place') ?? $student->birth_place }}">
                                        @error('birth_place')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Birth Date --}}
                                    <div class="mb-3">
                                        <label for="birth_date"
                                            class="form-label">{{ __('Tanggal Lahir') }}</label>
                                        <input type="date"
                                            class="form-control @error('birth_date') is-invalid @enderror"
                                            id="birth_date" name="birth_date"
                                            value="{{ old('birth_date') ?? $student->birth_date }}">
                                        @error('birth_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Address --}}
                                    <div class="mb-3">
                                        <label for="address"
                                            class="form-label">{{ __('Alamat') }}</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address"
                                            rows="3">{{ old('address') ?? $student->address }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Father's Name --}}
                                    <div class="mb-3">
                                        <label for="father_name"
                                            class="form-label">{{ __('Nama Ayah') }}</label>
                                        <input type="text"
                                            class="form-control @error('father_name') is-invalid @enderror"
                                            id="father_name" name="father_name"
                                            value="{{ old('father_name') ?? $student->father_name }}">
                                        @error('father_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Mother's Name --}}
                                    <div class="mb-3">
                                        <label for="mother_name"
                                            class="form-label">{{ __('Nama Ibu') }}</label>
                                        <input type="text"
                                            class="form-control @error('mother_name') is-invalid @enderror"
                                            id="mother_name" name="mother_name"
                                            value="{{ old('mother_name') ?? $student->mother_name }}">
                                        @error('mother_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div class="mb-3">
                                        <label for="phone"
                                            class="form-label">{{ __('Nomor Telephone (jika ada)') }}</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone"
                                            value="{{ old('phone') ?? $student->phone }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- School --}}
                                    <div class="mb-3">
                                        <label for="school"
                                            class="form-label">{{ __('Asal Sekolah') }}</label>
                                        <input type="text" class="form-control @error('school') is-invalid @enderror"
                                            id="school" name="school"
                                            value="{{ old('school') ?? $student->school }}">
                                        @error('school')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Join Date --}}
                                    <div class="mb-3">
                                        <label for="join_date"
                                            class="form-label">{{ __('Tanggal Bergabung') }}</label>
                                        <input type="date" class="form-control @error('join_date') is-invalid @enderror"
                                            id="join_date" name="join_date"
                                            value="{{ old('join_date') ?? $student->join_date }}">
                                        @error('join_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="mb-3">
                                        <label for="status"
                                            class="form-label">{{ __('Status') }}</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option value="belum lulus"
                                                {{ $student->status == 'belum lulus' ? 'selected' : '' }}>
                                                Belum Lulus
                                            </option>
                                            <option value="lulus"
                                                {{ $student->status == 'lulus' ? 'selected' : '' }}>
                                                Lulus
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Ability Level Upon Entry --}}
                                    <div class="mb-3">
                                        <label for="ability_level_upon_entry"
                                            class="form-label">{{ __('Tingkatan Saat Masuk TPA') }}</label>
                                        <input type="text"
                                            class="form-control @error('ability_level_upon_entry') is-invalid @enderror"
                                            id="ability_level_upon_entry" name="ability_level_upon_entry"
                                            value="{{ old('ability_level_upon_entry') ?? $student->ability_level_upon_entry }}">
                                        @error('ability_level_upon_entry')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Birth Certificate --}}
                                    <div class="mb-3">
                                        <label for="birth_certificate"
                                            class="form-label">{{ __('Akta Kelahiran') }}</label>
                                        <input type="file"
                                            class="form-control @error('birth_certificate') is-invalid @enderror"
                                            id="birth_certificate" name="birth_certificate">
                                        @error('birth_certificate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if($student->birth_certificate)
                                            <img class="mt-3"
                                                src="{{ route('user.images').'?q='.$student->birth_certificate }}"
                                                alt="">
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Simpan') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Birth Place --}}
                        <div class="mb-3">
                            <label for="birth_place" class="form-label">{{ __('Tempat Lahir *') }}</label>
                            <input type="text" class="form-control @error('birth_place') is-invalid @enderror"
                                id="birth_place" name="birth_place" value="{{ $student->birth_place }}">
                            @error('birth_place')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Birth Date --}}
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">{{ __('Tanggal Lahir *') }}</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                id="birth_date" name="birth_date" value="{{ $student->birth_date }}">
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('Alamat *') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ $student->address }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Father's Name --}}
                        <div class="mb-3">
                            <label for="father_name" class="form-label">{{ __('Nama Ayah *') }}</label>
                            <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                id="father_name" name="father_name" value="{{ $student->father_name }}">
                            @error('father_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mother's Name --}}
                        <div class="mb-3">
                            <label for="mother_name" class="form-label">{{ __('Nama Ibu *') }}</label>
                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                id="mother_name" name="mother_name" value="{{ $student->mother_name }}">
                            @error('mother_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('Nomor Telepon /Whatsapp') }} <small class="text-secondary">Contoh : 628561234567, tidak perlu gunakan +, dan tidak perlu gunakan pemisah (- atau spasi)</small></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" name="phone" value="{{ $student->phone }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- School --}}
                        <div class="mb-3">
                            <label for="school" class="form-label">{{ __('Asal Sekolah') }}</label>
                            <input type="text" class="form-control @error('school') is-invalid @enderror"
                                id="school" name="school" value="{{ $student->school }}">
                            @error('school')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Join Date --}}
                        <div class="mb-3">
                            <label for="join_date" class="form-label">{{ __('Tanggal Bergabung') }}</label>
                            <input type="date" class="form-control @error('join_date') is-invalid @enderror"
                                id="join_date" name="join_date" value="{{ $student->join_date }}">
                            @error('join_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status"
                                name="status">
                                <option value="belum lulus" {{ $student->status == 'belum lulus' ? 'selected' : '' }}>
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

                        {{-- Ability Level Upon Entry --}}
                        <div class="mb-3">
                            <label for="ability_level_upon_entry"
                                class="form-label">{{ __('Tingkatan Saat Masuk TPA') }}</label>
                            <input type="text"
                                class="form-control @error('ability_level_upon_entry') is-invalid @enderror"
                                id="ability_level_upon_entry" name="ability_level_upon_entry"
                                value="{{ $student->ability_level_upon_entry }}">
                            @error('ability_level_upon_entry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Birth Certificate --}}
                        <div class="mb-3">
                            <label for="birth_certificate" class="form-label">{{ __('Akta Kelahiran *') }} <small class="text-secondary">File JPG, JPEG, ukuran maksimal 1 MB. Akta tidak perlu difoto penuh, cukup di bagian nama dan tanggal lahir saja.</small></label>
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
