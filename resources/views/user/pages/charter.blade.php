<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <span>Nama : </span>{{ $user->userProfile->institution_name }} <br>
    <span>Alamat : </span>{{ $user->userProfile->address }} <br>
    {{ $qrCode }}
</body>

</html>
