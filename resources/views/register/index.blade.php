@extends('layouts.master')

@section('container')

<section class="page-section" id="contact">
    <div class="container">

<!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

<div class="row justify-content-center">
    <div class="col-md-9 mt-5">
        <main class="form-registration">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Register</h2>
            <form action="/register" method="post">
                @csrf

              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror"
                id="name" placeholder="Name" required value="{{ old('name')}}">
                <label for="name">Name</label>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                @enderror
              </div>

              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                id="email" placeholder="Email@example.com" required value="{{ old('email')}}">
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                @enderror
              </div>

              <div class="form-floating">
                <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror"
                id="password" placeholder="Password" required>
                <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
              </div>

              <div class="form-floating">
                <input type="text" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"
                id="confirm_password" placeholder="Username" required value="{{ old('confirm_password')}}">
                <label for="confirm_password">Confirmation Password</label>
                @error('confirm_password')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                @enderror
              </div>

              <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already Registered? <a href="/login">Login</a></small>
          </main>
    </div>
</div>

            </div>
        </div>
    </div>
</section>

@endsection
