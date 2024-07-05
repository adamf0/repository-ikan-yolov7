@extends('template')

@section('css')
<style>
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: var(--bs-primary);
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: var(--bs-danger);
    }

    .layout-card {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(300px, 50vmax), 1fr));
        grid-auto-rows: 450px;
        gap: 1rem;
    }

    .custom-card {
        min-height: min(400px, 80vmin);
        height: 100%;
    }

    .stacked {
        display: grid;
        place-items: self-start;
        isolation: isolate;
        min-width: 10vmax;
        width: 100%;
    }

    .stacked>* {
        grid-column: 1/3;
        grid-row: 1/3;
    }

    .stacked>.dropdown {
        grid-column: 2 / 3;
        grid-row: 1 / 3;
    }

    .stacked>.media {
        width: 100% !important;
        height: 250px;
        z-index: -1;
    }

    .border>i {
        color: var(--bs-primary);
    }

    .border>span {
        color: 1.1rem;
        color: var(--bs-primary);
    }

    .border:hover {
        background-color: var(--bs-primary);
        opacity: 0.6;
        border-color: transparent !important;
    }

    .border:hover>i {
        color: white;
    }

    .border:hover>span {
        color: white !important;
    }

    .border-dotted {
        border-style: dashed !important;
        border-width: .2rem !important;
        border-color: var(--bs-primary) !important;
    }

    #spinner-body {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 2;
    }

    .carousel-item {
        max-width: 100%;
        max-height: 40vmax;
    }

    .carousel-inner {
        width: 70vmax;
    }

    .carousel-item>img {
        width: 100%;
    }

    ::-webkit-scrollbar {
        display: block;
        height: 3px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        /* background-color: transparent; */
        border-right: none;
        border-left: none;
    }

    ::-webkit-scrollbar-track-piece:end {
        background: transparent;
        margin-bottom: 10px;
    }

    ::-webkit-scrollbar-track-piece:start {
        background: transparent;
        margin-top: 0px;
    }

    .fs-6{
        font-size: clamp(0.4rem, 0.4rem + 1.1vmax, 1rem) !important;
    }
    .offcanvas-body {
        padding: var(--bs-offcanvas-padding-y) var(--bs-offcanvas-padding-x);
        overflow-y: auto;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@stop

@section('content')
    <div id="spinner-body" class="pt-5">
        <div class="spinner-border text-primary" role="status" style="position: absolute;top: 50%;">
        </div>
    </div>
    <input type="file" id="fileInput" multiple style="display:none;">

    <!-- Hero -->
    <section class="bg-hero">
        <div class="bg-overlay">
            <div class="spacer-header"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">Project </h1>
                    </div>
                </div>
            </div>
            <div class="spacer"></div>
        </div>
    </section>

    <!-- Konten -->
    <section class="bg-dark">
        <div class="container py-5">
            <div class="d-flex flex-column justify-content-between" style="min-height: calc(100vh - 11rem); gap: 2rem;">
                <div class="flex-grow-2 layout-card">
                    <button class="card custom-card border border-dotted d-flex justify-content-center align-items-center" id="newUpload">
                        <i class="bi bi-plus-lg fs-1"></i>
                        <span>Upload</span>
                    </button>
                    <div class="card custom-card placeholder-glow card-loading">
                        <div class="placeholder" style="height: -webkit-fill-available;"></div>
                    </div>
                </div>
                <div>
                    <div class="pagination-loading placeholder-glow" style="display: none;">
                        <div class="placeholder col-2" style="min-height: 2rem;"></div>
                    </div>
                    <ul class="pagination">
                        <li class="page-item pagination-prev disabled">
                            <button type="button" class="page-link pagination-prev-button">Previous</button>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <button type="button" class="page-link pagination-current" href="#">1</button>
                        </li>
                        <li class="page-item pagination-next disabled">
                            <button type="button" class="page-link pagination-next-button" href="#">Next</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="modal modal-xl fade" id="modalDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="status_konservasi">
                                <div class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                            <div class="row gy-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="bg-glass p-3 rounded-3">
                                        <h5 style="text-shadow: 2px 2px 4px #010351;" class="text-primary taksonomi_spesies  mb-3">
                                            <div class="placeholder-glow">
                                                <span class="placeholder col-12"></span>
                                            </div>
                                        </h5>
                                        <div class="text-center slider_gambar"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="text-heading">
                                        TAKSONOMI
                                    </h5>

                                    <table class="table text-light table-dark table-sm table-bordered table-striped table-hover font-small">
                                        <tr>
                                            <td>Kategori</td>

                                            <td class="taksonomi_kategori">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kingdom</td>

                                            <td class="taksonomi_kingdom">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fillum</td>

                                            <td class="taksonomi_fillum">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super Kelas</td>

                                            <td class="taksonomi_superkelas">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>

                                            <td class="taksonomi_kelas">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ordo</td>

                                            <td class="taksonomi_ordo">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Familia</td>

                                            <td class="taksonomi_familia">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Genus</td>

                                            <td class="taksonomi_genus">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Daerah</td>

                                            <td class="taksonomi_namadaerah">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pengarang</td>

                                            <td class="taksonomi_pengarang">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <h5 class="text-heading">
                                        ID GENOM
                                    </h5>
                                    <p style="word-wrap: break-word;" class="font-small id_genom">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                    </p>

                                    <h5 class="text-heading">
                                        INFORMASI DETAIL
                                    </h5>

                                    <table class="table text-light table-dark table-sm table-bordered table-striped table-hover font-small">
                                        <tr>
                                            <td>Kemunculan</td>

                                            <td class="info_kemunculan">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Panjang Maksimal</td>

                                            <td class="info_panjangmax">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Distribusi</td>

                                            <td class="info_distribusi">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Habitat</td>

                                            <td class="info_habitat">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Komentar</td>

                                            <td class="info_komentar">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="bg-glass rounded-3 p-3">
                                <div class="row gy-3">
                                    <div class="col-12 col-md-6 karakteristik">
                                        <h5 class="text-heading mb-3">
                                            KARAKTERISTIK MORFOLOGI
                                        </h5>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 upaya_konservasi">
                                        <h5 class="text-heading mb-3">
                                            UPAYA KONSERVASI
                                        </h5>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning btn-ubah-klasifikasi" type="button">Ubah Hasil Klasifikasi</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalHapus" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <form class="modal-content modalHapusContent" action="{{route('api.classproject.destroy',['id_project'=>'?'])}}" method="get">
                        <div class="modal-header">
                            <h5 class="modal-title modalHapusTitle fs-3 text-primary">Informasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                                <p class="fs-5">Anda yakin ingin hapus gambar ini?</p>
                                <input type="hidden" name="referensi_hapus">
                            </div>
                        </div>
                        <div class="modal-footer d-grid mx-auto">
                            <button type="submit" class="btn btn-lg btn-danger">Ya, saya ingin hapus gambar ini</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="modalUbahKlasifikasi" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <form class="modal-content modalUbahKlasifikasiContent" action="{{route('api.classproject.update')}}" method="post">
                        <input type="hidden" name="referensi_update" value=""/>
                        <div class="modal-header">
                            <h5 class="modal-title modalUbahKlasifikasiTitle fs-3 text-primary">Ubah Hasil Klasifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                                <label>Spesies Sebelum</label>
                                <select class="form-control" id="spesies_sebelum" name="spesies_sebelum"></select>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                                <label>Spesies Sesudah</label>
                                <select class="form-control" id="spesies_sesudah" name="spesies_sesudah"></select>
                            </div>
                        </div>
                        <div class="modal-footer d-grid mx-auto">
                            <button type="submit" class="btn btn-lg btn-success">Simpan perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="modalTambahKlasifikasi" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <form class="modal-content modalTambahKlasifikasiContent" action="{{route('api.classproject.store')}}" method="post">
                        <input type="hidden" name="referensi_baru" value=""/>
                        <div class="modal-header">
                            <h5 class="modal-title modalTambahKlasifikasiTitle fs-3 text-primary">Tambah Hasil Klasifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                                <label>Nama Spesies</label>
                                <select class="form-control" id="spesies_baru" name="spesies_baru"></select>
                            </div>
                        </div>
                        <div class="modal-footer d-grid mx-auto">
                            <button type="submit" class="btn btn-lg btn-success">Simpan perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="modalHapusKlasifikasi" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <form class="modal-content modalHapusKlasifikasiContent" action="{{route('api.classproject.delete',['id_project'=>'x','id'=>'y'])}}" method="get">
                        <div class="modal-header">
                            <h5 class="modal-title modalHapusKlasifikasiTitle fs-3 text-primary">Informasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                                <p class="fs-5">Anda yakin ingin hapus hasil klasifikasi gambar ini?</p>
                                <input type="hidden" name="referensi_hapus">
                            </div>
                        </div>
                        <div class="modal-footer d-grid mx-auto">
                            <button type="submit" class="btn btn-lg btn-danger">Ya, hapus hasil klasifikasi gambar ini</button>
                        </div>
                    </form>
                </div>
            </div>
@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        const refNewUpload = '#newUpload';
        const refCardLoading = '.card-loading';
        const refCardItem = '.card-item';
        const refPagingLoading = '.pagination-loading';
        const refPaging = '.pagination';
        const refPagingPrev = '.pagination-prev';
        const refPagingPrevButton = '.pagination-prev-button';
        const refPagingCurrent = '.pagination-current';
        const refPagingNext = '.pagination-next';
        const refPagingNextButton = '.pagination-next-button';
        const refLayoutCard = '.layout-card'
        let fileInput = $('#fileInput')

        const refOffcanvas = '.offcanvas'
        const refSliderGambar = '.slider_gambar'
        const refStatusKonservasi = '.status_konservasi'
        const refTaksonomiKategori = '.taksonomi_kategori'
        const refTaksonomiSpesies = '.taksonomi_spesies'
        const refTaksonomiKingdom = '.taksonomi_kingdom'
        const refTaksonomiFillum = '.taksonomi_fillum'
        const refTaksonomiSuperkelas = '.taksonomi_superkelas'
        const refTaksonomiKelas = '.taksonomi_kelas'
        const refTaksonomiOrdo = '.taksonomi_ordo'
        const refTaksonomiFamilia = '.taksonomi_familia'
        const refTaksonomiGenus = '.taksonomi_genus'
        const refTaksonomiNamadaerah = '.taksonomi_namadaerah'
        const refTaksonomiPengarang = '.taksonomi_pengarang'
        const refInfoKemunculan = '.info_kemunculan'
        const refInfoPanjangmax = '.info_panjangmax'
        const refInfoDistribusi = '.info_distribusi'
        const refInfoHabitat = '.info_habitat'
        const refInfoKomentar = '.info_komentar'
        const refUpayaKonservasi = '.upaya_konservasi'
        const refKarakteristik = '.karakteristik'
        const refIdGenom = '.id_genom'

        let modalUbahKlasifikasi = new bootstrap.Modal(document.getElementById('modalUbahKlasifikasi'));
        let modalUbahKlasifikasiContent = $('.modalUbahKlasifikasiContent');

        let modalTambahKlasifikasi = new bootstrap.Modal(document.getElementById('modalTambahKlasifikasi'));
        let modalTambahKlasifikasiContent = $('.modalTambahKlasifikasiContent');

        let modalHapusKlasifikasi = new bootstrap.Modal(document.getElementById('modalHapusKlasifikasi'));
        let modalHapusKlasifikasiContent = $('.modalHapusKlasifikasiContent');

        var modalCanvas = new bootstrap.Modal(document.getElementById('modalDetail'));
        
        let modalHapus = new bootstrap.Modal(document.getElementById('modalHapus'));
        let modalHapusTitle = $('.modalHapusTitle');
        let modalHapusContent = $('.modalHapusContent');

        let page = 1;
        let limit = 10;
        let active_prev = false;
        let active_next = false;

        function loadingDetail(){
            $(refSliderGambar).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refStatusKonservasi).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiSpesies).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiKategori).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiKingdom).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiFillum).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiSuperkelas).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiKelas).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiOrdo).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiFamilia).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiGenus).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiNamadaerah).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refTaksonomiPengarang).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refInfoKemunculan).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refInfoPanjangmax).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refInfoDistribusi).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refInfoHabitat).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refInfoKomentar).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refUpayaKonservasi).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refKarakteristik).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
            $(refIdGenom).html(`
                <div class="placeholder-glow">
                    <span class="placeholder col-12"></span>
                </div>
            `)
        }
        function setupDetail(data){
            console.log(data)
            let fotoHtml = ``;
            let indicatorHtml = ``;
            data.list_foto.forEach(function(foto,index){
                fotoHtml += `<div class="${index==0? "carousel-item active":"carousel-item"}">
                    <img src="${foto}" class="d-block img-fluid rounded-2 w-100" style="height: 600px"/>
                </div>`
                indicatorHtml += `<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${index}" class="active" aria-current="true" aria-label="Slide ${index+1}"></button>`
            })

            $(refSliderGambar).html(`
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        ${indicatorHtml}
                    </div>
                    <div class="carousel-inner w-100">
                        ${fotoHtml}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            `)
            $(refStatusKonservasi).html(`
                <div class="row g-1 mb-3">
                    ${data.status_konservasi=="ne"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">NOT EVALUATED</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">NE</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: #666666">
                            <div style="height: 40px;" class="font-small border-bottom">NOT EVALUATED</div>
                            <div class="fw-bold">NE</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="dd"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">DATA DEFICIENT</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">DD</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: #999999; color: black">
                            <div style="height: 40px;" class="font-small border-bottom">DATA DEFICIENT</div>
                            <div class="fw-bold">DD</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="lc"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">LEAST CONCERN</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">LC</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: #cc3333; color: white">
                            <div style="height: 40px;" class="font-small border-bottom">LEAST CONCERN</div>
                            <div class="fw-bold">LC</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="nt"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">NEAR THREATENED</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">NT</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: #cc6633; color: white">
                            <div style="height: 40px;" class="font-small border-bottom">NEAR THREATENED</div>
                            <div class="fw-bold">NT</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="vu"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">VULNERABLE</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">VU</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: #cc9900; color: white">
                            <div style="height: 40px;" class="font-small border-bottom">VULNERABLE</div>
                            <div class="fw-bold">VU</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="en"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">ENDANGERED</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">EN</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: #006666; color: white">
                            <div style="height: 40px;" class="font-small border-bottom">ENDANGERED</div>
                            <div class="fw-bold">EN</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="cr"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">CRITICAL ENDANGERED</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">CR</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: #006666; color: white">
                            <div style="height: 40px;" class="font-small border-bottom">CRITICAL ENDANGERED</div>
                            <div class="fw-bold">CR</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="ew"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">EXTINCT IN THE WILD</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">EW</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: black; color: white">
                            <div style="height: 40px;" class="font-small border-bottom">EXTINCT IN THE WILD</div>
                            <div class="fw-bold">EW</div>
                        </div>
                    </div>`}

                    ${data.status_konservasi=="ex"? 
                    `<div class="col-6 col-md-2">
                        <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                            <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                                <div class="font-small">EXTINCT</div>
                                <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <div class="fw-bold">EX</div>
                                <div class="fw-small">${data.status_konservasi_tahun}</div>
                            </div>
                        </div>
                    </div>`:
                    `<div class="col-3 col-md">
                        <div class="rounded-2 border p-1 text-center h-100" style="background: black; color: #cc3333">
                            <div style="height: 40px;" class="font-small border-bottom">EXTINCT</div>
                            <div class="fw-bold">EX</div>
                        </div>
                    </div>`}
                </div>
            `)
            $(refTaksonomiSpesies).html(data.spesies)
            $(refTaksonomiKategori).html(data.kategori)
            $(refTaksonomiKingdom).html(data.kingdom)
            $(refTaksonomiFillum).html(data.fillum)
            $(refTaksonomiSuperkelas).html(data.super_kelas)
            $(refTaksonomiKelas).html(data.kelas)
            $(refTaksonomiOrdo).html(data.ordo)
            $(refTaksonomiFamilia).html(data.famili)
            $(refTaksonomiGenus).html(data.genus)
            $(refTaksonomiNamadaerah).html(data.nama_daerah)
            $(refTaksonomiPengarang).html(data.pengarang)
            $(refInfoKemunculan).html(data.kemunculan)
            $(refInfoPanjangmax).html(data.panjang_maksimal)
            $(refInfoDistribusi).html(data.distribusi)
            $(refInfoHabitat).html(data.habitat)
            $(refInfoKomentar).html(data.komentar)
            $(refUpayaKonservasi).html(`
                <h5 class="text-heading mb-3">
                    UPAYA KONSERVASI
                </h5>
                ${data.upaya_konservasi}
            `)
            $(refKarakteristik).html(`
                <h5 class="text-heading mb-3">
                    KARAKTERISTIK MORFOLOGI
                </h5>
                ${data.karakteristik_morfologi}
            `)
            $(refIdGenom).html(data.id_genom)
        }
        function loadDetail(id){
            let url = `{{ route('api.KatalogIkan.detail',['id'=>'?']) }}`

            $.ajax({
                url: url.replace('?',id),
                method: 'get',
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function(){
                    loadingDetail()
                },
                success: function(response) {
                    const source = response?.data ?? {}
                    setupDetail(source)
                    [refKarakteristik,refUpayaKonservasi].forEach(function(item){
                        $(`.${item} ol li`).each(function(index) {
                                const itemText = $(this).text();

                                const hstackDiv = $('<div>').addClass('hstack gap-2 align-items-start');

                                const numberDiv = $('<div>').addClass('d-block');

                                const circleDiv = $('<div>').css({
                                    height: '24px',
                                    width: '24px',
                                    borderRadius: '50%'
                                }).addClass('bg-secondary d-flex align-items-center justify-content-center text-dark fw-bold')
                                .text(index + 1);

                                numberDiv.append(circleDiv);
                                hstackDiv.append(numberDiv);

                                const textParagraph = $('<p>').text(itemText);

                                hstackDiv.append(textParagraph);
                                $(`.${item}`).append(hstackDiv);
                        });
                        $(`.${item} ol`).remove();
                    })
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true, url.replace("?", id))
                }
            });
        }

        function deskripsiStatus(status) {
            const statusMap = {
                "ex": {
                    "judul": "Punah",
                    "inggris": "Extinct",
                    "deskripsi": "Tidak ada individu yang diketahui hidup"
                },
                "ew": {
                    "judul": "Punah di alam liar",
                    "inggris": "Extinct in the wild",
                    "deskripsi": "Diketahui hanya ada di penangkaran, atau sebagai populasi yang dinaturalisasi di luar rentang historisnya."
                },
                "cr": {
                    "judul": "Kritis",
                    "inggris": "Critically endangered",
                    "deskripsi": "Beresiko sangat tinggi punah di alam liar."
                },
                "en": {
                    "judul": "Terancam Punah",
                    "inggris": "Endangered",
                    "deskripsi": "Beresiko tinggi mengalami kepunahan."
                },
                "vu": {
                    "judul": "Rentan",
                    "inggris": "Vulnerable",
                    "deskripsi": "Risiko tinggi terancam di alam liar."
                },
                "nt": {
                    "judul": "Hampir Terancam Punah",
                    "inggris": "Near Threatened",
                    "deskripsi": "Kemungkinan akan terancam dalam waktu dekat."
                },
                "lc": {
                    "judul": "Risiko Rendah",
                    "inggris": "Least Concern",
                    "deskripsi": "Risiko terendah: tidak memenuhi syarat untuk kategori risiko yang lebih tinggi."
                },
                "dd": {
                    "judul": "Data Kurang",
                    "inggris": "Data Deficient",
                    "deskripsi": "Tidak cukup data untuk membuat penilaian tentang risiko kepunahannya."
                },
                "ne": {
                    "judul": "Tidak dievaluasi",
                    "inggris": "Not Evaluated",
                    "deskripsi": "Belum dievaluasi terhadap kriteria."
                }
            };

            // Mengembalikan deskripsi berdasarkan status atau '???' jika tidak ditemukan
            return statusMap[status.toLowerCase()] || "???";
        }

        function loadData() {
            $(refCardLoading).show();
            $(refPagingLoading).show()
            $(refPaging).hide()
            document.querySelectorAll(refCardItem).forEach(e => e.remove());

            $.ajax({
                url: `{{ route('api.classproject.list',['id_project'=>$project->id]) }}?page=${page}&limit=${limit}`,
                method: 'get',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    $(refCardLoading).hide();
                    const source = response?.data?.source ?? []
                    let listProject = ``;
                    source.forEach(function(item) {
                        let labelHtml = ``
                        if (item.list_ikan.length > 0) {
                            labelHtml = `<ol class="list-group list-group-numbered">`
                            item.list_ikan.forEach(function(label) {
                                console.log(label.akurasi)
                                labelHtml += `
                                    <li class="list-group-item d-flex flex-wrap justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">${label.spesies}</div>
                                            ${deskripsiStatus(label.status_konservasi)['judul']}
                                            <span class="badge bg-primary rounded-pill">${ label.type=="edited"? "Edited":(label.akurasi*100).toFixed(3)+"%" }</span>
                                        </div>
                                        <div class="dropdown" style="margin-left: auto;">
                                            <button class="btn text-black fs-4" type="button" id="shortmenu${item.id}${label.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                                ...
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="shortmenu${item.id}${label.id}">
                                                <li><a class="dropdown-item detail-klasifikasi" href="#" data-id="${item.id}" data-id_ikan="${label.id}">detail</a></li>
                                                <li><a class="dropdown-item hapus-klasifikasi" href="#" data-id="${item.id}" data-id_ikan="${label.id}">hapus</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                `
                            })
                            labelHtml += `</ol>`
                        } else {
                            labelHtml += `Tidak dapat mengenali ikan ini`;
                        }

                        listProject += `
                            <div class="card custom-card card-item" data-id="${item.id}">
                                <div class="stacked">
                                    <div class="dropdown">
                                        <button class="btn text-white fs-4" type="button" id="dropmenu${item.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                            ...
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropmenu${item.id}">
                                            <li><a class="dropdown-item action-delete" href="#" data-id="${item.id}">hapus</a></li>
                                        </ul>
                                    </div>
                                    <img src="${item.gambar_upload}" class="media">
                                </div>                                
                                <div class="card-body" style="overflow-y: scroll;">
                                    ` + labelHtml + `
                                </div>
                                <button type="button" class="btn btn-sm btn-primary btn-tambah-klasifikasi" data-id="${item.id}">Tambah Hasil Klasifikasi</button>
                            </div>
                        `
                    })
                    $(refLayoutCard).html($(refLayoutCard).html() + listProject);
                    $('.detail-klasifikasi').on('click',function(){
                        const id_ikan = $(this).data('id_ikan')
                        const id = $(this).data('id')

                        $('input[name="referensi_update"]').val(id)
                        load_dropdown("#spesies_sebelum", null, `{{route('select2.katalogikan.list')}}`, id_ikan, "Pilih Spesies Sebelumnya", '#modalUbahKlasifikasi')
                        load_dropdown("#spesies_sesudah", null, `{{route('select2.katalogikan.list')}}`, null, "Pilih Spesies Sesudahnya", '#modalUbahKlasifikasi')

                        loadDetail(id_ikan)
                        modalCanvas.show();
                    })
                    $('.hapus-klasifikasi').on('click',function(){
                        const id_ikan = $(this).data('id_ikan')
                        const id = $(this).data('id')

                        let form = modalHapusKlasifikasiContent;
                        let url = form.attr('action');
                        console.log(url)
                        url = url.toString().replace('x', id)
                        url = url.toString().replace('y', id_ikan)

                        form.attr('action',url);
                        modalHapusKlasifikasi.show()
                    })
                    $(refNewUpload).click(function(e) {
                        e.preventDefault();
                        const file = document.querySelector('#fileInput');
                        file.value = '';
                        fileInput.click();
                        //upload file
                    })

                    $(refPagingLoading).hide()
                    $(refPaging).show()
                    const total_data = response?.data?.total_data ?? 0;
                    const total_page = response?.data?.total_page ?? 1;
                    active_prev = response?.data?.active_prev ?? false;
                    active_next = response?.data?.active_next ?? false;

                    $(refPagingCurrent).html(page)

                    if (active_prev) {
                        $(refPagingPrev).removeClass('disabled')
                    } else {
                        $(refPagingPrev).addClass('disabled');
                    }

                    if (active_next) {
                        $(refPagingNext).removeClass('disabled')
                    } else {
                        $(refPagingNext).addClass('disabled');
                    }
                },
                error: function(xhr, status, error) {
                    $(refCardLoading).hide();
                    $(refPagingLoading).hide()
                    $(refPaging).show()
                    handleAjaxError(xhr, status, error, true, `{{ route('api.classproject.list',['id_project'=>$project->id]) }}?page=${page}&limit=${limit}`)

                    $(refNewUpload).click(function(e) {
                        e.preventDefault();
                        const file = document.querySelector('#fileInput');
                        file.value = '';
                        fileInput.click();
                        //upload file
                    })
                }
            });
        }
        loadData()

        function base64(file) {
            return new Promise((resolve, reject) => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var base64 = btoa(e.target.result);
                    resolve(base64);
                };
                reader.onerror = function(error) {
                    reject(error);
                };
                reader.readAsBinaryString(file);
            });
        }

        fileInput.on('change', async function() {
            const files = fileInput.get(0).files;
            console.log('File selected:', files);

            let dataForm = await new FormData();
            dataForm.append("id_project", "{{$project->id}}");
            for (let index = 0; index < files.length; index++) {
                const file = files[index];
                const base64String = await base64(file);
                dataForm.append("image[]", base64String)
            }

            $.ajax({
                type: "POST",
                url: `{{route('api.classproject.save')}}`,
                data: dataForm,
                dataType: "json",
                // contentType: "multipart/form-data",
                processData: false,
                contentType: false,
                headers: {
                    "Accept": "application/json"
                },
                beforeSend: function() {
                    $("#spinner-body").show();
                },
                success: function(response) {
                    loadData()
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true, `{{route('api.classproject.store')}}`);
                    loadData()
                },
                complete: function(data) {
                    $("#spinner-body").hide();
                }
            });
        })

        $(document).on('click', '.action-delete', function(e) {
            e.preventDefault();
            const id = $(this).data('id');

            $('input[name="referensi_hapus"]').val(id)
            modalHapus.show()
        });

        $(document).on('click', '.btn-ubah-klasifikasi', function(e) {
            e.preventDefault();
            modalCanvas.hide()
            modalUbahKlasifikasi.show()
        });
        $(document).on('click', '.btn-tambah-klasifikasi', function(e) {
            e.preventDefault();
            const id = $(this).data('id')

            $('input[name="referensi_baru"]').val(id)
            load_dropdown("#spesies_baru", null, `{{route('select2.katalogikan.list')}}`, null, "Pilih Spesies")
            
            modalTambahKlasifikasi.show()
        });

        /////new klasifikasi project
        modalTambahKlasifikasiContent.on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');

            $.ajax({
                url: url,
                method: method,
                data: new FormData(this),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function(){

                },
                success: function(response) {
                    modalTambahKlasifikasi.hide();
                    loadData()
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true, url.replace("?", id))
                }
            });
        });

        /////delete klasifikasi project
        modalHapusKlasifikasiContent.on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');

            $.ajax({
                url: url,
                method: method,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function(){

                },
                success: function(response) {
                    modalHapusKlasifikasi.hide();
                    loadData()
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true, url.replace("?", id))
                }
            });
        });

        /////update klasifikasi project
        modalUbahKlasifikasiContent.on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');

            $.ajax({
                url: url,
                method: method,
                data: new FormData(this),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function(){

                },
                success: function(response) {
                    modalUbahKlasifikasi.hide();
                    loadData()
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true, url.replace("?", id))
                }
            });
        });

        /////delete project
        modalHapusContent.on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');
            let id = $('input[name="referensi_hapus"]').val();

            $.ajax({
                url: url.replace("?", id),
                method: method,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    modalHapus.hide();
                    loadData()
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true, url.replace("?", id))
                }
            });
        });
        $(refPagingNextButton).on('click', function(e) {
            e.preventDefault()
            if (active_next) {
                page += 1
                loadData()
            }
        })
        $(refPagingPrevButton).on('click', function(e) {
            e.preventDefault()
            if (active_prev) {
                page -= 1
                loadData()
            }
        })
    });
</script>
@stop