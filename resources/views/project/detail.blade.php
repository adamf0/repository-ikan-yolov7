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

    .status_konservasi {
        overflow-x: auto;
        scrollbar-width: auto;

        & table {
            text-align: center;
            border: 1px solid black;
            width: -webkit-fill-available;

            & tr {
                height: 3.7vmax;
            }

            & td {
                font-size: .8rem !important;
                background: white;
                color: black;
                padding: 0.4rem 1rem;
            }

            & td[data-mark="black"] {
                background: black;
                color: white;
            }

            & td[data-mark="mark"] {
                width: 140px;
                height: -webkit-fill-available;
                background: #f21f1f;
                color: white;
                font-size: 1.3rem;
                padding: 0 min(1rem, 1vmax) 0.4rem min(1rem, 1vmax);
                border-top-left-radius: 50%;
                border-bottom-left-radius: 50%;
                border-bottom-right-radius: 50%;

                & .mark__container {
                    display: flex;
                    /* align-items: flex-end; */
                    flex-direction: column;
                    gap: 0.3rem;

                    & img {
                        width: 2rem;
                        aspect-ratio: 1/1;
                        filter: brightness(100);
                        display: block;
                        margin-left: auto;
                    }

                    & .mark_info {
                        display: flex;
                        flex-direction: column;

                        & label {
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }
    .fs-6{
        font-size: clamp(0.4rem, 0.4rem + 1.1vmax, 1rem) !important;
    }
    .offcanvas-body {
        padding: var(--bs-offcanvas-padding-y) var(--bs-offcanvas-padding-x);
        overflow-y: auto;
    }
    .detail-info{
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px,1fr));
        gap: 2rem;
    }
    .detail-info > .merge-colums{
        grid-column: 1/-1;
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

            <div class="modal modal-xl fade" id="modalDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <h5 class="modal-title taksonomi_spesies fs-3 text-primary">
                                <div class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="detail-info">
                                <div class="merge-colums slider_gambar">
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-12"></span>
                                    </div>
                                </div>
                                <div class="merge-colums status_konservasi">
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-12"></span>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="d-block fs-3 text-primary">Taksonomi</h6>
                                    <table class="table fs-6">
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_kategori">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kingdom</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_kingdom">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fillum</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_fillum">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super Kelas</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_superkelas">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_kelas">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ordo</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_ordo">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Familia</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_familia">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Genus</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_genus">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Daerah</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_namadaerah">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pengarang</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break taksonomi_pengarang">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="">
                                    <h6 class="d-block fs-3 text-primary">Informasi Detail</h6>
                                    <table class="table fs-6">
                                        <tr>
                                            <td>Kemunculan</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break info_kemunculan">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Panjang Maksimal</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break info_panjangmax">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Distribusi</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break info_distribusi">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Habitat</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break info_habitat">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Komentar</td>
                                            <td>:</td>
                                            <td class="ucfirst text-break info_komentar">
                                                <div class="placeholder-glow">
                                                    <span class="placeholder col-12"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="">
                                    <h6 class="d-block fs-3 text-primary">Upaya Konservasi</h6>
                                    <div class="fs-6 upaya_konservasi">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="d-block fs-3 text-primary">karakteristik Morfologi</h6>
                                    <div class="fs-6 karakteristik">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="merge-colums">
                                    <h6 class="d-block fs-3 text-primary">ID Genom</h6>
                                    <div class="fs-6 text-justify text-break id_genom">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-12"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="merge-colums">
                                    <button class="btn btn-warning btn-ubah-klasifikasi" type="button">Ubah Hasil Klasifikasi</button>
                                </div>
                            </div>
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
        </div>
    </section>
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
            data.list_foto.forEach(function(foto,index){
                fotoHtml = `<div class="${index==0? "carousel-item active":"carousel-item"}">
                    <img src="${foto}" class="" alt="...">
                </div>`
            })

            $(refSliderGambar).html(`
                <div class="carousel slide" id="carouselExampleCaptions" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner w-100">
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="bi bi-chevron-left fs-1 text-white"></span>
                        </button>`
                        +
                        fotoHtml
                        +
                        `<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="bi bi-chevron-right fs-1 text-white"></span>
                        </button>
                    </div>
                </div>
            `)
            $(refStatusKonservasi).html(`
                <table>
                    <thead>
                        <tr>
                            `+(
                                data.status_konservasi=="ne"? 
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>NOT EVALUATED</label>
                                            <span>NE</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>`
                                :
                                `<td data-mark="black">NOT EVALUATED</td>`
                            )+ (
                                data.status_konservasi=="dd"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>DATA DEFICIENT</label>
                                            <span>DD</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>`
                                :
                                `<td data-mark="black">DATA DEFICIENT</td>`
                            )+(
                                data.status_konservasi=="lc"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>LEAST CONCERN</label>
                                            <span>LC</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>`
                                :
                                `<td>LEAST CONCERN</td>`
                            )+(
                                data.status_konservasi=="nt"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>NEAR THREATENED</label>
                                            <span>NT</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td> `
                                :
                                `<td>NEAR THREATENED</td>`
                            )+(
                                data.status_konservasi=="vu"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>VULNERABLE</label>
                                            <span>VU</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>`
                                :
                                `<td>VULNERABLE</td>`
                            )+(
                                data.status_konservasi=="vu"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>ENDANGERED</label>
                                            <span>EN</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>`
                                :
                                `<td>ENDANGERED</td>`
                            )+(
                                data.status_konservasi=="cr"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>CRITICAL ENDANGERED</label>
                                            <span>CR</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>`
                                :
                                `<td>CRITICAL ENDANGERED</td>`
                            )+(
                                data.status_konservasi=="ew"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>EXTINCT IN THE WILD</label>
                                            <span>EW</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>`
                                :
                                `<td>EXTINCT IN THE WILD</td>`
                            )+(
                                data.status_konservasi=="ex"?
                                `<td rowspan="2" data-mark="mark">
                                    <div class="mark__container">
                                        <img src="{{ \App\Helper\Utility::loadAsset('red list.png') }}" alt="">
                                        <div class="mark_info">
                                            <label>EXTINCT</label>
                                            <span>EX</span>
                                            <span>${data.status_konservasi_tahun}</span>
                                        </div>
                                    </div>
                                </td>    `
                                :
                                `<td data-mark="black">EXTINCT</td>`
                            )+`
                        </tr>
                        <tr>
                            `+(data.status_konservasi=="ne"? ``:`<td>NE</td>`)+`
                            `+(data.status_konservasi=="dd"? ``:`<td>DD</td>`)+`
                            `+(data.status_konservasi=="lc"? ``:`<td>LC</td>`)+`
                            `+(data.status_konservasi=="nt"? ``:`<td>NT</td>`)+`
                            `+(data.status_konservasi=="vu"? ``:`<td>VU</td>`)+`
                            `+(data.status_konservasi=="vu"? ``:`<td>EN</td>`)+`
                            `+(data.status_konservasi=="cr"? ``:`<td>CR</td>`)+`
                            `+(data.status_konservasi=="ew"? ``:`<td>EW</td>`)+`
                            `+(data.status_konservasi=="ex"? ``:`<td>EX</td>`)+`
                        </tr>
                    </thead>
                </table>
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
            $(refUpayaKonservasi).html(data.upaya_konservasi)
            $(refKarakteristik).html(data.karakteristik_morfologi)
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