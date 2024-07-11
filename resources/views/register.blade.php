@extends('template')

@section('css')
<style>
.select2-container--bootstrap-5 .select2-selection--multiple{
  border-radius: var(--bs-border-radius-pill) !important;
  width: max-content;
}
.select2-container--bootstrap-5 .select2-selection--single{
  border-radius: var(--bs-border-radius-pill) !important;
  width: max-content;
}
.btn-custom-primary {
    max-width: 100% !important;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<section style="min-height: 100vh;" class="bg-hero position-relative">
    <div class="position-absolute top-50 start-50 translate-middle">
      <h1 class="text-primary text-login">Fishiden</h1>
    </div>
    <div style="min-height: 100vh;" class="bg-overlay-2 vstack align-items-center justify-content-center">
      <div class="bg-glass w-50 my-4 p-3 p-md-4 rounded-3 text-white">
        <div class="text-center">
          <h3>Register</h3>
          {{ \App\Helper\Utility::showNotif() }}
        </div>
        <div class="spacer-24"></div>
        <form id="form" action="{{route('register.store')}}" method="post">
          @csrf
          <div class="mb-3 has-validation">
            <label for="exampleInputEmail1" class="form-label">Email address <span class="text-danger">*</span></label>
            <input type="text" name="email" value="{{old('email')}}" class="form-control rounded-pill @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" value="{{old('password')}}" class="form-control rounded-pill @error('password') is-invalid @enderror" id="exampleInputPassword1">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3 has-validation">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nama" value="{{old('nama')}}" class="form-control rounded-pill @error('nama') is-invalid @enderror">
            @error('nama')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3 has-validation">
            <label class="form-label">Instansi <span class="text-danger">*</span></label>
            <input type="text" name="instansi" value="{{old('instansi')}}" class="form-control rounded-pill @error('instansi') is-invalid @enderror">
            @error('instansi')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3 has-validation">
            <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" name="pekerjaan" value="{{old('pekerjaan')}}" class="form-control rounded-pill @error('pekerjaan') is-invalid @enderror">
            @error('pekerjaan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3 has-validation">
            <label class="form-label">Bidang Keahlian</label>
            <input type="text" name="bidang_keahlian[]" id="bidang_keahlian" class="form-control rounded-pill @error('bidang_keahlian') is-invalid @enderror" multiple="multiple">
            @error('bidang_keahlian')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3 has-validation">
            <label class="form-label">Negara <span class="text-danger">*</span></label>
            <select name="negara" id="negara" class="form-control rounded-pill @error('negara') is-invalid @enderror"></select>
            @error('negara')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="spacer-24"></div>
          <button type="submit" class="btn-custom-primary w-100 mb-2">Daftar</button>
          <a href="{{route('home')}}" class="btn-custom-primary bg-danger w-100 mb-3">Batal</a>
          <div class="text-center">
            Sudah memiliki akun? <a class="text-primary fw-bold text-decoration-none" href="{{route('login.index')}}">Login</a>
          </div>
        </form>
      </div>
      <!-- <div class="text-center mt-3 text-white">
        <span>Copyright 2024 Fishiden</span>
      </div> -->
    </div>
  </section>
@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script>
  $(document).ready(function() {
    setTimeout(function() {
        if ($(".alert").length) {
            $(".alert").alert('close');
        } else {
            console.log("No alert element found.");
        }
    }, 2000);

    function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        var optionWithImage = $(
            '<span><img src="' + option.flag + '" class="img-flag" style="width:45px"/> ' + option.text + '</span>'
        );
        return optionWithImage;
    }
    let list_keahlian = [
        {
            id:"accountancy",
            text:"accountancy",
        },
        {
            id:"education",
            text:"education",
        },
        {
            id:"IT",
            text:"IT",
        },
        {
            id:"social care",
            text:"social care",
        }, 
        {
            id:"financial services",
            text:"financial services",
         }, 
        {
            id:"engineering",
            text:"engineering",
        },
        {
            id:"business support",
            text:"business support",
        }, 
        {
            id:"healthcare",
            text:"healthcare",
        },
        {
            id:"construction",
            text:"construction",
        },
        {
            id:"property",
            text:"property",
        },
        {
            id:"sales",
            text:"sales",
        },
    ];
    let selected = {!! json_encode(old('bidang_keahlian',[])) !!}
    const selectedFormat = selected.map((value) => ({
        "id":value,
        "text":value,
    }));
    const list_keahlian_merge = list_keahlian.concat(selectedFormat);
    const list_keahlian_unique = Array.from(new Set(list_keahlian_merge.map(a => a.id))).map(id => list_keahlian_merge.find(a => a.id === id));
    
    $.ajax({
        type: "GET",
        url: `{{route('select2.negara.list')}}`,
        data: {},
        dataType: 'json',
        accepts: 'json',    
        success: function (r1) {
            $("#negara").select2({
              theme: 'bootstrap-5',
              data: r1,
              placeholder: "Masukkan negara asal",
              templateResult: formatOption,
              templateSelection: formatOption,
            }).val(`{{old('negara')}}`).trigger("change");
        }
    });

    $("#bidang_keahlian").select2({
        theme: 'bootstrap-5',
        data: list_keahlian_unique,
        tags: true,
        placeholder: "Masukkan bidang keahlian",
    }).val(selected).trigger("change");
});
</script>
@stop