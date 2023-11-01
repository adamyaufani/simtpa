<x-mail::message>
# Registrasi Pengguna Baru Anda Telah Berhasil

Halo {{ $user->userProfile->institution_name }},

Selamat datang di layanan kami. Kami mengumumkan bahwa pendaftaran Anda sebagai pengguna baru telah berhasil
diselesaikan. Sekarang Anda memiliki akses penuh ke semua fitur dan layanan yang tersedia.

<x-mail::button :url="$url">
    Klik untuk login
</x-mail::button>

Jika anda kesulitan mengakses link diatas, silakan copy dan paste url berikut ke browser anda {{ $url }}.

Terimakasih,<br>
{{ config('app.name') }}
</x-mail::message>
