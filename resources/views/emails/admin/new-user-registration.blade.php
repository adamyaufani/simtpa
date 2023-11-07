<x-mail::message>
# Pendaftaran Pengguna Baru

Halo Admin,

Kami ingin memberi tahu Anda bahwa ada pengguna baru yang telah mendaftar di platform kami dengan data diri sebagai berikut : 

<x-mail::panel> 
Nama Organisasi : {{ $user->userProfile->institution_name }} <br>
Alamat : {{ $user->userProfile->address }} <br>
Kelurahan : {{ $user->userProfile->villageDetail->village_name }} <br>
Kode Pos : {{ $user->userProfile->postal_code }} <br>
</x-mail::panel> 

Gunakan link berikut untuk mereview dan mengkonfirmasi data pendaftaran:

<x-mail::button :url="$url">
    Detail Pengguna
</x-mail::button>

Jika anda kesulitan mengakses link diatas, silakan copy dan paste url berikut ke browser anda {{ $url }}.

Terimakasih,<br>
{{ config('app.name') }}
</x-mail::message>
