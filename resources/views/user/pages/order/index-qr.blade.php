<!DOCTYPE html>
<html>

<head>
    <title>QR Badko TKA-TPA Rayon Kasihan </title>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

        html,
        body {
            line-height: 1.5;
            font-size: 10pt !important;
            font-family: 'Open Sans', sans-serif;
        }

        div.kertas {
            width: 100%;
            height: 100%;
        }

        .items {
            font-family: 'Open Sans', sans-serif;
            line-height: 24px;
        }

        .items th {
            font-weight: 700;
            height: 25px;
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #717171;
        }

        .items td {
            height: 30px;
            vertical-align: middle;
            border-bottom: 1px solid #dddddd;
            color: #5b5b5b;
        }

        tr .total {
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div>
        <div class="kertas">



            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
                <tbody>

                    <tr>
                        <td height="10"></td>
                    </tr>

                    <tr>
                        <td>
                            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center"
                                bgcolor="#ffffff">
                                <tbody>
                                    <tr>
                                        <td>

                                            <table width="600" border="0" cellpadding="0" cellspacing="0"
                                                align="left" bgcolor="#ffffff">
                                                <tbody>
                                                    <tr>
                                                        <td width="80%">
                                                            <h3>Label Nama</h3>
                                                            <p>Silakan cetak label nama berikut ini, lalu potong dan
                                                                tempelkan pada ID card yang diberikan oleh panitia FASI
                                                                sebagaimana gambar di samping.</p>
                                                            <p> Tekan Ctrl+P, lalu ubah ukuran kertas ke A4.</p>
                                                        </td>
                                                        <td> <img src="{{ url('img/cocard.jpg') }}" width="200"
                                                                alt="logo" border="0" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>



                                            @foreach ($data as $transaction)
                                                @foreach ($transaction->orders as $order)
                                          
                                                    @foreach ($order->orderparticipants as $participant)                                                     

                                                    <div style="float:left; height:2,5cm; width:6cm; padding:5px;border:1px dashed #999999; margin: 2px;">                                                   

                                                        <table width="100%">
                                                            <tr>
                                                                <td>
                                                                    {{ QrCode::size(70)->generate(route('admin.scan_training_attendance', $participant->id)) }}
                                                                </td>
                                                                <td style="vertical-align: middle;padding-left:6px;">
                                                                    <h4
                                                                        style="line-height:9pt;font-size:7pt;margin:0;padding:0;">
                                                                        {{ $order->training->name }}</h4>
                                                                    <p
                                                                        style="line-height:10pt;font-size:10pt;margin:0;padding:0;font-weight:bold; text-transform:uppercase">
                                                                        {{ $participant->student->name }}
                                                                    </p>
                                                                    <p
                                                                        style="line-height:13pt;font-size:8pt;margin:0;padding:0; text-transform:uppercase">
                                                                        TPA
                                                                        {{ $transaction->user->userProfile->institution_name }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                       </div>
                                                    @endforeach
                                                @endforeach
                                            @endforeach





                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>



</body>

</html>
