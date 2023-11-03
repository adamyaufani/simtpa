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
                <h4 class="mb-3">Tambah Staf</h4>
                <p class="mb-3">Yang diberi tanda * (bintang) wajib diisi.</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.store_staff') }}">
                        @csrf
                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nama Lengkap *') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label for="gender" class="form-label">{{ __('Jenis Kelamin *') }}</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                name="gender">
                                <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Employment Status --}}
                        {{-- <div class="mb-3">
                                        <label for="employment_status"
                                            class="form-label">{{ __('Status Kepegawaian') }}</label>
                                        <select class="form-select @error('gender') is-invalid @enderror"
                                            id="employment_status" name="employment_status">
                                            @foreach ($employment_statuses as $employment_status)
                                                <option value="{{ $employment_status->value }}"
                                                    {{ old('employment_status') == $employment_status->value ? 'selected' : '' }}>
                                                    {{ $employment_status->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employment_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                        {{-- Civil Registration Number --}}
                        {{-- <div class="mb-3">
                                        <label for="civil_registration_number"
                                            class="form-label">{{ __('NIK') }}</label>
                                        <input type="text"
                                            class="form-control @error('civil_registration_number') is-invalid @enderror"
                                            id="civil_registration_number" name="civil_registration_number"
                                            value="{{ old('civil_registration_number') }}">
                                        @error('civil_registration_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                        {{-- Last Formal Education --}}
                        <div class="mb-3">
                            <label for="last_formal_education"
                                class="form-label">{{ __('Pendidikan Formal Terakhir *') }}</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="last_formal_education"
                                name="last_formal_education">
                                <option>Pilih Pendidikan Formal Terakhir
                                </option>
                                @foreach ($last_formal_educations as $last_formal_education)
                                    <option value="{{ $last_formal_education->value }}"
                                        {{ old('last_formal_education') == $last_formal_education->value ? 'selected' : '' }}>
                                        {{ $last_formal_education->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('last_formal_education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Length of Islamic Education --}}
                        <div class="mb-3">
                            <label for="length_of_islamic_education"
                                class="form-label">{{ __('Lama Pendidikan Pesantren (tahun)') }}</label>
                            <input type="text"
                                class="form-control @error('length_of_islamic_education') is-invalid @enderror"
                                id="length_of_islamic_education" name="length_of_islamic_education"
                                value="{{ old('length_of_islamic_education') }}">
                            @error('length_of_islamic_education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Core Competency --}}
                        <div class="mb-3">
                            <label for="core_competency"
                                class="form-label">{{ __('Kompetensi Utama Bidang Ilmu Yang Dikuasai *') }}</label>
                            <input type="text" class="form-control @error('core_competency') is-invalid @enderror"
                                id="core_competency" name="core_competency" value="{{ old('core_competency') }}">
                            @error('core_competency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('No. Telepon') }} <small class="text-secondary">Contoh : 628561234567, tidak perlu gunakan +, dan tidak perlu gunakan pemisah (- atau spasi)</small></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
