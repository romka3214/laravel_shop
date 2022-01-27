@extends('layouts.index')

@section('content')
    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Ваша корзина</span>
                <span class="badge bg-primary rounded-pill">{{ \App\Http\Controllers\CartController::countCart() }}</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach ($info as $v => $i)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $i->item }}</h6>
                            <small class="text-muted">Кол-во: {{ $i->count }}</small>
                        </div>
                        <span class="text-muted">{{ \App\Http\Controllers\ItemsController::formatPrice($sumItem[$v]) }}
                            ₽</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Итого: (RUB)</span>
                    <strong>{{ \App\Http\Controllers\ItemsController::formatPrice($sum) }} ₽</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-7 col-lg-8">

            <h4 class="mb-3">Способ доставки</h4>
            <div class="my-3">
                <form id="sendOrder">
                    @csrf
                    <div class="form-check">
                        <input id="RusPost" name="DeliveryMethod" type="radio" class="form-check-input" value="RusPost" checked required>
                        <label class="form-check-label" for="RusPost">Почта России</label>
                    </div>
                    <div class="form-check">
                        <input id="SDEK" name="DeliveryMethod" type="radio" class="form-check-input" value="SDEK" required>
                        <label class="form-check-label" for="SDEK">СДЭК</label>
                    </div>
                    <div class="form-check">
                        <input id="Sber" name="DeliveryMethod" type="radio" class="form-check-input" value="Sber" required>
                        <label class="form-check-label" for="Sber">СберЛогистика-Курьер</label>
                    </div>
            </div>
            <h4 class="mb-3">Адресс доставки</h4>

            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">Имя</label>
                    <input name="name" type="text" class="form-control" id="firstName" placeholder="Иван" value=""
                        required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="lastName" class="form-label">Фамилия</label>
                    <input name="surname" type="text" class="form-control" id="lastName" placeholder="Иванов" value=""
                        required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Адрес</label>
                    <input name="address" type="text" class="form-control" id="address"
                        placeholder="г. Уфа ул. Ухтомского 3/1 кв. 55" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Примечания к заказу</label><span class="text-muted">
                        (Мы передадим эту информацию транспортной компании)</span>
                    <input name="comment" type="text" class="form-control"
                        placeholder="Нарисуйте на упаковке милого котика :3">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>
            </div>

            <hr class="my-4">


            <h4 class="mb-3">Способ оплаты</h4>

            <div class="my-3">
                <div class="form-check">
                    <input id="card" name="paymentMethod" type="radio" class="form-check-input" value="card" onclick="changeCardMethod(this)" checked required>
                    <label class="form-check-label" for="card">Картой Онлайн</label>
                </div>
                <div class="form-check">
                    <input id="cartOnHand" name="paymentMethod" type="radio" class="form-check-input" value="cartOnHand" onclick="changeCardMethod(this)" required>
                    <label class="form-check-label" for="cartOnHand">Картой при получении</label>
                </div>
                <div class="form-check">
                    <input id="cash" name="paymentMethod" type="radio" class="form-check-input" value="cash" onclick="changeCardMethod(this)" required>
                    <label class="form-check-label" for="cash">Наличными</label>
                </div>
            </div>

            <div class="row gy-3" id = "cardForm">
                <div class="col-md-6">
                    <label for="cc-name" class="form-label">Имя и фамилия владельца карты</label>
                    <input name="fullname_card" type="text" class="form-control" id="cc-name" placeholder="Иван Иванов"
                        required>
                    {{-- передаём в форму полную цену в скрытом инпуте --}}
                    <input type="hidden" name="fullCost" value="{{$sum}}">  
                    <div class="invalid-feedback">
                        Name on card is required
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="cc-number" class="form-label">Номер карты</label>
                    <input name="num_card" type="text" class="form-control" id="cc-number"
                        placeholder="XXXX XXXX XXXX XXXX" required>
                    <div class="invalid-feedback">
                        Credit card number is required
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="cc-expiration" class="form-label">Срок действия</label>
                    <input name="exp_card" type="text" class="form-control" id="cc-expiration" placeholder="01/12"
                        required>
                    <div class="invalid-feedback">
                        Expiration date required
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="cc-cvv" class="form-label">CVV</label>
                    <input name="cvv_card" type="text" class="form-control" id="cc-cvv" placeholder="123" required>
                    <div class="invalid-feedback">
                        Security code required
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Заказать</button>

            </form>
        </div>
    </div>
    </main>
@endsection
