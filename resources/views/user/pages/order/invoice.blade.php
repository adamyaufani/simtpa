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
    <br>
    @foreach($data->orders as $training)
        <h4><strong>{{ $order->training->name }}</strong></h4>
        Peserta
        <ul>
            @foreach($training->orderParticipants as $participant)
                <li>
                    {{ $participant->student->name }}
                    <br>
                    {{ QrCode::size(120)->generate(route('admin.scan_training_attendance',$participant->id)) }}
                </li>
            @endforeach
        </ul>
    @endforeach
</body>

</html>
