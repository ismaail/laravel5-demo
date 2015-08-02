@extends("layout")

@section("content")
    <section>
        <h2>Create new book</h2>
        {!! Form::open(['url' => '/books']) !!}
        @include("default/form", ['submitText' => 'Add'])
    </section>
@endsection