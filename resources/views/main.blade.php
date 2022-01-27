@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-md-2 mb-2">
        <h3>Бренды</h3>
        <div class="list-group">
            @foreach ($cats as $c)
            <a type="button" href="/cat/{{ $c->id }}" class="list-group-item list-group-item-action">{{ $c->name }}</a>
            @endforeach
        </div>
    </div>
    @foreach ($items as $i)
    <div class="col-md-3 mb-2">
        <div class="card shadow-sm h-100" >
            <div class="d-flex justify-content-center m-2" style="height: 250px;" >
                <img src="{{$i -> img}}" style="height: 250px;" alt="">
            </div>
            <div class="card-body">
                <h2>{{$i -> name}}</h2>
                <div class="overflow-hidden">
                    <p class="card-text" style="height: 150px;">{{$i -> desc}}</p>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="d-flex flex-column">
                        <button type="button" class="btn btn-sm btn-primary my-2" id="addCart" data-item="{{$i -> id}}" value="{{ csrf_token() }}">В корзину</button>
                        <a href="/item/{{$i -> id}}" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                    </div>
                    <a class="btn btn-success position-relative m-2 ml-auto p-2">
                        {{\App\Http\Controllers\ItemsController::formatPrice($i -> price)}} ₽
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection