<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>Document</title>

  

    <style>
        .piagam {
            width:auto;
            height:700px;
            /* background-image : url('{{ route('training.image').'?q='.$certificate->order->training->background_certificate }}' ); */
            background-image : url('{{ asset('img/piagam.jpg') }}' );
            background-position: center top;
            text-align:center;
            background-size:contain;        
        }
        .isi {
            background-color: rgba(255,255,255, 0.2);
            position:relative;
            height:700px;
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
        .qr-code {
            position:absolute;
            bottom :70px;
            left:130px;
        }
    </style>
 

    <div class="row gx-5">
        <div class="col-lg-12 mb-5 mb-lg-0 p-5 bg-dark">
            <div class="piagam">
                <div class="isi d-flex flex-column">
                  
                    <h2 class='nama'>{{ $certificate->order->training->participant_type == 'santri' ? $certificate->student->name : $certificate->staff->name }} </h2>
                    <h3 class='alamat h6'>atas partisipasinya sebagai peserta</h3>
                    <h3 class='h5'>{{ $certificate->order->training->name }}</h3>

                   
                        

                </div>
            </div>

        </div>
    </div>

</body>

</html>

