<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pengguna</h1>
        </div>
    </x-slot:title>

    <div class="row mb-3">

        <div class="col-lg-8 mx-auto">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ route('admin.update_user', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <div class="form-group row mb-0">
                                <label for="email" class="col-sm-4 col-form-label">Alamat Email</label>                              
                                <div class="col-sm-8">
                                    <div class="alert bg-light p-2"><strong>{{ $user->email }}</strong></div>                                    
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="institution-name" class="col-sm-4 col-form-label">Nama Organisasi</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('institution_name') ? 'is-invalid' : '' }}"
                                        id="institution-name" name="institution_name"
                                        value="{{ $user->userProfile->institution_name }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('institution_name') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nspq_number" class="col-sm-4 col-form-label">Nomor NSPQ</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('nspq_number') ? 'is-invalid' : '' }}"
                                        id="nspq_number" name="nspq_number"
                                        value="{{ $user->userProfile->nspq_number }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('nspq_number') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supervisory_institution_name" class="col-sm-4 col-form-label">
                                    Nama Lembaga Pembina
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control
                                        {{ $errors->has('supervisory_institution_name') ? 'is-invalid' : '' }}"
                                        id="supervisory_institution_name" name="supervisory_institution_name"
                                        value="{{ $user->userProfile->supervisory_institution_name }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('supervisory_institution_name') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="years_of_establishment" class="col-sm-4 col-form-label">
                                    Tahun Berdiri
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('years_of_establishment') ? 'is-invalid' : '' }}"
                                        id="years_of_establishment" name="years_of_establishment"
                                        value="{{ $user->userProfile->years_of_establishment }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('years_of_establishment') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea name="address" id="address" cols="5" rows="5"
                                        class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ $user->userProfile->address }}</textarea>
                                    <small class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="district" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-8">
                                    <select name="village" id="village"
                                        class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}">
                                        <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                                        @foreach ($villages as $village)
                                            <option value="{{ $village->id }}"
                                                {{ $village->id == $user->userProfile->village ? 'selected' : '' }}>
                                                {{ $village->village_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback">
                                        {{ $errors->first('district') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="postal_code" class="col-sm-4 col-form-label">Kode Pos</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}"
                                        id="postal_code" name="postal_code"
                                        value="{{ $user->userProfile->postal_code }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('postal_code') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                        id="phone_number" name="phone_number"
                                        value="{{ $user->userProfile->phone_number }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('phone_number') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-4 col-form-label">Facebook</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                        id="facebook" name="facebook" value="{{ $user->userProfile->facebook }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('facebook') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instagram" class="col-sm-4 col-form-label">Instagram</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                        id="instagram" name="instagram" value="{{ $user->userProfile->instagram }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('instagram') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="twitter" class="col-sm-4 col-form-label">Twitter</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}"
                                        id="twitter" name="twitter" value="{{ $user->userProfile->twitter }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('twitter') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="website" class="col-sm-4 col-form-label">Website</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                                        id="website" name="website" value="{{ $user->userProfile->website }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('website') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="youtube" class="col-sm-4 col-form-label">Youtube</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}"
                                        id="youtube" name="youtube" value="{{ $user->userProfile->youtube }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('youtube') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tiktok" class="col-sm-4 col-form-label">Tiktok</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('tiktok') ? 'is-invalid' : '' }}"
                                        id="tiktok" name="tiktok" value="{{ $user->userProfile->tiktok }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('tiktok') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gmap_address" class="col-sm-4 col-form-label">Alamat Google Map</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('gmap_address') ? 'is-invalid' : '' }}"
                                        id="gmap_address" name="gmap_address"
                                        value="{{ $user->userProfile->gmap_address }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('gmap_address') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sk_number" class="col-sm-4 col-form-label">Nomor SK</label>
                                <div class="col-sm-8">
                                    <input type="text"
                                        class="form-control {{ $errors->has('sk_number') ? 'is-invalid' : '' }}"
                                        id="sk_number" name="sk_number" value="{{ $user->userProfile->sk_number }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('sk_number') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sk_number_starting_date" class="col-sm-4 col-form-label">Tanggal Nomor SK
                                    Dimulai</label>
                                <div class="col-sm-8">
                                    <input type="date"
                                        class="form-control {{ $errors->has('sk_number_starting_date') ? 'is-invalid' : '' }}"
                                        id="sk_number_starting_date" name="sk_number_starting_date"
                                        value="{{ $user->userProfile->sk_number_starting_date }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('sk_number_starting_date') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sk_number_ending_date" class="col-sm-4 col-form-label">
                                    Tanggal Nomor SK Berakhir
                                </label>
                                <div class="col-sm-8">
                                    <input type="date"
                                        class="form-control {{ $errors->has('sk_number_ending_date') ? 'is-invalid' : '' }}"
                                        id="sk_number_ending_date" name="sk_number_ending_date"
                                        value="{{ $user->userProfile->sk_number_ending_date }}">
                                    <small class="invalid-feedback">
                                        {{ $errors->first('sk_number_ending_date') }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sk_file" class="col-sm-4 col-form-label">
                                    File Scan Sk
                                </label>
                                <div class="col-sm-8">
                                    <input type="file" name="sk_file"
                                        class="form-control {{ $errors->has('sk_file') ? 'is-invalid' : '' }}"
                                        id="sk_file">
                                    <span class="invalid-feedback">
                                        {{ $errors->first('sk_file') }}
                                    </span>

                                    @if ($user->userProfile->sk_file)
                                        {{-- <img class="mt-3"
                                            src="{{ route('admin.user_file_sk').'?q='.$user->userProfile->sk_file }}"
                                        alt=""> --}}

                                        <div class="col-12 my-3"
                                            style="background-image: url({{ route('admin.user_file_sk') . '?q=' . $user->userProfile->sk_file }});
                                            background-size: contain;background-repeat: no-repeat; background-position: center;height: 300px">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group d-md-flex d-block justify-content-between">
                                <button class="btn-success btn mb-2 mb-md-0" type="submit">
                                    Simpan Perubahan
                                </button>
                                <x-verification-options :userId="$user->id" />
                                @if ($user->status['badge'] === 'success')
                                    <a href="https://wa.me/{{ $user->userProfile->phone_number }}?text=_Assalamualaikum_ *TPA {{ $user->userProfile->institution_name }}* 
                                        %0ASaat ini akun Anda telah kami verifikasi.%0ASilakan login kembali ke Pangkalan Data TPA Kapanewon Kasihan https://tpa.badkokasihan.web.id/login.%0A%0AHormat kami,%0AAdmin Badko TKA-TPA Kasihan"
                                        target="_blank" class="btn btn-success mt-2 mt-md-0"><i class="fab fa-whatsapp"></i>
                                        Chat
                                        Pengguna</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


</x-layout>
