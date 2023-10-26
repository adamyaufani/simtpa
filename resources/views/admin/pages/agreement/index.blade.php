<x-layout>
    <x-slot:title>
        <div class="d-sm-flex flex-column mb-3">
            <h1 class="h3 mb-0 text-gray-800">Perjanjian Anggota</h1>
            <p class="h6 mb-0 text-gray-800">Perjanjian Anggota Setiap Periode Kepengurusan Baru</h1>
        </div>
    </x-slot:title>

    @foreach($agreements as $agreement)

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <p class="h6">Periode</p>
                <h4> {{ $agreement->year_start }} - {{ $agreement->year_end }} </h4>

                <p class="h6">Jumlah yang menandatangani</p>
                <h4> {{ $agreement->useragreement->count() }} </h4>

                <p class="h6">Isi Perjanjian</p>
                <h4> </h4>

            </div>
        </div>

    @endforeach

</x-layout>
