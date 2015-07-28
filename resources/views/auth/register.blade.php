@extends("layout")

@section("content")
    <h1>Sign-Up</h1>

        {!! Form::open(['url' => '/user/register']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('username', 'Userame:') !!}
            {!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Register', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
@endsection