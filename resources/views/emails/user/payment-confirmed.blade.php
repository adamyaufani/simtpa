<x-mail::message>
# Pembayaran Berhasil

Halo {{ $user->userProfile->institution_name }},

Kami ingin memberitahukan kepada Anda bahwa pembayaran anda dengan id transaksi {{ $transactionId }} telah dikonfirmasi oleh Admin.
Untuk melihat detail transaksi, anda bisa kunjungi link berikut :

<x-mail::button :url="$url">
    Transaksi
</x-mail::button>

Jika anda kesulitan mengakses link diatas, silakan copy dan paste url berikut ke browser anda {{ $url }}.

Terinakasih,<br>
{{ config('app.name') }}
</x-mail::message>
