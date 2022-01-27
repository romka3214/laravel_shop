@extends('layouts.index')

@section('content')
<div class="row mb-2">
    <div class="col-12">
        <h2>Корзина товаров <span id="countAll" class="badge bg-dark">{{\App\Http\Controllers\CartController::countCart()}}</span></h2>
    </div>
</div>
@if(!$info->isEmpty())
@foreach ($info as $i)
<div class="row mb-2">
    <div class="col-md-12">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <h2 class="d-inline-block mb-2 text-primary"><a href="/item/{{ $i -> itemId }}" class="text-decoration-none text-dark">{{$i -> item}}</a></h2>
                <h4 class="card-text mb-auto">Цена: {{\App\Http\Controllers\ItemsController::formatPrice($i -> price)}} ₽</h4>
                <h4 class="card-text mb-auto">Кол-во: <button class="btn btn btn-outline-primary" onclick="changeCount(this,'minus','{{ csrf_token() }}')" data-id="{{$i -> id}}">-</button> <span class="badge bg-dark" data-item="{{$i -> id}}">{{$i -> count}}</span> <button class="btn btn btn-outline-primary" onclick="changeCount(this,'plus','{{ csrf_token() }}')" data-id="{{$i -> id}}">+</button></h4>
                <h4 class="card-text mb-auto" id="sumItem" data-id="{{$i -> id}}">Сумма: {{\App\Http\Controllers\ItemsController::formatPrice($i->price * $i->count)}} ₽</h4>
            </div>
            <div class="col-auto d-lg-block">
                <img src="{{$i -> img}}" alt="" class="p-3" height="300">
            </div>
                <div class="col-12 p-3">
                <a href="{{route('removeItemFromCart', $i->id)}}" onclick="return confirm('Удалить товар из списка?')" class="btn btn btn-outline-primary w-100">Удалить</a>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="row mb-2 text-end">
    <h1 id="summa">{{\App\Http\Controllers\ItemsController::formatPrice($sum)}} ₽</h1>
</div>
<div class="row mb-2 float-end">
    <div class="col-4 ">
        <a href="{{route('payment')}}" class="btn btn-lg btn-primary my-1">Оплатить</a>
    </div>
</div>
@else
<div class="row m-3 text-center d-flex align-items-center" style="height: 60vh;">
    <h1>Ваша корзина пуста</h1>
</div>
@endif

@endsection