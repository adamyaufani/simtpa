<x-mail::message>
# Registrasi Ditolak

Halo {{ $user->userProfile->institution_name }},

Kami ingin memberitahukan bahwa permintaan registrasi Anda untuk bergabung dalam sistem kami telah kami tinjau dengan
cermat. Setelah melakukan evaluasi menyeluruh, kami sangat menyesal memberitahukan bahwa registrasi Anda telah kami
tolak.

Alasan penolakan ini mungkin bervariasi, termasuk namun tidak terbatas pada informasi yang tidak valid, atau tidak
memenuhi persyaratan yang telah ditetapkan oleh sistem kami.

Kami menghargai minat Anda untuk bergabung dengan kami dan kami berharap Anda memahami keputusan ini.

Terima kasih atas pengertian dan kerjasamanya.

Hormat kami,<br>
{{ config('app.name') }}
</x-mail::message>
