<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h6>
        Badkokasihan
    </h6>
    <br>

    tanggal
    <br>
    {{ $letter->created_at->isoFormat('D MMMM Y') }}
    <br>

    nomor surat
    <br>
    {{ $letter->letter_number }}
    <br>

    lampiran
    <br>
    {!! $letter->attachment !!}
    <br>

    perihal
    <br>
    {{ $letter->subject }}
    <br>

    tujuan
    <br>
    {{ $user->userProfile->institution_name }}
    <br>

    isi surat
    <br>
    {!! $letter->content !!}

</body>

</html>
