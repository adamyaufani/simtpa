<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <h4>Pilih Metode Pembayaran</h4>
                <div class="card">
                    <div class="card-body row">
                        <form action="{{ route('user.checkout_order',$order->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                @foreach($paymentMethods as $method)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="payment_method" value="{{ $method->value }}">
                                        <label class="form-check-label" for="payment_method">
                                            {{ $method->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-outline-primary" type="button">Lanjutkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
