<x-user.layout>

    @push('css')

    <style>
        .piagam {
            width:auto;
            height:700px;
            background-image : url('{{ asset('img/piagam.jpg') }}' );
            background-repeat: no-repeat;
            background-position: center top;
            text-align:center;
            background-size:contain;        
        }
        .isi {
            background-color: rgba(255,255,255, 0.2);
        }
        .nomor {
            margin-top:200px;
        }
        .nama {
            margin-top:60px;
            font-size:24px;
        }
        .alamat {

        }
    </style>
    @endpush

    <div class="row gx-5">
        <div class="col-lg-12 mb-5 mb-lg-0 p-5 bg-dark">
            <div class="piagam">
                <div class="isi d-flex flex-column">
                    <p class='nomor'>Nomor : {{  $user->username }}/23.26/Badko-Ksh/2023</p>
                    <h2 class='nama'>TPA {{ $user->userProfile->institution_name }} </h2>
                    <h3 class='alamat h6'>({{ $user->userProfile->address }})</h3>
                </div>
            </div>

        </div>
    </div>


</x-user.layout>
