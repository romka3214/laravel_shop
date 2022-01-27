@extends('layouts.index')

@section('content')
    <div class="row align-items-md-stretch">
        <div class="col-12">
            <div class="h-100 p-5 text-white bg-dark rounded-3 d-flex justify-content-between">
                <div class="info d-flex flex-column justify-content-around">
                    <div class="box">
                        <h1>{{Auth::user()->name}}</h1>
                        <h2>{{Auth::user()->email}}</h2>
                    </div>
                    <div class="box">
                    </div>
                </div>
                <div class="photo">
                    <img src="img/none.png" alt="" width="300">
                </div>
            </div>
        </div>
        <h2 class="mt-4">My orders</h2>
        <div class="col-12 my-2">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2><a href="/item">Order</a> </h2>
                <p>Nov 24 -> Dec 12</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam deserunt, aperiam laudantium
                    cupiditate tempora sit animi quia amet quam accusantium vel praesentium eum voluptatem cumque. A amet
                    ipsam laborum voluptate!</p>
                <button class="btn btn-outline-primary" type="button">View</button>
            </div>
        </div>
    </div>
@endsection
