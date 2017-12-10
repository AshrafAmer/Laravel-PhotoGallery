@extends ('layouts.main')

@section('content')
    <div class="callout primary">
        <div class="row column">
            <h1>Create PhotoGallery</h1>
            <p class="lead">Create your own gallery and start uploading</p>
        </div>
    </div>

    {!! Form::open(array('action' => 'GalleryController@store', 'enctype' => 'multipar/form-data')) !!}
        {!! Form::label('name', 'Name'); !!}
        {!! Form::text('name', $value = null, $attributes = ['placeholder'=>'Gallery Name', 'name' => 'name']); !!}

        {!! Form::label('description', 'Description'); !!}
        {!! Form::text('description', $value = null, $attributes = ['placeholder'=>'Gallery Description', 'name' => 'description']); !!}

        {!! Form::label('cover_image', 'Cover image'); !!}
        {!! Form::file('cover_image')!!}

        {!! Form::submit('Submit', $attributes = ['class' => 'button'])!!}
    {!! Form::close() !!}
@endsection