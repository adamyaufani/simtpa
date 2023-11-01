<x-user.layout>
    <section class="py-5" id="features">
        <div class="container px-5 my-5 justify-content-center">
            <h5 class="font-weight-bold mb-5">
                Syarat dan Persetujuan
            </h5>
            <p>
                {!! $current_agreement->content !!}
            </p>
            <a href="{{ route('user.sign_agreement') }}" class="btn btn-primary">
                Saya Setuju
            </a>
        </div>
    </section>
</x-user.layout>
