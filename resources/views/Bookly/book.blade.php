@extends('Bookly.wrapper')

@section('title')
    <title>Books | BookLy</title>
@endsection

@section('content')
    <main>
        <div class="bookshelf mt-5">

            <a data-toggle="modal" data-target="#welcomeModal">
                <div class="book book-green">
                    <h2 class="mt-1">Welcome Book</h2>
                </div>
            </a>
            <a data-toggle="modal" data-target="#addModal">
                <div class="book-tilted">
                <div class="book book-blue">
                    <h2 class="mt-1">Add Book</h2>
                </div>
                </div>
            </a>



            @if(isset($books))
                <?php $count = 1; ?>
                @foreach($books as $book)
                    @if($count%3 == 0)
                        <a data-toggle="modal" data-target="#bookModal{{ $book->id }}">
                            <div class="book book-umber">
                                <h2 class="mt-1">{{ $book->title }}</h2>
                            </div>
                        </a>
                    @elseif($count%2 == 0)
                        <a data-toggle="modal" data-target="#bookModal{{ $book->id }}">
                            <div class="book book-springer">
                                <h2 class="mt-1">{{ $book->title }}</h2>
                            </div>
                        </a>
                    @else
                        <a data-toggle="modal" data-target="#bookModal{{ $book->id }}">
                            <div class="book book-red">
                                <h2 class="mt-1">{{ $book->title }}</h2>
                            </div>
                        </a>
                    @endif
                    <?php $count++; ?>
                @endforeach
            @endif

        </div>
    </main>

    <!-- Modals for Every Book -->
    @if(isset($books))
    @foreach($books as $book)
        <?php $author = \App\Authors::where('id', '=', $book->author_id )->first();?>
        <div class="modal fade" id="bookModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
            <div class="modal-dialog bg-box" role="document">
                <div class="modal-content bg-darkbrown">
                    <div class="modal-header bg-darkbrown text-white">
                        <h5 class="modal-title" id="bookModalLabel">{{ $book->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>

                    <!-- Detail Modal -->
                    <div class="modal-body bg-darkbrown text-white togglemodals">
                        <h6>My thoughts:</h6>
                        <hr class="bg-white">
                        <p>{{ $book->my_review }}</p>
                        <div>
                            <span class="badge badge-dark">Book published at: {{ $book->published_at }}</span>
                            <span class="badge badge-dark">Finished reading: {{ $book->finished_reading_at }}</span>
                            <span class="badge badge-dark">Author:  <?php if(isset($author)) { echo $author->name;}?></span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo ($book->my_rating * 10); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                <strong class="ml-1"><?php echo ($book->my_rating * 10); ?>%</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal-body bg-darkbrown text-white togglemodals d-none">
                        <form method="post" action="{{action('BooksController@edit', ['id' => $book->id])}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="title">Title of the book</label>
                                <input name="title" type="text" class="form-control" id="title" placeholder="Enter the title" value="{{ $book->title }}">
                            </div>
                            <div class="form-group">
                                <label for="published_at">Book published at</label>
                                <input name="published_at" type="date" class="form-control" id="published_at" value="{{ $book->published_at }}">
                            </div>
                            <div class="form-group">
                                <label for="my_review">My review</label>
                                <input name="my_review" type="text" class="form-control" id="my_review" placeholder="Enter your thoughts on the book" value="{{ $book->my_review }}">
                            </div>
                            <div class="form-group">
                                <label for="finished_reading_at">Finished reading at</label>
                                <input name="finished_reading_at" type="integer" class="form-control" id="finished_reading_at" value="{{ $book->finished_reading_at }}">
                            </div>
                            <div class="form-group">
                                <label for="author_id">Author</label>
                                <select name="author_id" id="author_id" class="form-control">

                                    <?php $authors = \App\Authors::get();?>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" @if($book->author_id == $author->id) selected @endif>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="my_rating">Rating</label>
                                <select name="my_rating" id="my_rating" class="form-control">
                                    @for( $i = 0; $i < 11; $i++)
                                        <option value="{{ $i }}>" @if($book->my_rating==$i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>


                            <button type="submit" class="btn btn-bookly">Submit</button>
                        </form>
                    </div>

                    <div class="modal-footer bg-darkbrown text-white">
                        <button type="button" class="btn btn-bookly" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-bookly toggleBtn">Edit</button>
                        <a href="{{action('BooksController@destroy', ["id" => "$book->id"])}}" class="btn btn-bookly text-white">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

    <!-- Modals for Add Book -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-box" role="document">
            <div class="modal-content bg-darkbrown">
                <div class="modal-header bg-darkbrown text-white">
                    <h5 class="modal-title" id="addModalLabel">Add Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-darkbrown text-white">
                    <form method="post" action="">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="title">Title of the book</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Enter the title">
                        </div>
                        <div class="form-group">
                            <label for="published_at">Book published at</label>
                            <input name="published_at" type="date" class="form-control" id="published_at">
                        </div>
                        <div class="form-group">
                            <label for="my_review">My review</label>
                            <input name="my_review" type="text" class="form-control" id="my_review" placeholder="Enter your thoughts on the book">
                        </div>
                        <div class="form-group">
                            <label for="finished_reading_at">Finished reading at</label>
                            <input name="finished_reading_at" type="date" class="form-control" id="finished_reading_at">
                        </div>
                        <div class="form-group">
                            <label for="author_id">Author</label>
                            <select name="author_id" id="author_id" class="form-control">
                                <?php $authors = \App\Authors::get();?>
                                @if(isset($authors))
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="my_rating">Rating</label>
                            <select name="my_rating" id="my_rating" class="form-control">
                                @for( $i = 0; $i < 11; $i++)
                                    <option value="{{ $i }}>">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-bookly">Submit</button>
                    </form>
                </div>
                <div class="modal-footer  bg-darkbrown text-white">
                    <button type="button" class="btn btn-bookly" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for Welcome Book -->
    <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-box" role="document">
            <div class="modal-content bg-darkbrown">
                <div class="modal-header bg-darkbrown text-white">
                    <div class="modal-title" id="welcomeModalLabel">
                        <h4>Welcome to Bookly!</h4>
                        <h6>To your own virtual bookshelf.</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-darkbrown text-white">
                    <p>My name is <strong>Johnny</strong>.<br><br>I've created this bookshelf as a task at Coding Bootcamp Praha in Autumn Batch 2017. I hope you will like it, and that, this little web app will be helpful for you in tracking your book reading journey.<br><br>Have a great time!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bookly" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection