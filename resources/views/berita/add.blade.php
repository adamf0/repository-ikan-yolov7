@extends('template_admin')
 
@section('page-title')
    <x-page-title title="Berita">
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
            <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </x-page-title>
@stop

@section('content') 
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    {{ \App\Helper\Utility::showNotif() }}
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('berita.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="scrapping" value="{{old('scrapping',0)}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Url</label>
                                            <i class="bi bi-info-circle-fill text-primary" data-bs-toggle="tooltip" title="isi url dan jangan input judul/deskripsi manual maka berita akan mengarah ke url bukan sebagai tulisan sendiri"></i>  
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="url" placeholder="Masukkan url website..." value="{{old('url')}}">
                                                <button class="btn btn-primary btn-scrapping" type="button">
                                                    <i class="bi bi-box-arrow-down text-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Kategori</label>
                                            <input type="text" class="form-control" name="kategori" placeholder="Masukkan kategori..." value="{{old('kategori')}}">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" name="judul" placeholder="Masukkan judul..." value="{{old('judul')}}">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="editor" rows="10" cols="40">{!! old('deskripsi') !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
    <script>
        $(document).ready(function () {
            let editor;
            
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            ClassicEditor
            .create( document.querySelector( '#editor' ), {
                ckfinder:{
                    uploadUrl:"{{route('api.ckeditor.upload',['_token'=>csrf_token()])}}"
                }
            } )
            .then(newEditor => {
                editor = newEditor;
            })
            .catch( error => {
                console.error( error );
            } );

            $('.btn-scrapping').click(function(e){
                e.preventDefault()
                console.log($('input[name="url"]').val())

                let headersList = {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                }

                let bodyContent = JSON.stringify({
                    "url":$('input[name="url"]').val()
                });

                let button = $(this);

                $.ajax({
                    type: "POST",
                    url: `{{ env("YOLO_URL","localhost")."/scrapping_google" }}`,
                    data: bodyContent,
                    headers:headersList,
                    dataType: 'json',
                    accepts: 'json',
                    beforeSend: function(){
                        button.html(`<div class="spinner-border text-white" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>`)
                    },
                    success: function (response) {
                        console.log(response)
                        if(response.status_code==200 && response.body.length>0){
                            $('input[name="judul"]').val(response.body[0].title)
                            editor.setData(response.body[0].description)
                            $('input[name="scrapping"]').val("1")
                        } else if(response.status_code!=200){
                            alert(response.message)
                        }
                    },
                    complete: function(){
                        button.html(`<i class="bi bi-box-arrow-down fs-5 text-white"></i>`)
                    },
                });
            });

            $('input[name="judul"], textarea[name="deskripsi"]').change(function(e){
                e.preventDefault()
                $('input[name="scrapping"]').val("0")
            });
        });
    </script>
@endpush