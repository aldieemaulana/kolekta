@extends('templates.auth.frame')
@section('title', 'Welcome to Kolekta!')

@section('content')
    <div class="register-container full-height sm-p-t-30">
        <div class="d-flex justify-content-center flex-column full-height">
            <div class="brand inline no-border hidden-xs-down fs-16 bold sm-m-t-25">KOLEKTA</div>
            <h3>Create a Free Account</h3>
            <p>Create a Kolekta account. If you have a facebook account, log into it for this process. Sign in with
                <a class=" btn bold all-caps b-rad-sm" href="#"><i class="fa fa-facebook-square text-complete"></i> Facebook</a>
                or
                <a class=" btn bold all-caps b-rad-sm" href="#"><i class="fa fa-google text-danger"></i> Google</a>
                <form method="POST" action="{{ url('user/sign-up/do') }}" class="p-t-15" id="form-register" name="form-register" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required {{ $errors->has('name') ? ' error' : '' }}">
                                <label>Full Name</label> <input value="{{ old('name') }}" class="form-control" name="name" placeholder="John Maulana" required="" type="text">
                            </div>
                            @if ($errors->has('name'))
                                <label class="error small-text">
                                    {{ $errors->first('name') }}
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required {{ $errors->has('email') ? ' error' : '' }}">
                                <label>Email</label> <input value="{{ old('email') }}"  class="form-control" name="email" placeholder="We will send loging details to you" required="" type="email">
                            </div>
                            @if ($errors->has('email'))
                                <label class="error small-text">
                                    {{ $errors->first('email') }}
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default required {{ $errors->has('password') ? ' error' : '' }}">
                                <label>Password</label> <input class="form-control" name="password" placeholder="Minimum of 6 Charactors" required="" type="password">
                            </div>
                            @if ($errors->has('password'))
                                <label class="error small-text">
                                    {{ $errors->first('password') }}
                                </label>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Confirm Password</label> <input class="form-control" name="password_confirmation" placeholder="Minimum of 6 Charactors" required="" type="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-group-default-select2 {{ $errors->has('password') ? ' error' : '' }}">
                                <label>Category</label>
                                {{ Form::select('category', $categories, null, ["class" => "full-width", "id" => "category", "data-init-plugin" => "select2", "required"]) }}
                            </div>
                            @if ($errors->has('category'))
                                <label class="error small-text">
                                    {{ $errors->first('category') }}
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-lg-6">
            <p><small>I agree to the <a class="text-info" href="#">Pages Terms</a> and <a class="text-info" href="#">Privacy</a>.</small></p>
        </div>
        <div class="col-lg-6 text-right text-info small">
            Already have an account?
            <a class="text-info" href="{{ url('user/sign-in') }}">Sign In</a>
        </div>
    </div>
    <button class="btn btn-primary btn-block btn-lg m-t-20 bold all-caps" type="submit"><i class="fa fa-plus"></i> Create a new account</button>
    </form>
    </div>
    </div>
@endsection


@push("script")
    <script>

    </script>
@endpush