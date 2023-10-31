<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Event</h1>
            <a href="{{ route('admin.create_new_training') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Event Baru
            </a>
        </div>
    </x-slot:title>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @foreach($trainings as $training)
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-2 mr-3">
                        <img src="{{ route('training.image').'?q='.$training->image }}"
                            width="200" alt="">
                    </div>
                    <div class="col-8">
                        <div class="mb-2">
                            <h5 class="font-weight-bold">
                                <a href="{{ route('admin.edit_training',$training->id) }}">
                                    {{ $training->name }}
                                </a>
                            </h5>
                        </div>
                        <p>
                            {{ $training->description }}
                        </p>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <form action="{{ route('admin.delete_training',$training->id) }}"
                            method="POST" onsubmit="return confirmSubmit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('page_js')
        <script>
            function confirmSubmit() {
                var confirmSubmission = confirm(
                    "Anda yakin ingin menghapus event ini? Event yang sudah dihapus tidak dapat dikembalikan dengan cara apapun."
                );
                return confirmSubmission;
            }

        </script>
    @endpush

</x-layout>
