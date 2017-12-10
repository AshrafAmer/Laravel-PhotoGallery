@extends ('layouts.main')

@section('content')
    <div class="callout primary">
        <div class="row column">
            <h1> {{$photo->title}}</h1>
            <p class="lead">
                {{$photo->description}}
                <hr>
                {{$photo->location}}
            </p>
        </div>
        <div class="main">
            <img class="main-img" src="/cover_images/{{$photo->image}}">
        </div>
    </div>

@endsection