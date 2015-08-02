@extends("layout")

@section("content")
    <article>
        <h1>{{ $book->title }}</h1>
        <p>
            Number of pages: {{ $book->pages }}
        </p>
        <p>
            {{ $book->description }}
        </p>
        <div class="col-sm-4 col-md-2">
            <a href="/books/{{ $book->slug }}/edit" class="button-link">
                <button class="input-sm form-control">Edit</button>
            </a>
        </div>
        <div class="col-sm-4 col-md-2">
            {!! Form::model($book, ['url' => '/books/'.$book->slug, 'method' => 'DELETE']) !!}
            {!! Form::submit( 'Delete' , ['class' => 'input-sm form-control']) !!}
            {!! Form::close() !!}
        </div>

    </article>
@endsection