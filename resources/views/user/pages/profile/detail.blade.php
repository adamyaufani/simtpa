<x-user.layout>

    <h4 class="mb-3">Profil TPA</h4>
    <p class="mb-3">Lengkapi Profil TPA di bawah ini. Yang diberi tanda * (bintang) wajib diisi.</p>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <form action="{{ route('user.update_profile', $userProfile->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card mb-3">
            <div class="col-12">
                <div class="card-header">
                    <h6>Identitas Taman Pendidikan Al Qur'an</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="institution_name" class="col-sm-2 col-form-label">Nama TPA *</label>
                        <div class="col-sm-10">
                            <input type="text" name="institution_name"
                                class="form-control {{ $errors->has('institution_name') ? 'is-invalid' : '' }}"
                                value="{{ old('institution_name') ?? $userProfile->institution_name }}"
                                id="institution_name">
                            <span class="invalid-feedback">
                                {{ $errors->first('institution_name') }}
                            </span>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <label for="nspq_number" class="col-sm-2 col-form-label">Nomor NSPQ</label>
                        <div class="col-sm-10">
                            <input type="text" name="nspq_number"
                                class="form-control {{ $errors->has('nspq_number') ? 'is-invalid' : '' }}"
                                value="{{ old('nspq_number') ?? $userProfile->nspq_number }}" id="nspq_number">
                            <span class="invalid-feedback">
                                {{ $errors->first('nspq_number') }}
                            </span>
                        </div>
                    </div> --}}
                    {{-- <div class="row mb-3"> 
                        <label for="supervisory_institution_name" class="col-sm-2 col-form-label">
                            Nama Lembaga Pembina
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="supervisory_institution_name"
                                value="{{ old('supervisory_institution_name') ?? $userProfile->supervisory_institution_name }}"
                                class="form-control {{ $errors->has('supervisory_institution_name') ? 'is-invalid' : '' }}"
                                id="supervisory_institution_name">
                            <span class="invalid-feedback">
                                {{ $errors->first('supervisory_institution_name') }}
                            </span>
                        </div>
                    </div> --}}
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
                    <div class="row mb-3">
                        <label for="address" class="col-sm-2 col-form-label">
                            Alamat *
                        </label>
                        <div class="col-sm-10">
                            <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                cols="30" rows="3">{{ old('address') ?? $userProfile->address }}</textarea>
                            <small class="text-secondary">Nama Masjid, jalan, pedukuhan, RT & Nomor Bangunan</small>
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
                                @foreach ($villages as $village)
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
                                value="{{ old('postal_code') ?? $userProfile->postal_code }}" id="postal_code">
                            <span class="invalid-feedback">
                                {{ $errors->first('postal_code') }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone_number" class="col-sm-2 col-form-label">Nomor Telepon Direkur/TPA *</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone_number"
                                class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                value="{{ old('phone_number') ?? $userProfile->phone_number }}" id="phone_number">
                            <small class="text-secondary">Contoh : 628561234567, tidak perlu gunakan +, dan tidak perlu
                                gunakan pemisah (- atau spasi)</small>
                            <span class="invalid-feedback">
                                {{ $errors->first('phone_number') }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="social_media" class="col-sm-2 col-form-label">
                            Alamat Media Sosial
                        </label>
                        <div class="col-sm-10">
                            <div class="row mb-3">
                                <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="facebook" name="facebook"
                                        value="{{ old('facebook') ?? $userProfile->facebook }}">
                                    <small class="text-secondary">Contoh :
                                        https://www.facebook.com/tpaistiqomah</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="instagram" name="instagram"
                                        value="{{ old('instagram') ?? $userProfile->instagram }}">
                                    <small class="text-secondary">Contoh :
                                        https://www.instagram.com/tpaistiqomah</small>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="twitter"
                                        name="twitter"
                                        value="{{ old('twitter') ?? $userProfile->twitter }}">
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <label for="youtube" class="col-sm-2 col-form-label">Youtube</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="youtube" name="youtube"
                                        value="{{ old('youtube') ?? $userProfile->youtube }}">
                                    <small class="text-secondary">Contoh :
                                        https://www.youtube.com.com/tpaistiqomah</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="website" class="col-sm-2 col-form-label">Website</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="website" name="website"
                                        value="{{ old('website') ?? $userProfile->website }}">
                                    <small class="text-secondary">Contoh : https://www.tpaistiqomah.com</small>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="tiktok" class="col-sm-2 col-form-label">tiktok</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="tiktok"
                                        name="tiktok" value="{{ old('tiktok') ?? $userProfile->tiktok }}">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="gmap_address" class="col-sm-2 col-form-label">
                            Alamat google map
                        </label>
                        <div class="col-sm-10">
                            <input type="url" name="gmap_address"
                                class="form-control {{ $errors->has('gmap_address') ? 'is-invalid' : '' }}"
                                value="{{ old('gmap_address') ?? $userProfile->gmap_address }}" id="gmap_address">
                            <small class="text-secondary">Contoh : https://maps.app.goo.gl/9joQ5W2rYwKNm3T99</small>
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
                        Gambar
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label for="organization_building_photo" class="col-sm-2 col-form-label">
                            Foto TPA
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="organization_building_photo"
                                class="form-control {{ $errors->has('organization_building_photo') ? 'is-invalid' : '' }}"
                                id="organization_building_photo">
                            <span class="invalid-feedback">
                                {{ $errors->first('organization_building_photo') }}
                            </span>

                            @if($userProfile->organization_building_photo)
                                <img class="mt-3"
                                    src="{{ route('user.images').'?q='.$userProfile->organization_building_photo }}"
                                    alt="">
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <label for="organization_logo" class="col-sm-2 col-form-label">
                            Logo TPA
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="organization_logo"
                                class="form-control {{ $errors->has('organization_logo') ? 'is-invalid' : '' }}"
                                id="organization_logo">
                            <span class="invalid-feedback">
                                {{ $errors->first('organization_logo') }}
                            </span>

                            @if($userProfile->organization_logo)
                                <img class="mt-3"
                                    src="{{ route('user.images').'?q='.$userProfile->organization_logo }}"
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

</x-user.layout>
