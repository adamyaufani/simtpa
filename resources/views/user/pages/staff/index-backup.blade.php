<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="row mb-5">

                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-3">Pengurus TPA</h4>
                            <div>
                                <a href="{{ route('user.create_staff') }}"
                                    class="btn btn-primary btn-sm"> <i class="bi bi-plus"></i>
                                    Tambah Staf Pengajar
                                </a>
                            </div>
                        </div>

                        <div class="col-12">
                            @foreach($staffs as $staff)
                                <div class="card border-success mb-3">
                                    <div class="card-body text-success">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <span class="card-text">
                                                        <strong>Nama Lengkap :</strong>
                                                        <br>
                                                        {{ $staff->name }}
                                                    </span>
                                                    <br>
                                                    <span class="card-text">
                                                        <strong>Jenis Kelamin :</strong>
                                                        <br>
                                                        {{ $staff->gender }}
                                                    </span>
                                                </div>
                                                <div class="col-4">
                                                    <span class="card-text">
                                                        <strong>NIK :</strong>
                                                        <br>
                                                        {{ $staff->civil_registration_number }}
                                                    </span>
                                                    <br>
                                                    <span class="card-text">
                                                        <strong> Pendidikan Terakhir :</strong>
                                                        <br>
                                                        {{ $staff->last_formal_education }}
                                                    </span>
                                                </div>
                                                <div class="col-4">
                                                    <span class="card-text">
                                                        <strong> Kompetensi Utama Bidang Ilmu Yang Dikuasai :</strong>
                                                        <br>
                                                        {{ $staff->core_competency }}
                                                    </span>
                                                    <br>
                                                    <span class="card-text">
                                                        <strong> No. Telepon :</strong>
                                                        <br>
                                                        {{ $staff->phone }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex mt-3">
                                                <a href="{{ route('user.staff_edit',$staff->id) }}"
                                                    class="btn btn-outline-warning btn-sm mr-3">
                                                    edit
                                                </a>
                                                <form
                                                    action="{{ route('user.delete_staff',$staff->id) }}"
                                                    method="POST" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm">
                                                        hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>

                </div>

            </div>
        </section>
    </div>
    @push('js')
        <script>
            function confirmDelete() {
                // Display the alert message
                return confirm("Hapus data ini? Data yang sudah dihapus tidak bisa dikembalikan dengan cara apapun.");
            }

        </script>
    @endpush
</x-user.layout>
