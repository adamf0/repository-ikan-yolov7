@extends('template_admin')

@section('page-title')
<x-page-title title="Katalog Ikan">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Katalog Ikan</li>
        </ol>
    </nav>
</x-page-title>
@stop

@section('content')
<style>
    .layout-card {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(250px, 50vmax), 1fr));
        gap: 1rem;
    }

    .custom-card {
        min-height: min(400px, 80vmin);
        height: 100%;
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
</style>

<div class="d-flex flex-column justify-content-between" style="min-height: calc(100vh - 11rem); gap: 2rem;">
    <div class="flex-grow-2 layout-card">
        <button class="card custom-card border border-dotted d-flex justify-content-center align-items-center" id="newProject">
            <i class="bi bi-plus-lg fs-1"></i>
            <span>Buat Project</span>
        </button>
        <div class="card custom-card placeholder-glow card-loading">
            <div class="placeholder" style="height: -webkit-fill-available;"></div>
        </div>
        @for ($i=0; $i<30;$i++) 
        <div class="card custom-card card-item">
            <img src="https://bootstrapmade.com/demo/templates/NiceAdmin/assets/img/card.jpg">
            <div class="card-body">
                <h5 class="card-title card-item-title">Card with an image on top</h5>
                <p class="card-text card-item-desc">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
        @endfor
    </div>
    <div>
        <div class="pagination-loading placeholder-glow" style="display: none;">
            <div class="placeholder col-2" style="min-height: 2rem;"></div>
        </div>
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link pagination-prev">Previous</a>
            </li>
            <li class="page-item active" aria-current="page">
                <a class="page-link pagination-current" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link pagination-next" href="#">Next</a>
            </li>
        </ul>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form class="modal-content modalContent" action="" method="post">
            <div class="modal-header">
                <h5 class="modal-title">Project Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                        <label>Nama Project <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama project...">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                        <label>Deskripsi Project</label>
                        <textarea class="form-control" name="deskripsi" rows="10" cols="30"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-lg btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        const refNewProject = $('#newProject');

        let modal = new bootstrap.Modal(document.getElementById('modal'));
        let modalContent = $('.modalContent');


        //load project ajax
        //paging

        refNewProject.click(function(e) {
            e.preventDefault();
            modal.show();
        })
        modalContent.on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');
            let nama = $('input[name="nama"]').val();
            let deskripsi = $('textarea[name="deskripsi"]').val();

            if (!nama) {
                $('input[name="nama"]').addClass('is-invalid');
                return;
            } else {
                $('input[name="nama"]').removeClass('is-invalid');
            }

            let formData = {
                _token: CSRF_TOKEN,
                nama: nama,
                deskripsi: deskripsi
            };
            modal.hide();
            console.log(formData)

            // $.ajax({
            //     url: url,
            //     method: method,
            //     data: formData,
            //     success: function(response) {
            //         modal.hide();
            //         alert('Project successfully saved!');
            //     },
            //     error: function(xhr, status, error) {
            //         alert('An error occurred: ' + xhr.responseText);
            //     }
            // });
        })
    });
</script>
@endpush