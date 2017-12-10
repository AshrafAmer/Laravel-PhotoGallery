@extends ('layouts.main')

@section('content')
    <div class="callout primary">
        <div class="row column">
            <h1> Upload Photo</h1>
            <p class="lead">Upload photos that you need</p>
        </div>
    </div>

    {!! Form::open(array('action' => 'PhotoController@store', 'enctype' => 'multipar/form-data')) !!}
        {!! Form::label('title', 'Title'); !!}
        {!! Form::text('ttle', $value = null, $attributes = ['placeholder'=>'photo title', 'name' => 'title']); !!}

        {!! Form::label('description', 'Description'); !!}
        {!! Form::text('description', $value = null, $attributes = ['placeholder'=>'Gallery Description', 'name' => 'description']); !!}

        {!! Form::label('location', 'Location'); !!}
        {!! Form::text('location', $value = null, $attributes = ['placeholder'=>'Photo Location', 'name' => 'location']); !!}

        {!! Form::label('image', 'Photo'); !!}
        {!! Form::file('image')!!}

        <input type="hidden" name="id" value="{{$id}}">
        {!! Form::submit('Submit', $attributes = ['class' => 'button'])!!}
    {!! Form::close() !!}
@endsection