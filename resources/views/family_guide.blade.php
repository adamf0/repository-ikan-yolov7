@extends('template')
 
@section('css')
<style>
/*page 2*/
*{
    --primary: #136c72;
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

.section2{
    /* padding: 50px 0; */
    text-align: left;
}

.content__section--grid{
    display: grid;
    grid-template-columns: 1fr;
    grid-row-gap: 10px;

    & .panel{
        height: 15vmax;
        background: var(--primary);
        opacity: .7;
        display: flex;
        justify-content: center;
        align-items: center;
        
        & h3{
            font-size: 1.7rem;
            color: white;
        }
    }
    & .panel__content{
        width: 100%;
        margin: 0 auto;
        position: relative;

        & .panel__filter{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;

            & label{
                font-size: 1rem;
                text-transform: capitalize;
                color: var(--primary);
            }
            & * + *{
                margin-left: 10px;
            }
            & .panel__filter__component{
                /* flex-grow: 1; */
                text-align: center;
                display: grid;
                grid-template-rows: 1fr;
            }
        }
    }

    .listview__card{
        display: grid;
        grid-template-columns: repeat(1, minmax(45vmin, 1fr));
        grid-auto-rows: 1fr;
        gap: 10px;
        margin-bottom: 20px;
    }
    :is(.not_found, .loading){
        grid-column: span 1;
        margin: auto;
        text-align: center;
    }
    .list__item{
        width: 100%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        padding: 20px 10px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
    }
    .list__item :where(h3){
        width: 100%;
        text-align: center;
        color: var(--primary);
        text-transform: capitalize;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        /* display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2; */
    }
    .list__item :where(h3):hover {
        overflow: visible;
        white-space: normal;
        /* position: relative; */
    }
    .list__item :where(img){
        aspect-ratio: 1 / 1;
    }
    @media (min-width:320px){
        .listview__card{
            grid-template-columns: repeat(2, minmax(45vmin, 1fr));
        }
        :is(.not_found, .loading){
            grid-column: span 2;
        }
    }
    @media (min-width:850px){
        .listview__card{
            grid-template-columns: repeat(3, minmax(45vmin, 1fr));
        }
        :is(.not_found, .loading){
            grid-column: span 3;
        }
    }
    @media (min-width:1100px){
        .listview__card{
            grid-template-columns: repeat(4, minmax(45vmin, 1fr));
        }
        :is(.not_found, .loading){
            grid-column: span 4;
            place-items: center;
        }
    }
}

.select2.select2-container.select2-container--bootstrap-5{
    min-width: 25vmin;
}
.select2.select2-container.select2-container--bootstrap-5.select2-container--below.select2-container--focus{
    width: 100% !important;
    min-width: 25vmin;
}
.selection{
    display: none;
}
/*end page 2*/
</style>
@stop

@section('content')
<section class="section2">
        <div class="content__section--grid">
            <div class="panel">
                <h3>Family Guide</h3>
            </div>
            <div class="panel__content">
                <div class="panel__filter">
                    <div class="panel__filter__component">
                        <label for="fillum">Fillum</label>
                        <select name="fillum" id="fillum" class="form-control">
                        </select>
                    </div>
                    <div class="panel__filter__component">
                        <label for="super_kelas">Super Kelas</label>
                        <select name="super_kelas" id="super_kelas" class="form-control">
                        </select>
                    </div>
                    <div class="panel__filter__component">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                        </select>
                    </div>
                    <div class="panel__filter__component">
                        <label for="ordo">Ordo</label>
                        <select name="ordo" id="ordo" class="form-control">
                        </select>
                    </div>
                    <div class="panel__filter__component">
                        <label for="famili">Famili</label>
                        <select name="famili" id="famili" class="form-control">
                        </select>
                    </div>
                    <div class="panel__filter__component">
                        <label for="genus">Genus</label>
                        <select name="genus" id="genus" class="form-control">
                        </select>
                    </div>
                    <div class="panel__filter__component">
                        <label for="spesies">Spesies</label>
                        <select name="spesies" id="spesies" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            <div class="container listview__card" id="listIkan">
                <!-- <a href="search.html" class="list__item">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/hero-img.jpg') }}" alt="gambar ikan">
                    <h3>nama ikan</h3>
                </a>
                <a href="search.html" class="list__item">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/hero-img.jpg') }}" alt="gambar ikan">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem voluptatibus asperiores sint ipsa nobis ipsam ut excepturi blanditiis saepe cumque!</h3>
                </a>
                <a href="search.html" class="list__item">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/hero-img.jpg') }}" alt="gambar ikan">
                    <h3>nama ikan</h3>
                </a>
                <a href="search.html" class="list__item">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/hero-img.jpg') }}" alt="gambar ikan">
                    <h3>nama ikan</h3>
                </a>
                <a href="search.html" class="list__item">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/hero-img.jpg') }}" alt="gambar ikan">
                    <h3>nama ikan</h3>
                </a>
                <a href="search.html" class="list__item">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/hero-img.jpg') }}" alt="gambar ikan">
                    <h3>nama ikan</h3>
                </a>
                <a href="search.html" class="list__item">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/hero-img.jpg') }}" alt="gambar ikan">
                    <h3>nama ikan</h3>
                </a> -->

                <!-- <div class="not_found">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/search_fish.jpeg') }}" alt="search fish" width="500">
                    <h3>Sedang Mencari Ikan...</h3>
                </div> -->

                <!-- <div class="not_found">
                    <img src="{{ \App\Helper\Utility::loadAsset('img/fish_not_foundv2.png') }}" alt="data empty" width="500">
                    <h3>Tidak ditemukan ikan sesuai kriteria</h3>
                </div> -->
            </div>
        </div>
    </section>
@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function load_dropdown(element, local=null, url, selected=null, placeholder=false, parent=null){
        if(local!=null){
            if(placeholder){
                local.unshift({
                    id: '',
                    text: placeholder
                });
            }

            $(element).select2({
                theme: 'bootstrap-5',
                dropdownParent: parent,
                data: local??[]
            }).val(selected).trigger("change");
        } else{
            $.ajax({
                type: "GET",
                url: url,
                data: {},
                dataType: 'json',
                accepts: 'json',    
                success: function (r1) {
                    // console.log(selected);
                    if(placeholder){
                        r1.unshift({
                            id: '',
                            text: placeholder
                        });
                    }
                    // console.log(r1);
                    $(element).select2({
                        theme: 'bootstrap-5',
                        dropdownParent: parent,
                        data: r1
                    }).val(selected).trigger("change");
                }
            });
        }
    }
    const errorHandlers = {
        0: () => 'Tidak ada koneksi atau terjadi kesalahan jaringan.',
        400: () => 'Permintaan tidak valid.',
        401: () => 'Akses tidak diizinkan.',
        403: () => 'Akses ditolak.',
        404: () => 'Halaman tidak ditemukan.',
        500: () => 'Kesalahan server internal.',
        502: () => 'Gateway atau proxy bermasalah.',
        503: () => 'Layanan tidak tersedia.',
        504: () => 'Waktu koneksi habis.',
        timeout: () => 'Request timeout.',
        parsererror: () => 'Kesalahan parsing permintaan JSON.',
        abort: () => 'Permintaan Ajax dibatalkan.',
        default: (error) => 'Kesalahan tidak teridentifikasi: ' + error,
    };
    let searchRequest = null;

    function handleAjaxError(xhr, status, error, displayConsole = true, url=null) {
        const errorHandler = errorHandlers[xhr.status] || errorHandlers[status] || errorHandlers.default;
        if(displayConsole) console.log(errorHandler(error));
        else return `${errorHandler(error)} pada url ${url}`;
    }

    const loading =`<div class="not_found">
                        <img src="{{ \App\Helper\Utility::loadAsset('img/search_fish.jpeg') }}" alt="search fish" width="500">
                        <h3>Sedang Mencari Ikan...</h3>
                    </div>`;
    const not_found=`<div class="not_found">
                        <img src="{{ \App\Helper\Utility::loadAsset('img/fish_not_foundv2.png') }}" alt="data empty" width="500">
                        <h3>Tidak ditemukan ikan sesuai kriteria</h3>
                    </div>`;
    function generateCard(data){
        let url = `{{route('search',['spesies'=>'?'])}}`;
        return `<a href="${url.replace('?',data.spesies)}" class="list__item">
                    <img src="${data.foto}" alt="gambar ikan">
                    <h3>${data.spesies}</h3>
                </a>`;
    }
    function load(dataForm = new FormData()){
        if (searchRequest !== null) {
            searchRequest.abort();
        }

        listIkan.empty();
        listIkan.html(loading);

        let content = '';
        searchRequest = $.ajax({
            type: "POST",
            url: `{{route('api.familyguide.list')}}`,
            data: dataForm,
            dataType: 'json',
            accepts: 'json',
            processData: false,
            contentType: false,
            // type: 'POST',
            success: function (response) {
                listIkan.empty();
                const datas = (response??[]);
                console.log(datas);

                if(datas.length){
                    $.each(datas, function(i, data) {
                        content += generateCard(data);
                    });
                } else{
                    content = not_found;
                }
                listIkan.html(content);
            },
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error, true);
                content = not_found;
                listIkan.html(content);
            }
        });
    }
    function formDataToObject(formData) {
        let object = {};
        formData.forEach(function(value, key){
            object[key] = value;
        });
        return object;
    }

    $(document).ready(function(){
        listIkan        = $("#listIkan");

        let dataForm = new FormData();
        dataForm.append("fillum",null)
        dataForm.append("super_kelas",null)
        dataForm.append("kelas",null)
        dataForm.append("ordo",null)
        dataForm.append("famili",null)
        dataForm.append("genus",null)
        dataForm.append("spesies",null)
        // load(dataForm)

        const listDropdown = [
            {
            "id":"#fillum",
                "next_id":"#super_kelas",
                "reset":[
                    "#super_kelas",
                    "#kelas",
                    "#ordo",
                    "#famili",
                    "#genus",
                    "#spesies",
                ],
                "source":`{{route('api.familyguide.listDropdown')}}`,
                "placeholder":"-- Pilih --",
            },
            {
                "id":"#super_kelas",
                "next_id":"#kelas",
                "reset":[
                    "#kelas",
                    "#ordo",
                    "#famili",
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"-- Pilih --",
            },
            {
                "id":"#kelas",
                "next_id":"#ordo",
                "reset":[
                    "#ordo",
                    "#famili",
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"-- Pilih --",
            },
            {
                "id":"#ordo",
                "next_id":"#famili",
                "reset":[
                    "#famili",
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"-- Pilih --",
            },
            {
                "id":"#famili",
                "next_id":"#genus",
                "reset":[
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"-- Pilih --",
            },
            {
                "id":"#genus",
                "next_id":"#spesies",
                "reset":[
                    "#spesies",
                ],
                "source":[],
                "placeholder":"-- Pilih  --",
            },
            {
                "id":"#spesies",
                "next_id":null,
                "reset":[],
                "source":[],
                "placeholder":"-- Pilih --",
            },
        ];
        listDropdown.forEach(dropdown => {
            // console.log(dropdown.id, dropdown.source)
            const placeholder = dropdown.placeholder
            load_dropdown(
                dropdown.id, 
                dropdown.source instanceof Array? dropdown.source:null, 
                dropdown.source instanceof Array? null:`{{route('api.familyguide.listDropdown')}}`, 
                null, 
                placeholder
            );

            $(dropdown.id).on('change', function(e) {
                let id = $(this).val();
                let selectedData = $(this).select2('data');
                selectedData = selectedData.length==0? null:selectedData[0]
                
                dropdown.reset.forEach(dropdownReset => {
                    dataForm.set(dropdownReset.replace("#",""),null);
                    $(dropdownReset).empty()
                    load_dropdown(
                        dropdownReset, 
                        [], 
                        null, 
                        null, 
                        placeholder
                    );
                })

                const ref = dropdown.id.replace("#","")
                dataForm.set(ref,id);
                load_dropdown(
                    dropdown.next_id, 
                    selectedData?.list??[], 
                    null, 
                    null, 
                    dropdown.placeholder
                );

                load(dataForm)
            });
        })
        
    });
</script>
@stop