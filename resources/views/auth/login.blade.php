@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-9">
           <div class="row align-items-center">
            <div class="col-lg-6">
                <div>
                    <img src="{{asset('assets/img/login.svg')}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow border border-0">
                    <div class="card-header fw-bold text-center fs-3">{{ __('Login') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label">{{ __('UserName') }}</label>
    
                                <div class="col-12">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="developer" required autocomplete="email" autofocus>
    
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
    
                                <div class="col-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value="Test@Password123#">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-12">
                                  <div class="text-center">
                                    <button type="submit" class="btn-main w-50">
                                        {{ __('Login') }}
                                    </button>
                                  </div>
    
                                 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
@endsection
