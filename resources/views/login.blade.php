<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Fishiden</title>
  <link href="{{ \App\Helper\Utility::loadAsset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ \App\Helper\Utility::loadAsset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ \App\Helper\Utility::loadAsset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<style>
  small {
    font-size: 18px;
    font-weight: 400;
    color: #012970;
    font-family: "Nunito", sans-serif;
  }
</style>
<body>
  <!-- Login 4 - Bootstrap Brain Component -->
  <section class="p-3 p-md-4 p-xl-5">
    <div class="container">
      <div class="card border-light-subtle shadow-sm">
        <div class="row g-0">
          <div class="col-12 col-md-6">
            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="https://asset.kompas.com/crops/Z51PEdmxXNtVVPCpYaIxAxCxn3w=/0x0:1000x667/1200x800/data/photo/2017/11/25/23922087452.jpg" alt="BootstrapBrain Logo">
          </div>
          <div class="col-12 col-md-6">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
                <div class="col-12">
                  <div class="mb-5">
                    <h3>Log in</h3>
                    {{ \App\Helper\Utility::showNotif() }}
                  </div>
                </div>
              </div>
              <form action="{{route('login.dologin')}}" method="post">
                @csrf
                <div class="row gy-3 gy-md-4 overflow-hidden">
                  <div class="col-12">
                    <label for="email" class="form-label">Email/Username<span class="text-danger">*</span></label>
                    <input class="form-control" name="email" id="email" required>
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" value="" required>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn bsb-btn-xl btn-primary" type="submit">Masuk</button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-12">
                  <hr class="mt-5 mb-4 border-secondary-subtle">
                  <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                    <a href="{{route('register.index')}}" class="link-secondary text-decoration-none">Buat Akun Baru</a>
                    <!-- <a href="#" class="link-secondary text-decoration-none">Forgot password</a> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  @stack('scripts')
  <script>

</script>
</body>

</html>