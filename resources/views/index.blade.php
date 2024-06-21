@extends('template')

@section('css')
<style>
    /*page 1*/
    .form-input {
        width: 100%;
        height: var(--height-input);
        background-color: white;
        border-top-left-radius: calc(var(--height-input)/2);
        border-end-start-radius: calc(var(--height-input)/2);
        border: 1px solid white;
        padding: 0 20px;
        font-size: 1rem;
        color: var(--primary);
    }

    .form-input::placeholder {
        color: grey;
        font-size: .79rem;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(10vmax, 1fr));
        grid-gap: 50px;
        padding: 10px;
    }

    .box {
        background: var(--primary);
        padding: min(8vmax, 80px) 0;
        font-size: 22px;
        color: white;
        opacity: .8;
        border-radius: 10px;
    }

    .box--icon {
        font-size: 54px;
        margin-bottom: 20px;
    }

    .section1 {
        background-image: url("{{ \App\Helper\Utility::loadAsset('img/background.jpeg') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 60vh;
        /* padding: 100px 0; */
    }

    .section1__content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .section1__wrapper {
        max-width: 800px;
        flex-grow: 1;
    }

    .section1__content--vertical {
        display: flex;
        flex-direction: column;
    }

    .section1__content--credit {
        margin-top: 2vmin;

        & span {
            float: right;
            color: white;
            background: #21760c;
            width: fit-content;
            padding: 0.3rem 1rem;
            border-radius: 1rem;
            font-size: clamp(0.4rem, (0.4rem + 20vmax), 1rem);
        }
    }

    .section1__content--horizontal {
        display: flex;
        flex-direction: row;
    }

    .section1__content--heading {
        font-size: clamp(.8rem, .8rem + 4vmax, 2.4rem);
        text-align: center;
        color: white;
    }

    .section1__content--box {
        height: var(--height-input);
        font-size: 20px;
        color: var(--primary);
        padding-right: 15px;
        border-top-right-radius: var(--height-input);
        border-bottom-right-radius: var(--height-input);
        justify-content: center;
        background-color: white;
    }

    .section2 {
        padding: 2rem 0;
        text-align: center;
    }

    .heading-content{
        font-size: clamp(.5rem, .5rem + 4vmax, 4rem);
    }
    .pengenalan {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
        width: 100%;
        padding: 0 6vmax;
    }

    .pengenalan>.box1 {
        flex: 1;
        min-width: min(100%, 20rem);

        & .card-image {
            width: 100%;
            height: min(70vmin, 27rem);
            background: url('{{\App\Helper\Utility::loadAsset("assets/img/fishiden.jpg")}}') no-repeat center;
            border-radius: 10%;
        }
    }

    .pengenalan>.box2 {
        flex: 2;
        min-width: min(100%, 30rem);

        & .penjelasan {
            display: flex;
            gap: 2rem;
            flex-direction: column;
            justify-content: center;
        }

        /* & .penjelasan>h1 {
            font-size: clamp(.5rem, .5rem + 4vmax, 4rem);
        } */

        & .penjelasan>p {
            font-size: clamp(1rem, .8rem + .85vmax, 2rem);
            text-align: justify;
        }
    }

    .keahlian{
        & p{
            font-size: clamp(1rem, .8rem + .85vmax, 2rem);
        }
    }

    .cara_kerja {
        /* & h1 {
            font-size: clamp(.5rem, .5rem + 4vmax, 4rem);
        } */

        @media (min-width: 945px) {

            .demo-card:nth-child(even) .head::after,
            .demo-card:nth-child(odd) .head::after {
                position: absolute;
                content: "";
                width: 0;
                height: 0;
                border-top: 15px solid transparent;
                border-bottom: 15px solid transparent;
            }

            .demo-card:nth-child(even) .head::before,
            .demo-card:nth-child(odd) .head::before {
                position: absolute;
                content: "";
                width: 9px;
                height: 9px;
                background-color: #bdbdbd;
                border-radius: 9px;
                box-shadow: 0px 0px 2px 8px #f7f7f7;
            }
        }

        /* Some Cool Stuff */
        .demo-card:nth-child(1) {
            order: 1;
        }

        .demo-card:nth-child(2) {
            order: 4;
        }

        .demo-card:nth-child(3) {
            order: 2;
        }

        .demo-card:nth-child(4) {
            order: 5;
        }

        .demo-card:nth-child(5) {
            order: 3;
        }

        .demo-card:nth-child(6) {
            order: 6;
        }

        .demo-card-wrapper {
            position: relative;
            /* margin: auto; */
        }

        @media (min-width: 945px) {
            .demo-card-wrapper {
                display: flex;
                flex-flow: column wrap;
                /* width: 1170px; */
                height: 1150px;
                margin: 0 auto;
                align-items: center;
            }
        }

        .demo-card-wrapper::after {
            z-index: 1;
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            border-left: 1px solid rgba(191, 191, 191, 0.4);
        }

        @media (min-width: 945px) {
            .demo-card-wrapper::after {
                border-left: 1px solid #bdbdbd;
            }
        }

        .demo-card {
            position: relative;
            display: block;
            margin: 10px auto 40px;
            max-width: 84%;
            z-index: 2;
        }

        @media (min-width: 480px) {
            .demo-card {
                max-width: 60%;
                box-shadow: 0px 1px 22px 4px rgba(0, 0, 0, 0.07);
            }
        }

        @media (min-width: 720px) {
            .demo-card {
                max-width: 40%;
            }
        }

        @media (min-width: 945px) {
            .demo-card {
                max-width: 25vmax;
                /* height: 400px; */
                margin: 90px;
                margin-top: 45px;
                margin-bottom: 45px;
            }

            .demo-card:nth-child(odd) {
                margin-right: 45px;
            }

            .demo-card:nth-child(odd) .head::after {
                border-left-width: 15px;
                border-left-style: solid;
                left: 100%;
            }

            .demo-card:nth-child(odd) .head::before {
                left: 30.7vw;
                /* 491.5px */
            }

            .demo-card:nth-child(even) {
                margin-left: 45px;
                margin-top: 40px;
            }

            .demo-card:nth-child(even) .head::after {
                border-right-width: 15px;
                border-right-style: solid;
                right: 100%;
            }

            .demo-card:nth-child(even) .head::before {
                right: 30.7vw; 
                /* 489.5px */
            }

            .demo-card:nth-child(2) {
                margin-top: 180px;
            }
        }

        .demo-card .head {
            position: relative;
            display: flex;
            align-items: center;
            color: #fff;
            font-weight: 400;
            flex-wrap: wrap;
            justify-content: center;
            justify-items: center;
        }

        .demo-card .head .number-box {
            display: inline;
            float: left;
            margin: 15px;
            padding: 10px;
            font-size: 35px;
            line-height: 35px;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.17);
        }

        .demo-card .head h2 {
            flex-grow: 1;
            text-transform: uppercase;
            font-size: clamp(0.8rem, 0.8rem + 1vmax, 1.3rem);
            font-weight: inherit;
            letter-spacing: 2px;
            margin: 0;
            padding-bottom: 6px;
            line-height: 1rem;
            text-align: center;
        }

        .demo-card .head h2 span {
            display: block;
            font-size: 0.6rem;
            margin: 0;
        }

        @media (min-width: 480px) {
            .demo-card .head h2 span {
                font-size: 0.8rem;
            }
        }

        .demo-card .body {
            background: #fff;
            border: 1px solid rgba(191, 191, 191, 0.4);
            border-top: 0;
            padding: 15px;
        }

        @media (min-width: 945px) {
            .demo-card .body {
                height: auto;
            }
        }

        .demo-card .body p {
            font-size: clamp(0.5rem, 0.5rem + 2vmax, 1rem);
            line-height: 18px;
            margin-bottom: 15px;
        }

        .demo-card .body img {
            display: block;
            width: 100%;
        }

        .demo-card--step1 {
            background-color: #46b8e9;
        }

        .demo-card--step1 .head::after {
            border-color: #46b8e9;
        }

        .demo-card--step2 {
            background-color: #3ee9d1;
        }

        .demo-card--step2 .head::after {
            border-color: #3ee9d1;
        }

        .demo-card--step3 {
            background-color: #ce43eb;
        }

        .demo-card--step3 .head::after {
            border-color: #ce43eb;
        }

        .demo-card--step4 {
            background-color: #4d92eb;
        }

        .demo-card--step4 .head::after {
            border-color: #4d92eb;
        }

        .demo-card--step5 {
            background-color: #46b8e9;
        }

        .demo-card--step5 .head::after {
            border-color: #46b8e9;
        }
    }

    /*end page 1*/
</style>
@stop

@section('content')
<section class="section1">
    <div class="container section1__content">
        <div class="section1__wrapper section1__content--vertical">
            <h2 class="section1__content--heading">Cari Nama Ikan</h2>
            <div class="section1__content--horizontal">
                <input type="text" id="nameInput" class="form-input" placeholder="Masukkan nama ikan yang dicari">
                <a href="#" id="selectFile" class="section1__content--vertical section1__content--box">
                    <i class="fas fa-camera"></i>
                </a>
                <input type="file" id="fileInput" style="display:none;">
            </div>
            <!-- <div class="section1__content--credit">
                    <span>Sisa 3 kredit untuk klasifikasi menggunakan gambar</span>
                </div> -->
        </div>
    </div>
</section>
<section class="section2" id="apa_fishiden">
    <div class="container pengenalan">
        <div class="box1">
            <div class="card-image"></div>
        </div>
        <div class="box2">
            <div class="penjelasan">
                <h1 class="heading-content">Apa itu Fishiden?</h1>
                <p>Indonesia tercatat memiliki 1.248 jenis ikan air tawar dan 3.476 jenis ikan laut (9% dari jumlah jenis dunia). Fishiden adalah sistem inovatif yang menggunakan AI untuk mengidentifikasi dan mengklasifikasi ikan air tawar dan air laut asli Indonesia. Selain itu, Fishiden memberikan informasi status dan upaya konservasi serta menyajikan data genom setiap species teridentifikasi yang bisa digunakan dalam proses pembelajaran.</p>
            </div>
        </div>
    </div>
</section>
<section class="section2" id="cara_kerja">
    <div class="container cara_kerja">
        <h1 class="heading-content">Cara Kerja</h1>
        <div class="demo-card-wrapper">
            <div class="demo-card demo-card--step1">
                <div class="head">
                    <div class="number-box">
                        <span>01</span>
                    </div>
                    <h2>
                        <!-- <span class="small">Subtitle</span> -->
                        foto pengamatan
                    </h2>
                </div>
                <div class="body">
                    <img src="https://onthewater.com/wp-content/uploads/2019/12/TakeBetterPhonePhotos.jpg" alt="ambil foto pengamatan">
                    <p>ambil foto pengamatan anda dengan di ponsel / kamera anda. pastikan gambar tidak blur dan ikan yang berasal dari perairan indonesia.</p>
                </div>
            </div>

            <div class="demo-card demo-card--step2">
                <div class="head">
                    <div class="number-box">
                        <span>02</span>
                    </div>
                    <h2>
                        <!-- <span class="small">Subtitle</span>  -->
                        upload file
                    </h2>
                </div>
                <div class="body">
                    <img src="{{ \App\Helper\Utility::loadAsset('assets/img/upload_file.png') }}" alt="Graphic">
                </div>
            </div>

            <div class="demo-card demo-card--step3">
                <div class="head">
                    <div class="number-box">
                        <span>03</span>
                    </div>
                    <h2>
                        <!-- <span class="small">Subtitle</span>  -->
                        indentifikasi
                    </h2>
                </div>
                <div class="body">
                    <img src="https://static.vecteezy.com/system/resources/previews/008/516/508/non_2x/machine-learning-illustration-concept-vector.jpg" alt="Graphic">
                    <p>Tunggu hingga AI kami memerikan hasil pengenalan yang sesuai pembelajaran kami</p>
                </div>
            </div>

            <div class="demo-card demo-card--step4">
                <div class="head">
                    <div class="number-box">
                        <span>04</span>
                    </div>
                    <h2>
                        <!-- <span class="small">Subtitle</span>  -->
                        hasil indentifikasi
                    </h2>
                </div>
                <div class="body">
                    <img src="{{ \App\Helper\Utility::loadAsset('assets/img/hasil.png') }}" alt="Graphic">
                    <p>Dan anda mendapatkan informasi ikan</p>
                </div>
            </div>

            <div class="demo-card" style="background: transparent;box-shadow: 0px 1px 22px 4px transparent;height: 0px !important;"></div>
        </div>
    </div>
</section>
<section class="section2" id="keahlian">
    <div class="container pengenalan">
        <div class="box2">
            <div class="penjelasan">
                <h1 class="heading-content">Keahlian</h1>
                <p>Tim ahli kami mengonfigurasi dan menggunakan Fishiden untuk mengatasi tantangan identifikasi dan pemrosesan data unik yang dihadapi oleh pengguna. Kami menyediakan solusi khusus yang memungkinkan pengguna untuk membuat keputusan yang tepat berdasarkan data yang dapat diandalkan dan komprehensif. Fishiden merupakan pilot project yang memungkinkan untuk terus dikembangkan. Namun demikian struktur database (karakteristik, taksonomi, data genom, stratus konservasi, dan upaya konservasi) sama dengan data sebenarnya</p>
            </div>
        </div>
        <div class="box1">
            <div class="card-image" style="background: url('https://img.freepik.com/premium-vector/artificial-intelligence-technology-concept-with-robot-head_7547-645.jpg'); background-position: center; background-size: 100% 100%;"></div>
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