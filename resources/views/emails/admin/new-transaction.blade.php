<x-mail::message>
# Transaksi Baru

Halo Admin,

Kami ingin memberi tahu Anda bahwa transaksi baru telah masuk. Gunakan link berikut untuk melihat detail transaksi:

<x-mail::button :url="$url">
    Detail Transaksi
</x-mail::button>

Jika anda kesulitan mengakses link diatas, silakan copy dan paste url berikut ke browser anda {{ $url }}.

Terimakasih,<br>
{{ config('app.name') }}
</x-mail::message>
