<x-layout>
    <x-slot:title>
        <div class="d-sm-flex flex-row mb-3 justify-content-between align-items-center">
            <div class="flex flex-column">
                <h1 class="h3 mb-0 text-gray-800">Perjanjian Anggota</h1>
                <h1 class="h6 mb-0 text-gray-800">Perjanjian Anggota Setiap Periode Kepengurusan Baru</h1>
            </div>
            <a href="{{ route('admin.create_agreement') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Persetujuan Baru
            </a>
        </div>
    </x-slot:title>

    @foreach($agreements as $agreement)

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <p class="h6">
                    <strong>
                        <a href="{{ route('admin.edit_agreement', $agreement->id) }}"
                            class="stretched-link">
                            Periode
                        </a>
                    </strong>
                </p>
                <span> {{ $agreement->year_start }} - {{ $agreement->year_end }} </span>

                <p class="h6"><strong>Jumlah yang menandatangani</strong></p>
                <span> {{ $agreement->userAgreement->count() }} </span>

                <p class="h6"><strong>Isi Perjanjian</strong></p>
                <p>
                    {!! $agreement->content !!}
                </p>

            </div>
        </div>

    @endforeach

    {{ $agreements->links() }}

</x-layout>
