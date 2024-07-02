@extends('template')
 
@section('css')
<style>
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
</style>
@stop

@section('content')
<!-- Hero -->

<section class="bg-hero">
        <div class="bg-overlay">
            <div class="spacer-header"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">Gallery</h1>
                    </div>
                </div>
            </div>
            <div class="spacer"></div>
        </div>
    </section>

    <!-- Konten -->
    <section class="bg-dark text-light">
        <div class="container py-5">
            <div class="bg-glass rounded-3 p-3 mb-4">
                <h5 class="text-heading">Filter Gallery</h5>
                <hr>
                <div class="row g-2 row-cols-2 row-cols-sm-2 row-cols-md-auto justify-content-center">
                    <div class="col">
                        <select id="fillum" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col">
                        <select id="super_kelas" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col">
                        <select id="kelas" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col">
                        <select id="ordo" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col">
                        <select id="famili" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col">
                        <select id="genus" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col">
                        <select id="spesies" class="form-select form-select-sm">
                        </select>
                    </div>
                </div>
            </div>
            <div id="listIkan" class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-4">
                
            </div>
        </div>
    </section>
@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
<script>
    let searchRequest = null;

    const loading =`<div class="not_found">
                        <h3>Sedang Mencari Ikan...</h3>
                    </div>`;
    const not_found=`<div class="not_found">
                        <h3>Tidak ditemukan ikan sesuai kriteria</h3>
                    </div>`;
    function generateCard(data){
        let url = `{{route('search',['spesies'=>'?'])}}`;
        return `<div class="col">
                    <div class="bg-glass rounded-3 p-2 pb-3">
                        <img class="mb-3 rounded-2 img-fluid"
                            src="${data.foto}" alt="${data.spesies}">

                        <a href="${url.replace('?',data.spesies)}" class="stretched-link text-decoration-none text-light">
                            <div class="text-center">
                                ${data.spesies}
                            </div>
                        </a>
                    </div>
                </div>`;
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
                "element":$("#fillum"),
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
                "placeholder":"Fillum",
            },
            {
                "id":"#super_kelas",
                "element":$("#super_kelas"),
                "next_id":"#kelas",
                "reset":[
                    "#kelas",
                    "#ordo",
                    "#famili",
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"Super Kelas",
            },
            {
                "id":"#kelas",
                "element":$("#kelas"),
                "next_id":"#ordo",
                "reset":[
                    "#ordo",
                    "#famili",
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"Kelas",
            },
            {
                "id":"#ordo",
                "element":$("#ordo"),
                "next_id":"#famili",
                "reset":[
                    "#famili",
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"Ordo",
            },
            {
                "id":"#famili",
                "element":$("#famili"),
                "next_id":"#genus",
                "reset":[
                    "#genus",
                    "#spesies",
                ],
                "source":[],
                "placeholder":"Famili",
            },
            {
                "id":"#genus",
                "element":$("#genus"),
                "next_id":"#spesies",
                "reset":[
                    "#spesies",
                ],
                "source":[],
                "placeholder":"Genus",
            },
            {
                "id":"#spesies",
                "element":$("#spesies"),
                "next_id":null,
                "reset":[],
                "source":[],
                "placeholder":"Spesies",
            },
        ];
        listDropdown.forEach(dropdown => {
            // console.log(dropdown.id, dropdown.source)
            load_dropdown(
                dropdown.id, 
                dropdown.source instanceof Array? dropdown.source:null, 
                dropdown.source instanceof Array? null:`{{route('api.familyguide.listDropdown')}}`, 
                null, 
                dropdown.placeholder
            );

            dropdown.element.on('change', function(e) {
                let id = $(this).val();
                let selectedData = $(this).select2('data');
                const selectedData_ = selectedData.length==0? null:selectedData[0]
                
                const listReset = dropdown.reset;
                for (let index = 0; index < listReset.length; index++) {
                    const dropdownReset = listReset[index];
                    dataForm.set(dropdownReset.replace("#",""),null);
                    console.log(dropdownReset)
                    if ($(dropdownReset).hasClass("select2-hidden-accessible")) {
                        $(dropdownReset).select2("destroy") //ga jalan
                    }
                }

                const ref = dropdown.id.replace("#","")
                dataForm.set(ref,id);
                load_dropdown(
                    dropdown.next_id, 
                    selectedData_?.list??[], 
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