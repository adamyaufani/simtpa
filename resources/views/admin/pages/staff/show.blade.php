<x-layout>
    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Staff TPA</h1>
        </div>
    </x-slot:title>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row mb-1">
                <span class="col-sm-4">Nama</span>
                <div class="col-sm-8">
                    <span>{{ $staff->name }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Asal TPA</span>
                <div class="col-sm-8">
                    <span>{{ $staff->user->userProfile->institution_name }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Jenis Kelamin</span>
                <div class="col-sm-8">
                    <span>{{ $staff->gender }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">NIK</span>
                <div class="col-sm-8">
                    <span>{{ $staff->civil_registration_number }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Pendidikan Formal Terakhir</span>
                <div class="col-sm-8">
                    <span>{{ $staff->last_formal_education }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Lama Pendidikan Pesantren</span>
                <div class="col-sm-8">
                    <span>{{ $staff->length_of_islamic_education }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Kompetensi Utama Bidang Ilmu Yang Dikuasai</span>
                <div class="col-sm-8">
                    <span>{{ $staff->core_competency }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Status Kepegawaian</span>
                <div class="col-sm-8">
                    <span>{{ $staff->employment_status }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Nomor Telepon</span>
                <div class="col-sm-8">
                    <span>{{ $staff->phone }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Email</span>
                <div class="col-sm-8">
                    <span>{{ $staff->email }}</span>
                </div>
            </div>
        </div>
    </div>

</x-layout>
