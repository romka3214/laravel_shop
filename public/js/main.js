
$('#forma').on('submit', function (e) {
    e.preventDefault();

    var score = $("#score").val();
    var text = $("input[name = 'msg']").val();
    var id = $("input[name = 'ID']").val();

    // console.log(text);
    // console.log(score);

    $.ajax({
        url: '/item/' + id + '/newRewiew',
        type: "POST",
        data: {
            score: score,
            text: text,
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            if (document.getElementById('notification').lastChild) {

                $('#notification:nth-child(1)').slideUp('slow').promise().done(function () { document.getElementById('notification').removeChild(document.getElementById('notification').lastChild); }); // НЕ РАБОТАЕТ АССИНХРОННОЕ ГАВНО

                let div = document.createElement('div');
                div.className = "alert alert-success my-2";
                div.innerHTML = 'Спасибо за ваш отзыв!';
                $(div).css('display', 'none');
                $('#notification').append(div);
                $(div).slideDown(1000);
                // console.log(res);
                // console.log(res.sc);
                // console.log(res.tx);

                let rew = document.createElement('newrew');
                rew.className = "bg-light p-4 rounded my-2";
                rew.innerHTML = '<p>' + 'Пользователь: ' + res.user + '</p><h4>' + 'Оценка: ' + res.sc + '/10 ' + '</h4><p>' + 'Текст отзыва: ' + res.tx + '</p>';
                $(rew).css('display', 'none');
                $('#rewiews').append(rew);
                $(rew).slideDown(1000);
            }

        },
        error: function (res) {
            let response = res.responseJSON.errors;
            console.log(res);
            if (response.score) {
                response.score.forEach(element => {
                    let div = document.createElement('div');
                    div.className = "alert alert-danger my-2";
                    div.innerHTML = element;
                    $('#notification').append(div);
                });
            };
            if (response.text) {
                response.text.forEach(element => {
                    let div = document.createElement('div');
                    div.className = "alert alert-danger my-2";
                    div.innerHTML = element;
                    $('#notification').append(div);
                });
            };
        }
    });
});


$('form#registration').on('submit', function (e) {
    e.preventDefault();

    var info = $(this).serialize();

    var pass1 = $('form#registration > input[name = pass1]').val();
    var pass2 = $('form#registration > input[name = pass2]').val();

    if (pass1 == pass2) {
        $.ajax({
            url: '/registration',
            type: "POST",
            data: info,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('form#registration > input').val('');
                $('#notif > .alert').attr('class', 'alert alert-success my-2');
                $('#notif>.alert').text('Вы успешно зарегистрировались!');
                $('#notif').hide().slideDown(300);

            },
            error: function (res) {
                var errorjson = res.responseJSON.errors;
                var errors = '';



                $.each(errorjson, function (index, el) {
                    errors += el + '<br>';
                });


                $('#notif > .alert').attr('class', 'alert alert-danger my-2');
                $('#notif > .alert').html(errors);
                $('#notif').hide().slideDown(300);
                console.log(res);

            }
        });
    } else {
        $('#notif > .alert').attr('class', 'alert alert-danger my-2');
        $('#notif > .alert').text('Пароли должны совпадать!');
        $('#notif').hide().slideDown(300);
    }


});

$('form#auth').on('submit', function (e) {
    e.preventDefault();

    var info = $(this).serialize();

    $.ajax({
        url: '/auth',
        type: "POST",
        data: info,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            $('#error > .alert').attr('class', 'alert alert-success my-2');
            $('#error>.alert').text('Успешная авторизация');
            $('#error').hide().slideDown(100);
            window.location.href = "/";

        },
        error: function (res) {
            $('form#auth > input').val('');
            $('#error > .alert').attr('class', 'alert alert-danger my-2');
            $('#error > .alert').text('Не правильный логин или пароль');
            $('#error').hide().slideDown(300);
            console.log(res);

        }
    });


});

$('button#addCart').click(function (e) {
    e.preventDefault();

    var item = $(this).attr('data-item');
    $.ajax({
        url: '/addCart',
        type: "POST",
        data: { item: item },
        headers: {
            'X-CSRF-TOKEN': $(this).attr('value')
        },
        success: function (res) {
            $('span#countCart').slideUp(100);
            $('span#countCart').text(res);
            $('span#countCart').slideDown(100);

        },
        error: function (res) {
            alert('Вам необходимо авторизироваться');
            console.log(res);
        }
    });
})

function changeCount(el, let, token) {
    let id = $(el).attr('data-id');
    let currentCount = $('span[data-item="' + id + '"]').text();
    if (currentCount == 1 & let == 'minus') {
        window.location.href = "/removeItemFromCart/" + id;
    }

    $.ajax({
        url: '/countItem',
        type: "POST",
        data: { id: id, let: let },
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (res) {
            $('span[data-item="' + id + '"]').slideUp(60);
            $('span[data-item="' + id + '"]').text(res.count);
            $('span[data-item="' + id + '"]').slideDown(60);
            $('h4#sumItem[data-id="' + id + '"]').slideUp(60);
            $('h4#sumItem[data-id="' + id + '"]').text('Сумма: ' + res.price + ' ₽');
            $('h4#sumItem[data-id="' + id + '"]').slideDown(60);
            $('span#countCart').text(res.countAll);
            $('span#countAll').text(res.countAll);
            $('h1#summa').text(res.summa + ' ₽');

            console.log(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
}

$('form#sendOrder').on('submit', function (e) {
    e.preventDefault();

    var info = $(this).serialize();

    $.ajax({
        url: '/sendOrder',
        type: "POST",
        data: info,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            window.location.href = "/success";
        },
        error: function (res) {
            console.log(info);
            console.log(res);
        }
    });
});


function changeCardMethod(e) {
    var choose = $(e).attr('value');

    switch (choose) {
        case 'card':
            $('div#cardForm').slideDown(500);

            $('input#cc-name').prop('required', true);
            $('input#cc-number').prop('required', true);
            $('input#cc-expiration').prop('required', true);
            $('input#cc-cvv').prop('required', true);
            break;
        case 'cartOnHand':
            $('div#cardForm').slideUp(500);

            $('input#cc-name').removeAttr('required');
            $('input#cc-number').removeAttr('required');
            $('input#cc-expiration').removeAttr('required');
            $('input#cc-cvv').removeAttr('required');
            break;
        case 'cash':
            $('div#cardForm').slideUp(500);

            $('input#cc-name').removeAttr('required');
            $('input#cc-number').removeAttr('required');
            $('input#cc-expiration').removeAttr('required');
            $('input#cc-cvv').removeAttr('required');
            break;
    }

}





