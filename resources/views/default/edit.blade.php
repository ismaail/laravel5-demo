@extends("layout")

@section("content")
    <section>
        <h2>Edit book</h2>
        <h4>{{ $book->title  }}</h4>
        {!! Form::model($book, ['url' => '/books/'.$book->slug, 'method' => 'PUT']) !!}
        @include('default/form', ['submitText' => 'Update'])
    </section>
@endsection