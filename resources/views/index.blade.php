@extends('template')
 
@section('css')
<style>
    /*page 1*/
.form-input{
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
.form-input::placeholder{
    color: grey;
    font-size: .79rem;
}
.grid{
    display: grid;
    grid-template-columns: repeat(2, minmax(10vmax, 1fr));
    grid-gap: 50px;
    padding: 10px;
}
.box{
    background: var(--primary);
    padding: min(8vmax, 80px) 0;
    font-size: 22px;
    color: white;
    opacity: .8;
    border-radius: 10px;
}
.box--icon{
    font-size: 54px;
    margin-bottom: 20px;
}

.section1{
    background-image: url("{{ \App\Helper\Utility::loadAsset('img/background.jpeg') }}");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 60vh;
    /* padding: 100px 0; */
}
.section1__content{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.section1__wrapper{
    max-width: 800px;
    flex-grow: 1;
}
.section1__content--vertical{
    display: flex;
    flex-direction: column;
}
.section1__content--credit{
    margin-top: 2vmin;
    & span{        
        float: right;
        color: white;
        background: #21760c;
        width: fit-content;
        padding: 0.3rem 1rem;
        border-radius: 1rem;
        font-size: clamp(0.4rem, (0.4rem + 20vmax), 1rem);
    }
}
.section1__content--horizontal{
    display: flex;
    flex-direction: row;
}
.section1__content--heading{
    font-size: 38px;
    text-align: center;
    color: white;
}
.section1__content--box{
    height: var(--height-input);
    font-size: 20px;
    color: var(--primary);
    padding-right: 15px;
    border-top-right-radius: var(--height-input);
    border-bottom-right-radius: var(--height-input);
    justify-content: center;
    background-color: white;
}
.section2{
    padding: 50px 0;
    text-align: center;
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
    <section class="section2">
        <div class="container">
            <h3>tujuan utama dari aplikasi ini adalah untuk mengedukasi dan mengidentifikasi ikan yang sering ditemukan di lingkungan sekitar, namun diharapkan juga dapat menarik dan bermanfaat bagi orang lain dalam penelitian ini lebih lanjut.</h3>
            <div class="grid">
                <a href="{{ route('familyguide') }}" class="box">
                    <i class="box--icon fas fa-fish"></i>
                    <p>Family Guide</p>
                </a>
                <a href="#" class="box">
                    <i class="box--icon fas fa-list"></i>
                    <p>Species List</p>
                </a>
            </div>
        </div>
    </section>
@stop

@section('script')
<script>
    $(document).ready(function () {
        const kredit = 0;
        const isMember = 0;

        var nameInput = document.getElementById('nameInput');
        var selectFile = document.getElementById('selectFile');
        var fileInput = document.getElementById('fileInput');

        selectFile.addEventListener('click', function (e) {
            e.preventDefault();
            if(kredit>0){
                const file = document.querySelector('#fileInput');
                file.value = '';
                fileInput.click();
            } else{
                alert(isMember? "Sisa kredit anda sudah 0 kredit untuk pemakaian bulan ini. perbaharui langganan aplikasi ke lebih yang tinggi!" : "Sisa kredit gratis anda sudah 0 kredit. ayo langganan aplikasi kami!");
            }
        });

        fileInput.addEventListener('change', function () {
            // console.log('File selected:', fileInput.files[0].name);
            let dataForm = new FormData();
            if(fileInput.files.length){
                dataForm.append("image",fileInput.files[0]);
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
                success: function (response) {
                    console.log(response);
                    if(response?.status!=="ok"){
                        alert(response.message);
                    } else{
                        const data = response?.data??null;
                        let url = `{{route('searchv2',['klasifikasi'=>'?'])}}`;
                        window.location.replace(url.replace('?',data));
                    }
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true);
                    listIkan.html(content);
                }
            });
        });

        nameInput.addEventListener('keydown', function (event) {
            if (event.keyCode === 13) {
                var inputValue = nameInput.value;
                let url = `{{route('search',['spesies'=>'?'])}}`;
                window.location.replace(url.replace('?',inputValue));
                // console.log('Input value on Enter:', inputValue);
            }
        });
    });
</script>
@stop