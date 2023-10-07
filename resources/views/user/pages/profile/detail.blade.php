<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <h4 class="mb-3">Profil TPA</h4>
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{ route('user.update_profile',$userProfile->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card mb-3">
                        <div class="col-12">
                            <div class="card-header">
                                <h6>Identitas Lembaga Pendidikan Al Qur'an</h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="institution_name" class="col-sm-2 col-form-label">Nama Lembaga</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="institution_name"
                                            class="form-control {{ $errors->has('institution_name') ? 'is-invalid' : '' }}"
                                            value="{{ $userProfile->institution_name }}" id="institution_name">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('institution_name') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nspq_number" class="col-sm-2 col-form-label">Nomor NSPQ</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nspq_number"
                                            class="form-control {{ $errors->has('nspq_number') ? 'is-invalid' : '' }}"
                                            value="{{ $userProfile->nspq_number }}" id="nspq_number">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('nspq_number') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="supervisory_institution_name" class="col-sm-2 col-form-label">
                                        Nama Lembaga Pembina
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="supervisory_institution_name"
                                            value="{{ $userProfile->supervisory_institution_name }}"
                                            class="form-control {{ $errors->has('supervisory_institution_name') ? 'is-invalid' : '' }}"
                                            id="supervisory_institution_name">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('supervisory_institution_name') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="years_of_establishment" class="col-sm-2 col-form-label">
                                        Tahun Berdiri
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="years_of_establishment"
                                            value="{{ $userProfile->years_of_establishment }}"
                                            class="form-control {{ $errors->has('years_of_establishment') ? 'is-invalid' : '' }}"
                                            id="years_of_establishment">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('years_of_establishment') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="col-12">
                            <div class="card-header">
                                <h6>Lokasi Lembaga Pendidikan Al Qur'an</h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">
                                        Alamat (Jalan/Kampung & Nomor)
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="address" id="address"
                                            class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                            cols="30" rows="3">{{ $userProfile->address }}</textarea>
                                        <span class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="district" class="col-sm-2 col-form-label">Desa/Kelurahan</label>
                                    <div class="col-sm-10">
                                        <select name="village" id="village"
                                            class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}">
                                            <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                                            @foreach($villages as $village)
                                                <option value="{{ $village->id }}"
                                                    {{ $village->id == $userProfile->village ? 'selected' : '' }}>
                                                    {{ $village->village_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback">
                                            {{ $errors->first('district') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="postal_code" class="col-sm-2 col-form-label">Kode Pos</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="postal_code"
                                            class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}"
                                            value="{{ $userProfile->postal_code }}" id="postal_code">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('postal_code') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="phone_number" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone_number"
                                            class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                            value="{{ $userProfile->phone_number }}" id="phone_number">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('phone_number') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="social_media" class="col-sm-2 col-form-label">
                                        Alamat Media Sosial (bila ada)
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="row mb-3">
                                            <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="facebook" name="facebook"
                                                    value="{{ $userProfile->facebook }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="instagram" name="instagram"
                                                    value="{{ $userProfile->instagram }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="twitter" name="twitter"
                                                    value="{{ $userProfile->twitter }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="website" class="col-sm-2 col-form-label">Website</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="website" name="website"
                                                    value="{{ $userProfile->website }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="youtube" class="col-sm-2 col-form-label">Youtube</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="youtube" name="youtube"
                                                    value="{{ $userProfile->youtube }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="tiktok" class="col-sm-2 col-form-label">tiktok</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tiktok" name="tiktok"
                                                    value="{{ $userProfile->tiktok }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gmap_address" class="col-sm-2 col-form-label">
                                        Alamat google map (bila ada)
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="gmap_address"
                                            class="form-control {{ $errors->has('gmap_address') ? 'is-invalid' : '' }}"
                                            value="{{ $userProfile->gmap_address }}" id="gmap_address">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('gmap_address') }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="col-12">
                            <div class="card-header">
                                <h6>
                                    Dokumen Izin Operasional
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="sk_number" class="col-sm-2 col-form-label">
                                        Nomor SK
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sk_number"
                                            class="form-control {{ $errors->has('sk_number') ? 'is-invalid' : '' }}"
                                            value="{{ $userProfile->sk_number }}" id="sk_number">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('sk_number') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sk_number_starting_date" class="col-sm-2 col-form-label">
                                        Tanggal Mulai Berlaku SK
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="date" name="sk_number_starting_date"
                                            value="{{ $userProfile->sk_number_starting_date }}"
                                            class="form-control {{ $errors->has('sk_number_starting_date') ? 'is-invalid' : '' }}"
                                            id="sk_number_starting_date">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('sk_number_starting_date') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sk_number_ending_date" class="col-sm-2 col-form-label">
                                        Tanggal Berakhir SK
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="date" name="sk_number_ending_date"
                                            value="{{ $userProfile->sk_number_ending_date }}"
                                            class="form-control {{ $errors->has('sk_number_ending_date') ? 'is-invalid' : '' }}"
                                            id="sk_number_ending_date">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('sk_number_ending_date') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="sk_file" class="col-sm-2 col-form-label">
                                        File Scan Sk
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="file" name="sk_file"
                                            class="form-control {{ $errors->has('sk_file') ? 'is-invalid' : '' }}"
                                            id="sk_file">
                                        <span class="invalid-feedback">
                                            {{ $errors->first('sk_file') }}
                                        </span>

                                        @if($userProfile->sk_file)
                                            <img class="mt-3"
                                                src="{{ route('user.images').'?q='.$userProfile->sk_file }}"
                                                alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-user.layout>
