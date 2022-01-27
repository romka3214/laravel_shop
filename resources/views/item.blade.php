@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-3 col-lg-4 col-md-12 col-sm-12 col-12 my-3 text-center">
        <img src="{{ $item->img }}" class="img-fluid" alt="">
    </div>
    <div class="col-md-8">
        <h2>{{ $item->name }}</h2>
        <p>{{ $item->desc }}</p>
        <a class="btn btn-primary position-relative me-1">
            {{ \App\Http\Controllers\ItemsController::formatPrice($item->price) }} ₽
        </a>
        <button type="button" class="btn btn-sm btn-primary my-2" id="addCart" data-item="{{$item -> id}}" value="{{ csrf_token() }}">Добавить в корзину</button>
    </div>
</div>
<p class="my-3">

</p>
<div class="row my-3" id='rewiews'>
    <h3>Отзывы</h3>
    @if(!$rewiews->isEmpty())
        @foreach ($rewiews as $r)
        <div class="bg-light p-4 rounded my-2">
            <p>Пользователь: {{ $r -> user_name}}</p>
            <h4>Оценка:  {{ $r->score }}/10</h4>
            <p>Текст отзыва: {{$r -> text}}</p>
        </div>
        @endforeach
    @else 
    <div class="row my-3 text-center">
        <h3>У данного товара ещё нет отзывов! <br> Станьте первым ;) </h3>
    </div>
    @endif
</div>
@auth
<div class="row my-3">
    <h3>Оставьте свой отзыв на товар</h3>
    <div class="bg-light p-4 rounded">
        <form action="{{ route('newRewiew', ['id' => $item->id]) }}" method="POST" id="forma">
            @csrf
            <input type="hidden" name="ID" value="{{$item->id}}">
            <input type="number" name="score" min="1" max="10" class="form-control" placeholder="Ваша оценка" id="score" required><br>
            <input type="text" name="msg" cols="30" rows="4" class="form-control" placeholder="Ваш отзыв" id="msg" required><br>
            <button type="submit" name="newrew" class="btn btn-warning" id="send">Отправить</button>
            <div id="notification">
                <p></p>
            </div>
        </form>

    </div>
    @include('incl.msg')
</div>
@endauth

@guest
<div class="row my-3 text-center">
    <h3>Добавление отзывов доступно только аутентифицированным пользователям.</h3>
</div>
@endguest

@endsection