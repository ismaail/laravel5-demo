@extends("layout")

@section("content")
    <section>
        <h2>Create new book</h2>
        {!! Form::open(['url' => '/books']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('pages', 'Pages:') !!}
            {!! Form::input('number', 'pages', old('pages'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </section>
@endsection