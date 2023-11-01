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
                            <h4 class="mb-3">Santri TPA</h4>
                            <div>
                                <a href="{{ route('user.create_student') }}"
                                    class="btn btn-primary btn-sm">
                                    tambah santri baru
                                </a>
                            </div>
                        </div>

                        <div class="col-12">
                            @foreach($students as $student)
                                <div class="card border-success mb-3">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <span class="card-text">
                                                        <strong>Nama Lengkap :</strong>
                                                        <br>
                                                        {{ $student->name }}
                                                    </span>
                                                    <br>
                                                    <span class="card-text">
                                                        <strong>Jenis Kelamin :</strong>
                                                        <br>
                                                        {{ $student->gender }}
                                                    </span>
                                                </div>
                                                <div class="col-4">
                                                    <span class="card-text">
                                                        <strong>Nama Ayah :</strong>
                                                        <br>
                                                        {{ $student->father_name }}
                                                    </span>
                                                    <br>
                                                    <span class="card-text">
                                                        <strong> Nama Ibu :</strong>
                                                        <br>
                                                        {{ $student->mother_name }}
                                                    </span>
                                                </div>
                                                <div class="col-4">
                                                    <span class="card-text">
                                                        <strong>Tanggal Lahir :</strong>
                                                        <br>
                                                        {{ $student->birth_date }}
                                                    </span>
                                                    <br>
                                                    <span class="card-text">
                                                        <strong> Asal Sekolah :</strong>
                                                        <br>
                                                        {{ $student->school }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex mt-3">
                                            <a href="{{ route('user.edit_student',$student->id) }}"
                                                class="btn btn-outline-warning btn-sm mr-3">
                                                edit
                                            </a>
                                            {{-- <form
                                                action="{{ route('user.delete_student',$student->id) }}"
                                                method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm">
                                                    hapus
                                                </button>
                                            </form> --}}
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
