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
        grid-template-columns: repeat(auto-fill, minmax(min(250px, 50vmax), 1fr));
        grid-auto-rows: 300px;
        gap: 1rem;
    }

    .custom-card {
        min-height: min(400px, 80vmin);
        height: 100%;
        overflow-y: scroll;
    }
    .media {
        width: 100% !important;
        object-fit: cover;
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

    .border-dotted {
        border-style: dashed !important;
        border-width: .2rem !important;
        border-color: var(--bs-primary) !important;
    }

    .bg-glass {
        background: transparent;
        box-shadow: none;
        border: none;
    }
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
                    <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">Project </h1>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
    </div>
</section>

@if (Session::has('level') && Session::get('level')=="user")
<!-- Konten -->
<section class="bg-dark">
    <div class="container d-flex flex-column gap-3 py-5">
        <div class="row g-4 row-cols-1 row-cols-md-3 row-cols-lg-4 layout-card">
            <!-- Upload -->
            <div class="col w-100">
                <div class="bg-glass rounded-4 p-3 h-100">
                    <a href="#" class="text-decoration-none text-light" id="newProject">
                        <div style="border-style: dashed;"
                            class="rounded-3 h-100 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <h5>Buat Project</h5>
                                <span class="material-symbols-rounded fs-1">
                                    add_circle
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Isi Konten -->
            <div class="col placeholder-glow card-loading w-100">
                <div class="bg-light placeholder rounded-4 p-2 w-100 h-100">
                    &nbsp;
                </div>
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
</section>

<div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form class="modal-content modalContent" action="{{route('api.project.store')}}" method="post">
            <div class="modal-header">
                <h5 class="modal-title">Project Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                    <label>Nama Project <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama project...">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                    <label>Deskripsi Project</label>
                    <textarea class="form-control" name="deskripsi" rows="10" cols="30"></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-lg btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalHapus" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form class="modal-content modalHapusContent" action="{{route('api.project.delete',['id'=>'?'])}}" method="get">
            <div class="modal-header">
                <h5 class="modal-title modalHapusTitle fs-3">Hapus </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                    <p class="fs-5">Anda yakin ingin hapus project ini?</p>
                    <input type="hidden" name="referensi_hapus">
                </div>
            </div>
            <div class="modal-footer d-grid mx-auto">
                <button type="submit" class="btn btn-lg btn-danger">Ya, saya ingin menghapus project ini</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalInvite" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form class="modal-content modalInviteContent" action="{{route('api.project.invite')}}" method="post">
            <div class="modal-header">
                <h5 class="modal-title modalInviteTitle fs-4">Undang anggota project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <input type="hidden" name="referensi_invite">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                    <label>Email</label>
                    <select class="form-control" id="anggota" name="anggota[]" multiple="multiple"></select>
                </div>
            </div>
            <div class="modal-footer d-grid mx-auto">
                <button type="submit" class="btn btn-lg btn-success">Kirim</button>
            </div>
        </form>
    </div>
</div>
@elseif(!Session::has('level'))
<!-- Tampilkan Jika Belum Login -->
<div class="container py-5 text-light">
    <h5>
        Proyek koleksi memungkinkan Anda untuk mengumpulkan dan memvisualisasikan pengamatan menggunakan alat
        pencarian fishiden. Segala sesuatu yang memenuhi parameter yang ditetapkan oleh proyek akan secara otomatis
        disertakan. Untuk memulai project silahkan untuk login
    </h5>
    <div class="text-center my-5">
        <a class="nav-link mb-lg-0 align-items-center" href="{{route('login.index')}}">
            <div class="btn-custom-primary px-lg-4 mx-lg-3 w-100">LOGIN</div>
        </a>
    </div>
    <img class="img-fluid" src="{{\App\Helper\Utility::loadAsset('assets/img/bg-project.png')}}" alt="">
</div>
@endif
@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        @if(Session::has('level') && Session::get('level') == "user")
        const refNewProject = '#newProject';
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

        let modal = new bootstrap.Modal(document.getElementById('modal'));
        let modalContent = $('.modalContent');

        let modalInvite = new bootstrap.Modal(document.getElementById('modalInvite'));
        let modalInviteContent = $('.modalInviteContent');

        let modalHapus = new bootstrap.Modal(document.getElementById('modalHapus'));
        let modalHapusTitle = $('.modalHapusTitle');
        let modalHapusContent = $('.modalHapusContent');

        let page = 1;
        let limit = 10;
        let active_prev = false;
        let active_next = false;

        function loadProject() {
            $(refCardLoading).show();
            $(refPagingLoading).show()
            $(refPaging).hide()
            document.querySelectorAll(refCardItem).forEach(e => e.remove());

            $.ajax({
                url: `{{ route('api.project.list',['id_user'=>Auth::user()?->id??0]) }}?page=${page}&limit=${limit}`,
                method: 'get',
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $(refLayoutCard).find('.col').each(function(index, item) {
                        if (index >= 2) {
                            console.log(item)
                            $(item).remove();
                        }
                    });
                },
                success: function(response) {
                    $(refCardLoading).hide();
                    const source = response?.data?.source ?? []
                    let listProject = ``;
                    source.forEach(function(item) {
                        listProject += `
                        <div class="col w-100">
                            <div class="bg-light rounded-4 p-2 h-100">
                                <div class="rounded-3">
                                    <img style="height: 160px;" class="img-fluid rounded-3 mb-1 media ${item.foto==null || item.foto==undefined? 'w-100':''}" src="${item.foto??`https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg`}" alt="gambar ${item.judul}" data-id="${item.id}" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg';">
                                    <div class="row g-2 justify-content-between my-1">
                                        <div class="col" style="width: 13ch;overflow-wrap: break-word;">
                                            <h5 class="fw-bold">${item.judul}</h5>
                                            <p class="mb-0 mt-2" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">${item.deskripsi}</span></p>
                                        </div>
                                        <div class="col-auto dropstart">
                                            <button type="button" class="btn btn-warning d-flex rounded-pill p-0 m-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="material-symbols-rounded">
                                                    more_vert
                                                </span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item font-small action-delete" href="#" data-id="${item.id}" data-judul="${item.judul}">
                                                        <div class="hstack justify-content-between align-items-center">
                                                            <span>Hapus</span>
                                                            <span class="material-symbols-rounded">
                                                                delete
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item font-small action-invite" href="#" data-id="${item.id}" data-judul="${item.judul}">
                                                        <div class="hstack justify-content-between align-items-center">
                                                            <span>Undang Anggota</span>
                                                            <span class="material-symbols-rounded">
                                                                person
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item font-small media" href="#" data-id="${item.id}" data-judul="${item.judul}">
                                                        <div class="hstack justify-content-between align-items-center">
                                                            <span>Details</span>
                                                            <span class="material-symbols-rounded">
                                                                info
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                    })
                    $(refLayoutCard).html($(refLayoutCard).html() + listProject);
                    $(refNewProject).click(function(e) {
                        e.preventDefault();
                        modal.show();
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

                    $(refNewProject).click(function(e) {
                        e.preventDefault();
                        modal.show();
                    })
                }
            });
        }
        loadProject()

        /////invite member project
        $(document).on('click', '.action-delete', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const judul = $(this).data('judul');

            $('input[name="referensi_hapus"]').val(id)
            modalHapusTitle.html(`Hapus ${judul}`)
            modalHapus.show()
        });
        $(document).on('click', '.action-invite', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const judul = $(this).data('judul');

            $('input[name="referensi_invite"]').val(id)
            $("#anggota").select2({
                theme: 'bootstrap-5',
                dropdownParent: parent,
                ajax: {
                    url: `{{route('select2.user.list')}}`,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'user_search'
                        }
                        return query
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        }
                    }
                },
                dropdownParent: ".modalInviteContent",
                placeholder: "Masukkan email atau nama anggota yang mau di undang dalam project",
            }).val('').trigger("change");
            modalInvite.show()
        });
        $(document).on('click', '.media', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            let url = `{{route('project.detail',['id'=>'?'])}}`
            window.location.replace(url.replace('?', id));
        });

        modalInviteContent.on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');
            let id = $('input[name="referensi_invite"]').val();
            let anggotaSelected = $('#anggota').val();

            let formData = {
                _token: CSRF_TOKEN,
                id_project: id,
                anggota: anggotaSelected
            };

            $.ajax({
                url: url,
                method: method,
                dataType: 'json',
                data: formData,
                success: function(response) {
                    modalInvite.hide();
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error, true, ``)
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
                    loadProject()
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
                loadProject()
            }
        })
        $(refPagingPrevButton).on('click', function(e) {
            e.preventDefault()
            if (active_prev) {
                page -= 1
                loadProject()
            }
        })


        /////add project
        $(refNewProject).click(function(e) {
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
                judul: nama,
                deskripsi: deskripsi,
                id_user: "{{Auth::user()?->id??0}}"
            };
            console.log(formData)

            $.ajax({
                url: url,
                method: method,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    modal.hide();
                    loadProject()
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    loadProject()
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        })
        @endif
    });
</script>
@stop