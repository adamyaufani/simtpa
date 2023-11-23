<x-user.layout>

    @push('css')
        {{-- <link rel="stylesheet" href="{{ asset('css/datatable-bootstrap-5.min.css') }}">
        --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @endpush
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            Nama TPA
                            <p>{{ $org->userProfile->institution_name }}</p>
                            Nomor NSPQ
                            <p>{{ $org->userProfile->nspq_number }}</p>
                            Nama Organisasi Pembimbing
                            <p>{{ $org->userProfile->supervisory_institution_name }}</p>
                            Tahun Berdiri
                            <p>{{ $org->userProfile->years_of_establishment }}</p>
                            Alamat
                            <p>{{ $org->userProfile->address }}</p>
                            Kelurahan
                            <p>{{ $org->userProfile->villageDetail->village_name }}</p>
                            Kode Pos
                            <p>{{ $org->userProfile->postal_code }}</p>
                            Nomor Telepon TPA
                            <p>{{ $org->userProfile->phone_number }}</p>
                            Facebook
                            <p>{{ $org->userProfile->facebook }}</p>
                            Instagram
                            <p>{{ $org->userProfile->instagram }}</p>
                            Twitter
                            <p>{{ $org->userProfile->twitter }}</p>
                            Website
                            <p>{{ $org->userProfile->website }}</p>
                            Youtube
                            <p>{{ $org->userProfile->youtube }}</p>
                            TIktok
                            <p>{{ $org->userProfile->tiktok }}</p>
                            Alamat google map
                            <p>{{ $org->userProfile->gmap_address }}</p>
                            Nomor SK
                            <p>{{ $org->userProfile->sk_number }}</p>
                            Tanggal Mulai Nomor SK
                            <p>{{ $org->userProfile->sk_number_starting_date }}</p>
                            Tanggal Berakhir Nomor SK
                            <p>{{ $org->userProfile->sk_number_ending_date }}</p>
                            Jumlah Pengurus
                            <p>{{ $org->staffs->count() }}</p>
                            Jumlah Santri Putra
                            <p>
                                {{ $org->students->where('gender','laki-laki')->count() }}
                            </p>
                            Jumlah Santri Putri
                            <p>
                                {{ $org->students->where('gender','perempuan')->count() }}
                            </p>
                            Link Foto Gedung
                            <p>
                                {{ route('training.image').'?q='.$org->userProfile->organization_building_photo }}
                            </p>
                            Link Logo
                            <p>
                                {{ route('training.image').'?q='.$org->userProfile->organization_logo }}
                            </p>
                            Direktur
                            <p>
                                <strong>Nama : </strong>
                                {{ $administrator['director']->name ?? '' }}
                                <br>
                                <strong> Foto : </strong>
                                {{ isset($administrator['director']->photo) ? route('training.image').'?q='.Crypt::encryptString($administrator['director']->photo) : '' }}
                            </p>
                            Wakil Direktur
                            <p>
                                <strong>Nama : </strong>
                                {{ $administrator['vice_director']->name ?? '' }}
                                <br>
                                <strong> Foto : </strong>
                                {{ isset($administrator['vice_director']->photo) ? route('training.image').'?q='.Crypt::encryptString($administrator['vice_director']->photo) : '' }}
                            </p>
                            Sekretaris
                            <p>
                                <strong>Nama : </strong>
                                {{ $administrator['secretary']->name ?? '' }}
                                <br>
                                <strong> Foto : </strong>
                                {{ isset($administrator['secretary']->photo) ? route('training.image').'?q='.Crypt::encryptString($administrator['secretary']->photo) : '' }}
                            </p>
                            Bendahara
                            <p>
                                <strong>Nama : </strong>
                                {{ $administrator['treasurer']->name ?? '' }}
                                <br>
                                <strong> Foto : </strong>
                                {{ isset($administrator['treasurer']->photo) ? route('training.image').'?q='.Crypt::encryptString($administrator['treasurer']->photo) : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-user.layout>
