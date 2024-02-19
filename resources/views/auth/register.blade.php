@extends('layouts.app')

@section('content')
    
    <!-- /.resgister-logo -->
    <div class="card row-mb-6">
        <div class="card-body  ">
            <p class="login-box-msg">Form Tambah Pengguna</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <label for="password" class=" col-form-label">{{ __('Name') }}</label>

                    <div class="input-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Masukan Nama Anda">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class=" col-form-label">{{ __('E-Mail Address') }}</label>

                    <div class="input-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Masukan Email Anda">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class=" col-form-label">{{ __('Password') }}</label>

                    <div class="input-group">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class=" col-form-label">{{ __('Confirm Password') }}</label>

                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    </div>

                    <div class="row">
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary btn-block d-grid w-100">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>

            </form>
        </div>
        <!-- /.register-card-body -->
        <p style="text-align:center"> © 2024 All Rights Reserved. </p>
    </div>
    </div>
    <!-- /.register-box -->

@endsection