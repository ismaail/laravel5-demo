@extends("layout")

@section("content")
    <article>
        <h1>{{ $book->title }}</h1>
        <div>
            Number of pages: {{ $book->pages }}
        </div>
        <div>
            {{ $book->description }}
        </div>
    </article>
@endsection