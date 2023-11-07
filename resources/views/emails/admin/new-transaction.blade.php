<x-mail::message>
# Transaksi Baru

Halo Admin,

Kami ingin memberi tahu Anda bahwa ada transaksi baru yang masuk dengan informasi sebagai berikut : 

<x-mail::panel>
Nama Organisasi : {{ $transaction->user->userProfile->institution_name }} <br>
ID Transaksi : {{ $transaction->id }} <br>
</x-mail::panel>

Untuk melihat lebih detail lagi silakan gunakan link dibawah :

<x-mail::button :url="$url">
    Detail Transaksi
</x-mail::button>

Jika anda kesulitan mengakses link diatas, silakan copy dan paste url berikut ke browser anda {{ $url }}.

Terimakasih,<br>
{{ config('app.name') }}
</x-mail::message>
