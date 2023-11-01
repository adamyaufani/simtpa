<x-user.layout>
    <section class="py-5" id="features">
        <div class="container px-5 my-5 justify-content-center">
            <h5 class="font-weight-bold mb-5">
                Nota Kesepahaman
            </h5>
            <div style="width:100%; height:100vh;overflow:auto;">
                {!! $current_agreement->content !!}
            </div>
            <a href="{{ route('user.sign_agreement') }}" class="btn btn-primary">
                Saya Setuju
            </a>
        </div>
    </section>
</x-user.layout>
