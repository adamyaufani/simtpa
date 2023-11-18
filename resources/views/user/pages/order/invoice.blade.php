<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <span>
        <strong>
            Tanggal Transaksi :
            {{ $data->created_at->isoFormat('D MMMM Y') }}
        </strong>
    </span>
    <br>
    <span>
        <strong>
            Nama TPA : {{ $data->user->userProfile->institution_name }}
        </strong>
    </span>
    <br>
    <span>
        <strong>
            ID Transaksi : {{ $data->id }}
        </strong>
    </span>
    <br>
    <table>
        <thead>
            <tr>
                <th>Nama Event</th>
                <th>Jumlah Peserta</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data->orders as $order)
                <tr>
                    <td>{{ $order->training->name }}</td>
                    <td>{{ $order->orderParticipants->count() }}</td>
                    <td>{{ $order->training->price_normal }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td>total</td>
                <td>{{ $data->payment_amount }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
