<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Благодарим за заказ!</title>
    <style type="text/css">
        .container {
            margin: auto;
            padding: 0;
            width: 50em;
            font-size: 20px;
        }

        table.iksweb {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            height: auto;
        }

        table.iksweb,
        table.iksweb td,
        table.iksweb th {
            border: 0;
        }

        table.iksweb td,
        table.iksweb th {
            padding: 10px 10px 10px 20px;
            width: 200px;
            height: 45px;
        }

        table.iksweb th {
            background: #347c99;
            color: #fff;
            font-weight: normal;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>{{ Auth::user()->name }}, cпасибо за заказ!</h1>
        <hr>
        <p>Ваш заказ №{{ $order[0]->id }}, будет отправлен с помощью: {{ $order[0]->delivery }} <br>
            Доставка по адресу: {{ $order[0]->address }}. <br>
            Сумма заказа: {{ \App\Http\Controllers\ItemsController::formatPrice($order[0]->cost) }} ₽ <br>
            Оплата: {{ $order[0]->pay_method }}. <br></p>
        @if (is_null($order[0]->comment))
            <p>Комментарий к заказу: отсутствует</p>
        @else
            <p>Комментарий к заказу: {{ $order[0]->comment }}</p>
        @endif
        <table class="iksweb">
            <tbody>
                <tr style="background-color: rgb(219, 219, 219);">
                    <td style="width: 320px;">Наименование</td>
                    <td>Цена, ₽</td>
                    <td>Кол-во</td>
                    <td>Сумма, ₽</td>
                </tr>
                @foreach ($items as $i)
                    <tr>
                        <td style="width: 320px;">{{ $i->name }}</td>
                        <td>{{ \App\Http\Controllers\ItemsController::formatPrice($i->price) }} ₽</td>
                        <td>{{ $i->count }} шт.</td>
                        <td>{{ \App\Http\Controllers\ItemsController::formatPrice($i->count * $i->price) }} ₽
                        </td>
                    </tr>
                @endforeach
                <tr style="background-color: rgb(182, 182, 182);">
                    <td style="width: 320px;"><strong>Итого к оплате: </strong></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h2>{{ \App\Http\Controllers\ItemsController::formatPrice($order[0]->cost) }} ₽.</h2>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
