@extends('template')

@section('css')
<style>

</style>
@stop

@section('content')
<section style="min-height: 100vh;" class="bg-hero position-relative">
    <div class="position-absolute top-50 start-50 translate-middle">
      <h1 class="text-primary text-login">Fishiden</h1>
    </div>
    <div style="min-height: 100vh;" class="bg-overlay-2 vstack align-items-center justify-content-center">
      <div class="bg-glass p-3 p-md-4 rounded-3 text-white">
        <div class="text-center">
          <h3>Register</h3>
          {{ \App\Helper\Utility::showNotif() }}
        </div>
        <div class="spacer-24"></div>
        <form action="{{route('register.store')}}" method="post">
          @csrf
          <div class="mb-3 has-validation">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control rounded-pill @error('password') is-invalid @enderror" id="exampleInputPassword1">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="spacer-24"></div>
          <button type="submit" class="btn-custom-primary w-100 mb-3">Daftar</button>
          <div class="text-center">
            Sudah memiliki akun? <a class="text-primary fw-bold text-decoration-none" href="{{route('login.index')}}">Login</a>
          </div>
        </form>
      </div>
      <div class="text-center mt-3 text-white">
        <span>Copyright 2024 Fishiden</span>
      </div>
    </div>
  </section>
@stop

@section('script')
<script>
  $(document).ready(function() {
    setTimeout(function() {
        if ($(".alert").length) {
            $(".alert").alert('close');
        } else {
            console.log("No alert element found.");
        }
    }, 2000);
});
</script>
@stop