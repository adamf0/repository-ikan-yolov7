@extends('template')

@section('css')
<style>

</style>
@stop

@section('content')
<!-- Hero Khusus Homepage-->

<section class="bg-hero">
    <div class="bg-overlay">
        <div class="spacer-header"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">AI Indentifikasi dan
                        Klasifikasi
                        ikan air tawar dan air laut asli Indonesia.</h1>
                    <div class="rounded-pill p-2 shadow bg-white mt-3">
                        <div class="hstack g-2">
                            <input class="form-control form-control border border-0 rounded-pill" type="text" id="nameInput" placeholder="Masukan nama ikan yang dicari" aria-label="" value="">
                            <input type="file" id="fileInput" style="display:none;">
                            <a href="#" id="selectFile" class="d-flex align-items-center justify-content-center text-decoration-none mx-2">
                                <span class="material-symbols-rounded fs-2">
                                    add_a_photo
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <div class="spacer"></div>
    </div>
</section>

<!-- About -->

<section id="about" class="bg-dark text-light py-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12 col-md-6">
                <img src="{{\App\Helper\Utility::loadAsset('assets/img/bg-fishiden-1.png')}}" alt="" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-12 col-md-6">
                <h3 class="text-heading">Apa itu Fishiden ?</h3>
                <div class="spacer-24"></div>
                <p class="mb-0">Indonesia tercatat memiliki 1.248 jenis ikan air tawar dan 3.476 jenis ikan laut (9%
                    dari jumlah
                    jenis dunia). Fishiden adalah sistem inovatif yang menggunakan AI untuk mengidentifikasi dan
                    mengklasifikasi ikan air tawar dan air laut asli Indonesia. Selain itu, Fishiden memberikan
                    informasi status dan upaya konservasi serta menyajikan data genom setiap species teridentifikasi
                    yang bisa digunakan dalam proses pembelajaran.</p>
            </div>
        </div>
    </div>
</section>

<!-- Cara Kerja -->

<section id="carakerja" class="bg-water">
    <div class="bg-overlay-2 py-5 text-light">
        <div class="container">
            <div class="d-flex justify-content-center mb-3">
                <h3 class="text-heading">Cara Kerja</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="step completed">
                        <div class="v-stepper">
                            <div class="circle">
                                01
                            </div>
                            <div class="line"></div>
                        </div>

                        <div class="content">
                            <div class="rounded-4 bg-glass p-2 mb-3">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <img src="{{\App\Helper\Utility::loadAsset('assets/img/cara-kerja-1.jpg')}}" alt="" class="img-fluid rounded-3">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="py-2">
                                            <h5 class="mb-3">FOTO PENGAMATAN</h5>
                                            <p class="mb-0">
                                                Ambil foto pengamatan anda dengan di ponsel / kamera anda. pastikan
                                                gambar
                                                tidak blur dan ikan yang berasal dari perairan indonesia.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="step completed">
                        <div class="v-stepper">
                            <div class="circle">
                                02
                            </div>
                            <div class="line"></div>
                        </div>

                        <div class="content">
                            <div class="rounded-4 bg-glass p-2 mb-3">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <img src="{{\App\Helper\Utility::loadAsset('assets/img/cara-kerja-2.jpg')}}" alt="" class="img-fluid rounded-3">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="py-2">
                                            <h5 class="mb-3">UPLOAD FILE</h5>
                                            <p class="mb-0 py-2">
                                                Pilih icon ambil gambar pada kolom pencarian.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="step completed">
                        <div class="v-stepper">
                            <div class="circle">
                                03
                            </div>
                            <div class="line"></div>
                        </div>

                        <div class="content">

                            <div class="rounded-4 bg-glass p-2 mb-3">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <img src="{{\App\Helper\Utility::loadAsset('assets/img/cara-kerja-3.jpg')}}" alt="" class="img-fluid rounded-3">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="py-2">
                                            <h5 class="mb-3">PROSES INDENTIFIKASI</h5>
                                            <p class="mb-0">
                                                Tunggu hingga AI kami memerikan hasil pengenalan yang sesuai
                                                pembelajaran
                                                kami.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="step completed">
                        <div class="v-stepper">
                            <div class="circle">
                                04
                            </div>
                            <div class="line"></div>
                        </div>

                        <div class="content">

                            <div class="rounded-4 bg-glass p-2">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <img src="{{\App\Helper\Utility::loadAsset('assets/img/bg-fishiden-1.png')}}" alt="" class="img-fluid rounded-3">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="py-2">
                                            <h5 class="mb-3">HASIL INDENTIFIKASI</h5>
                                            <p class="mb-0">
                                                Hasil identifikasi akan memberikan anda informasi ikan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Keahlian -->

<section id="keahlian" class="bg-dark py-5 text-light">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12 col-md-6">
                <img src="{{\App\Helper\Utility::loadAsset('assets/img/bg-keahlian.jpg')}}" alt="" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-12 col-md-6">
                <h3 class="text-heading">Keahlian</h3>
                <div class="spacer-24"></div>
                <p class="mb-0">Tim ahli kami mengonfigurasi dan menggunakan Fishiden untuk mengatasi tantangan
                    identifikasi dan pemrosesan data unik yang dihadapi oleh pengguna. Kami menyediakan solusi
                    khusus yang memungkinkan pengguna untuk membuat keputusan yang tepat berdasarkan data yang dapat
                    diandalkan dan komprehensif. Fishiden merupakan pilot project yang memungkinkan untuk terus
                    dikembangkan. Namun demikian struktur database (karakteristik, taksonomi, data genom, stratus
                    konservasi, dan upaya konservasi) sama dengan data sebenarnya
                </p>
            </div>
        </div>
    </div>
</section>
@stop

@section('script')
<script>
    $(document).ready(function() {
        const kredit = 0;
        const isMember = 0;

        var nameInput = document.getElementById('nameInput');
        var selectFile = document.getElementById('selectFile');
        var fileInput = document.getElementById('fileInput');

        selectFile.addEventListener('click', function(e) {
            e.preventDefault();
            // if(kredit>0){
            const file = document.querySelector('#fileInput');
            file.value = '';
            fileInput.click();
            // } else{
            //     alert(isMember? "Sisa kredit anda sudah 0 kredit untuk pemakaian bulan ini. perbaharui langganan aplikasi ke lebih yang tinggi!" : "Sisa kredit gratis anda sudah 0 kredit. ayo langganan aplikasi kami!");
            // }
        });

        fileInput.addEventListener('change', function() {
            // console.log('File selected:', fileInput.files[0].name);
            let dataForm = new FormData();
            if (fileInput.files.length) {
                dataForm.append("image", fileInput.files[0]);
            }

            $.ajax({
                type: "POST",
                url: `{{route('api.klasifikasi.index')}}`,
                data: dataForm,
                dataType: 'json',
                accepts: 'json',
                processData: false,
                contentType: false,
                // type: 'POST',
                beforeSend: function(){
                    $('#selectFile').html(`<div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`)
                },
                success: function(response) {
                    console.log(response);
                    if (response?.status !== "ok") {
                        alert(response.message);
                    } else {
                        const data = response?.data ?? null;
                        let url = `{{route('searchv2',['klasifikasi'=>'?'])}}`;
                        window.location.replace(url.replace('?', data));
                    }
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true);
                    listIkan.html(content);
                },
                complete: function(){
                    $('#selectFile').html(`<span class="material-symbols-rounded fs-2">
                                    add_a_photo
                                </span>`)
                }
            });
        });

        nameInput.addEventListener('keydown', function(event) {
            if (event.keyCode === 13) {
                var inputValue = nameInput.value;
                let url = `{{route('search',['spesies'=>'?'])}}`;
                window.location.replace(url.replace('?', inputValue));
                // console.log('Input value on Enter:', inputValue);
            }
        });
    });
</script>
@stop