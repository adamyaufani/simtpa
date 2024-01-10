<x-user.layout>


    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="col-12 my-3">
                <span>{{ $news['date'] }}</span>
                <h1 class="mb-3 text-dark">{{ $news['title'] }}</h1>
                <img src="{{ $news['featured_image'] }}" class="img-fluid mb-3" alt="thumbnail">
                <p>
                    {!! $news['content'] !!}
                </p>
            </div>
        </div>

    </section>
</x-user.layout>
