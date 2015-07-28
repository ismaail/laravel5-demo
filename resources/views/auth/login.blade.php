@extends("layout")

@section("content")
    <h1>Login Page</h1>
    {!! Form::open(['url' => '/user/login']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('remember', 'Remember Me:') !!}
            {!! Form::checkbox('remember', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Login', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
@endsection