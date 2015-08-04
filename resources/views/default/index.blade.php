@extends("layout")

@section("content")
    <h1>Book Keeper</h1>
    <section>
        <div class="row">
            <div class="col-sm-7 col-md-8"><h2>Books list:</h2></div>
            @if (User::isAdmin())
            <div class="col-xs-12 col-sm-3 col-md-2 pull-right">
                <a href="/books/create" class="button-link">
                    <button class="input-sm form-control">Add new book</button>
                </a>
            </div>
            @endif
        </div>
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
                    <td><a href="/books/{{ $book->slug }}">{{ $book->title }}</a></td>
                    <td>{{ $book->pages }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $books->render() !!}
    </section>
@stop
