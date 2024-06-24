@extends('template_admin')

@section('page-title')
<x-page-title title="Project">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Project</li>
            <li class="breadcrumb-item active">{{$project->judul}}</li>
        </ol>
    </nav>
</x-page-title>
@stop

@section('content')
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
        grid-template-columns: repeat(auto-fill, minmax(min(250px, 50vmax), 1fr));
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
</style>
<div id="spinner-body" class="pt-5">
    <div class="spinner-border text-primary" role="status" style="position: absolute;top: 50%;">
    </div>
</div>

<input type="file" id="fileInput" style="display:none;">
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

<div class="modal fade" id="modalHapus" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form class="modal-content modalHapusContent" action="{{route('api.classproject.delete',['id'=>'?'])}}" method="get">
            <div class="modal-header">
                <h5 class="modal-title modalHapusTitle fs-3">Informasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                    <p class="fs-5">Anda yakin ingin hapus gambar ini?</p>
                    <input type="hidden" name="referensi_hapus">
                </div>
            </div>
            <div class="modal-footer d-grid mx-auto">
                <button type="submit" class="btn btn-lg btn-danger">Ya, saya ingin menghapus gambar ini</button>
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

        let modalHapus = new bootstrap.Modal(document.getElementById('modalHapus'));
        let modalHapusTitle = $('.modalHapusTitle');
        let modalHapusContent = $('.modalHapusContent');

        let page = 1;
        let limit = 10;
        let active_prev = false;
        let active_next = false;

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
                        const labels = Object.entries(item.result).reduce((result, [key, value], index) => {
                            if (key !== "image") {
                                result[index] = value;
                            }
                            return result;
                        }, []);

                        let labelHtml = ``
                        if (labels.length > 0) {
                            labelHtml = `<ol class="list-group list-group-numbered">`
                            labels.forEach(function(label) {
                                labelHtml += `
                                    <li class="list-group-item d-flex justify-content-between align-items-start" style="cursor: pointer;">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">${label.spesies}</div>
                                            ${deskripsiStatus(label.status_konservasi)['judul']}
                                        </div>
                                        <span class="badge bg-primary rounded-pill">${(label.kotak_prediksi.confidence*100).toFixed(3)}%</span>
                                    </li>
                                `
                            })
                            labelHtml += `</ol>`
                        } else {
                            labelHtml += `Tidak dapat mengenali ikan ini`;
                        }

                        listProject += `
                            <div class="card custom-card card-item" data-id="${item.id}" data-judul="${item.judul}">
                                <div class="stacked">
                                    <div class="dropdown">
                                        <button class="btn text-white fs-4" type="button" id="dropmenu${item.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropmenu${item.id}">
                                            <li><a class="dropdown-item action-delete" href="#" data-id="${item.id}">hapus</a></li>
                                        </ul>
                                    </div>
                                    <img src="data:image/png;base64,${item.result?.image}" class="media">
                                </div>                                
                                <div class="card-body" style="overflow-y: scroll;">
                                    ` + labelHtml + `
                                </div>
                            </div>
                        `
                    })
                    $(refLayoutCard).html($(refLayoutCard).html() + listProject);
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
                    handleAjaxError(xhr, status, error, true, ``)

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

        fileInput.addEventListener('change', function() {
            console.log('File selected:', fileInput.files[0]);
            let dataForm = new FormData();
            dataForm.append("id_project", "{{$project->id}}");
            if (fileInput.files.length) {
                dataForm.append("image", fileInput.files[0]);
            }
            $("#spinner-body").show();

            $.ajax({
                type: "POST",
                url: `{{route('api.classproject.store')}}`,
                data: dataForm,
                dataType: "json",
                contentType: "multipart/form-data",
                processData: false,
                contentType: false,
                headers: {
                    "Accept": "application/json"
                },
                success: function(response) {
                    loadData()
                    $("#spinner-body").hide();
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true);
                    loadData()
                    $("#spinner-body").hide();
                }
            });
        });

        $(document).on('click', '.action-delete', function(e) {
            e.preventDefault();
            const id = $(this).data('id');

            $('input[name="referensi_hapus"]').val(id)
            modalHapus.show()
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
                    handleAjaxError(xhr, status, error, true, ``)
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
@endpush