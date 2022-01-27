@if ($errors->any())

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger my-2" role="alert">
            {{ $error }}
        </div>
    @endforeach

@elseif(session('success'))
    <div class="alert alert-success my-2" role="alert">
        {{ session('success') }}
    </div>

@endif
