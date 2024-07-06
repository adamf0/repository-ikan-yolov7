@extends('template')
 
@section('css')
<style>
.select2.select2-container.select2-container--bootstrap-5{
    width: 150px !important;
}
@media (max-width: 1200px) {
    .select2.select2-container.select2-container--bootstrap-5{
        width: 100% !important;
    }
    .select2.select2-container.select2-container--bootstrap-5.select2-container--below.select2-container--focus{
        width: 100% !important;
    }

}
/* .select2.select2-container.select2-container--bootstrap-5.select2-container--below.select2-container--focus{
    width: 100% !important;
    min-width: 25vmin;
} */
/* .selection{
    display: none;
} */
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
                    <div class="col" style="flex-grow: 1; flex-wrap: wrap;">
                        <select data-placeholder="fillum" id="fillum" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col" style="flex-grow: 1; flex-wrap: wrap;">
                        <select data-placeholder="super kelas" id="super_kelas" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col" style="flex-grow: 1; flex-wrap: wrap;">
                        <select data-placeholder="kelas" id="kelas" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col" style="flex-grow: 1; flex-wrap: wrap;">
                        <select data-placeholder="ordo" id="ordo" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col" style="flex-grow: 1; flex-wrap: wrap;">
                        <select data-placeholder="famili" id="famili" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col" style="flex-grow: 1; flex-wrap: wrap;">
                        <select data-placeholder="genus" id="genus" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col" style="flex-grow: 1; flex-wrap: wrap;">
                        <select data-placeholder="spesies" id="spesies" class="form-select form-select-sm">
                        </select>
                    </div>
                    <div class="col  style="flex-grow: 1; flex-wrap: wrap;"hidden-md"></div>
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
                            src="${data.foto}" alt="${data.spesies}" loading="lazy">

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
                // console.log(datas);

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
        for (let i = 0; i < listDropdown.length; i++) {
            const dropdown = listDropdown[i];
            // console.log(dropdown.id, dropdown.source)
            
            const target = $(dropdown.id);

            if(dropdown.source instanceof Array){
                target.select2({
                    theme: 'bootstrap-5',
                    data: dropdown?.source??[]
                }).val('').trigger("change");
            } else{
                $.ajax({
                    type: "GET",
                    url: dropdown?.source,
                    data: {},
                    dataType: 'json',
                    accepts: 'json',    
                    success: function (r1) {
                        target.select2({
                            theme: 'bootstrap-5',
                            data: r1
                        }).val('').trigger("change");
                    }
                });
            }
        }
        for (let i = 0; i < listDropdown.length; i++) {
            const dropdown = listDropdown[i];

            dropdown.element.on('change', function(e) {
                let id = $(this).val();
                let selectedData = $(this).select2('data');
                const selectedData_ = selectedData.length==0? null:selectedData[0]
                
                const listReset = dropdown.reset;
                for (let index = 0; index < listReset.length; index++) {
                    const dropdownReset = listReset[index];
                    dataForm.set(dropdownReset.replace("#",""),null);
                    if ($(dropdownReset).hasClass("select2-hidden-accessible")) {
                        $(dropdownReset).empty()
                    }
                }

                const ref = dropdown.id.replace("#","")
                dataForm.set(ref,id);

                const next_target = $(dropdown.next_id);
                next_target.select2({
                    theme: 'bootstrap-5',
                    data: selectedData_?.list??[]
                }).val('').trigger("change"); 

                load(dataForm)
            });
        }        
    });
</script>
@stop