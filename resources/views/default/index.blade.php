@extends("layout")

@section("content")
    <h1>Book Keeper</h1>
    <section>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Pages</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td><a href="/show/{{ $book->slug }}">{{ $book->title }}</a></td>
                    <td>{{ $book->pages }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $books->render() !!}
    </section>
@stop
