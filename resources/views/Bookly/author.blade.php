@extends('bookly.wrapper')

@section('title')
    <title>Authors | BookLy</title>
@endsection

@section('content')
    <main class="d-flex justify-content-center">
        <div class="mt-5">
            <div class="bg-box-author d-flex flex-column pt-2 pb-3">
                <div class="text-center my-2 text-white">
                    <h3 class="display-4">Authors</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-bookly my-3" data-toggle="modal" data-target="#addModal">
                        Add author
                    </button>
                </div>
                @if(isset($authors))
                @foreach($authors as $author)
                    <div class="ml-3 my-1 text-white d-flex justify-content-between">
                        <h5>
                            <i class="fa fa-pencil mr-2" aria-hidden="true"></i>
                            {{ $author->name }}
                            <span> ({{ $author->year_of_birth }})</span>
                        </h5>
                        <div class="mr-3">
                            <button type="button" class="btn btn-bookly btn-author"  data-toggle="modal" data-target="#authorModal{{ $author->id }}">Edit</button>
                            <a href="{{action('AuthorsController@destroy', ["id" => "$author->id"])}}" class="btn btn-bookly text-white btn-author">Delete</a>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </main>



    <!-- Modals for Add Author -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-box" role="document">
            <div class="modal-content bg-darkbrown">
                <div class="modal-header bg-darkbrown text-white">
                    <h5 class="modal-title" id="addModalLabel">Add Author</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-darkbrown text-white">
                    <form method="post" action="">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Name of the author</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="year_of_birth">Year of Birth</label>
                            <input name="year_of_birth" type="year" class="form-control" id="year_of_birth">
                        </div>
                        <button type="submit" class="btn btn-bookly">Submit</button>
                    </form>
                </div>
                <div class="modal-footer bg-darkbrown text-white">
                    <button type="button" class="btn btn-bookly" data-dismiss="modal">Close</button>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger w-25 mx-auto mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @if(isset($authors))
        @foreach($authors as $author)
            <!-- Modals for Author edit -->
            <div class="modal fade" id="authorModal{{ $author->id }}" tabindex="-1" role="dialog" aria-labelledby="authorModalLabel" aria-hidden="true">
                <div class="modal-dialog bg-box" role="document">
                    <div class="modal-content bg-darkbrown">
                        <div class="modal-header bg-darkbrown text-white">
                            <h5 class="modal-title" id="authorModalLabel">{{ $author->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">&times;</span>
                            </button>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal-body bg-darkbrown text-white togglemodals">
                            <form method="post" action="{{action('AuthorsController@edit', ['id' => $author->id])}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Author's name:</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter the name" value="{{ $author->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="year_of_birth">Year of his birth:</label>
                                    <input name="year_of_birth" type="text" class="form-control" id="year_of_birth" placeholder="Enter year" value="{{ $author->year_of_birth }}">
                                </div>

                                <button type="submit" class="btn btn-bookly">Submit</button>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-bookly" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection