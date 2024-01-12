<!DOCTYPE html>
<html>

<head>
    <title>Invoice No # @php (printf('%03s', $data->id)) @endphp Badko TKA-TPA Rayon Kasihan  </title>

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
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

                <tr>
                    <td>
                        <table width="800" border="0" cellpadding="0" cellspacing="0" align="center"
                            style="border-radius: 10px 10px 0 0; border-bottom: 1px solid #dddddd;">

                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td><img src="{{ url('img/logo-badko.png') }}"
                                                    width="48" alt="logo" border="0" /></td>
                                            <td>
                                                <h4
                                                    style="padding:0;margin:0; margin-left:5px; font-size: 15px; color: #000000; font-family: 'Open Sans', sans-serif; line-height: 24px;">
                                                    Badan Koordinasi TKA-TPA Rayon Kasihan</h4>
                                                <p
                                                    style="padding:0;margin:0; margin-left:5px; font-size: 11px; color: #5b5b5b; font-family: 'Open Sans', sans-serif;">
                                                    Masjid Amar Ma’ruf Nahi Munkar
                                                    Menayu Lor Tirtonirmolo, <br>Kasihan,Bantul, Yogyakarta |
                                                    www.badkokasihan.web.id</p>
                                            </td>
                                        </tr>
                                    </table>


                                </td>

                                <td style="vertical-align:top; ">
                                    <h1
                                        style="font-size: 20px; color: #ff0000; letter-spacing: -1px; font-family: 'Open Sans', sans-serif; line-height:14px; text-align: right; padding:0;">
                                        Invoice</h1>
                                    <div
                                        style="font-size: 11px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px;  text-align: right;margin-bottom:10px;">
                                        <small>ORDER</small> # @php (printf('%03s', $data->id)) @endphp <br />
                                        <small>{{ $data->created_at->isoFormat('D MMMM Y') }}</small>

                                    </div>
                                </td>

                            </tr>
                        </table>

                        <table width="800" border="0" cellpadding="0" cellspacing="0" align="center"
                            style="border-radius: 10px 10px 0 0; ">

                            <tr>
                                <td>
                                    <span
                                        style="margin-top:10px;display:block;font-size: 12px; color: #5b5b5b; font-family:'Open Sans'; line-height: 18px; vertical-align: top; text-align: left;">Assalamualaikum,
                                        TPA {{ $data->user->userProfile->institution_name }}.</span>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>

            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
                <tbody>

                    <tr>
                        <td height="10"></td>
                    </tr>

                    <tr>
                        <td>
                            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center"
                                class="items" bgcolor="#ffffff">
                                <tbody>
                                    <tr>
                                        <th width="62%" align="left">
                                            Nama Event
                                        </th>
                                        <th align="center">
                                            Qty
                                        </th>
                                        <th align="right">
                                            Harga (Rp)
                                        </th>
                                        <th align="right">
                                            Subtotal (Rp)
                                        </th>
                                    </tr>



                                    @php
                                        $total = 0;
                                    @endphp

                                    @foreach ($data->orders as $order)
                                        <tr>
                                            <td>{{ $order->training->name }}</td>
                                            <td align="center">
                                                {{ $order->orderParticipants->count() }}
                                            </td>
                                            <td align="right">
                                                {{ number_format($order->training->price_normal) }}</td>
                                            <td align="right">
                                                {{ number_format($order->orderParticipants->count() * $order->training->price_normal) }}
                                            </td>
                                        </tr>


                                        @php
                                            $total += $order->orderParticipants->count() * $order->training->price_normal;
                                        @endphp
                                    @endforeach

                                    <tr class="total">
                                        <td colspan="2"></td>
                                        <td align="right">
                                            Total
                                        </td>
                                        <td align="right">
                                            Rp{{ number_format($total) }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="20"></td>
                    </tr>
                </tbody>
            </table>
         
        </div>
    </div>



</body>

</html>
