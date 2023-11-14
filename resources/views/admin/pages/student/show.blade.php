<x-layout>
    @push('page_css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Santri</h1>
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
                    <span>{{ $student->name }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Jenis Kelamin</span>
                <div class="col-sm-8">
                    <span>{{ $student->gender }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Tempat dan Tanggal Lahir</span>
                <div class="col-sm-8">
                    <span>{{ $student->birth_place }}, {{ $student->birth_date }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Alamat</span>
                <div class="col-sm-8">
                    <span>{{ $student->address }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Nama Ayah</span>
                <div class="col-sm-8">
                    <span>{{ $student->father_name }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Nama Ibu</span>
                <div class="col-sm-8">
                    <span>{{ $student->mother_name }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Nomor Telepon</span>
                <div class="col-sm-8">
                    <span>{{ $student->phone }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Asal Sekolah</span>
                <div class="col-sm-8">
                    <span>{{ $student->school }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Asal TPA</span>
                <div class="col-sm-8">
                    <span>{{ $student->user->userProfile->institution_name }}</span>
                </div>
            </div>
            <div class="row mb-1">
                <span class="col-sm-4">Status Santri di TPA</span>
                <div class="col-sm-8">
                    <span>{{ $student->status }}</span>
                </div>
            </div>
        </div>
    </div>

</x-layout>
