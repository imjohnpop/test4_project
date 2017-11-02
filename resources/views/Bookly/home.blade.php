@extends('Bookly.wrapper')

@section('title')
    <title>Home | BookLy</title>
@endsection

@section('content')

    @if(Auth::check())
    <main class="d-flex justify-content-center">
        <div class="h-25 w-25 mt-5 rounded">
            <div class="bg-box p-5">
                <div class="p-3">
                    <img class="img-fluid" src="img/logo.png" alt="logo">
                </div>
                <h1 class="display-4 text-center text-white mt-3">BookLy</h1>
                <div class="mt-4">
                    <a class="btn btn-bookly btn-block text-white" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </main>
    @else
    <main class="d-flex justify-content-center">
        <div class="h-25 w-25 mt-5 rounded">
            <div class="bg-box p-5">
                <div class="p-3">
                    <img class="img-fluid" src="img/logo.png" alt="logo">
                </div>
                <h1 class="display-4 text-center text-white mt-3">BookLy</h1>
                <div class="mt-4">
                    <button type="button" class="btn btn-bookly btn-block" data-toggle="modal" data-target="#loginModal">Login</button>
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-bookly btn-block" data-toggle="modal" data-target="#registerModal">Register</button>
                </div>
            </div>
        </div>
    </main>
    @endif


    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-box" role="document">
            <div class="modal-content bg-darkbrown">
                <div class="modal-header bg-darkbrown text-white">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-darkbrown text-white">
                    <!-- ********************************** -->
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-bookly">
                                    Login
                                </button>

                                <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                    <!-- ********************************** -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal ******************************* -->

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog  bg-box" role="document">
            <div class="modal-content bg-darkbrown">
                <div class="modal-header bg-darkbrown text-white">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-darkbrown text-white">
                    <!-- ********************************** -->
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12 col-md-offset-4">
                                <button type="submit" class="btn btn-bookly">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- ********************************** -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal ******************************* -->
@endsection
