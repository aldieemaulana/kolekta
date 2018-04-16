@extends('templates.auth.frame')
@section('title', 'Welcome to Kolekta!')

@section('content')
    <div class="register-container full-height">
        <div class="d-flex justify-content-center flex-column full-height">
            <div class="brand inline no-border hidden-xs-down fs-16 bold sm-m-t-25">KOLEKTA</div>
            <h3>Log in to your account</h3>
            <p>Log in with your facebook account, log into it for this process. Sign in with
                <a class=" btn bold all-caps b-rad-sm" href="#"><i class="fa fa-facebook-official text-complete"></i> Facebook</a>
                or
                <a class=" btn bold all-caps b-rad-sm" href="#"><i class="fa fa-google text-danger"></i> Google</a>
            <form action="{{ url('user/sign-in/do') }}" class="p-t-15" id="form-register" method="POST" name="form-register" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-default {{ $errors->has('email') ? ' error' : '' }}">
                            <label>Email</label> <input class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required type="email">
                        </div>
                        @if ($errors->has('email'))
                            <label class="error small-text">
                                {{ $errors->first('email') }}
                            </label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-default {{ $errors->has('password') ? ' error' : '' }}">
                            <label>Password</label> <input class="form-control" name="password" placeholder="Secret Character" required="" type="password">
                        </div>
                        @if ($errors->has('password'))
                            <label class="error small-text">
                                {{ $errors->first('password') }}
                            </label>
                        @endif
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-lg-6">
                        <div class="checkbox check-info m-t-0 small">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="checkboxRemember">
                            <label for="checkboxRemember"> Remember me</label>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right p-t-10">
                        <a class="text-info small" href="#">Forgot username or password?</a> or
                        <a class="text-info small" href="{{ url('user/sign-up') }}">Sign Up</a>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg m-t-20 bold all-caps" type="submit">Log In <i class="fa fa-angle-right"></i></button>
            </form>
        </div>
    </div>
@endsection


@push("script")
    <script>

    </script>
@endpush

