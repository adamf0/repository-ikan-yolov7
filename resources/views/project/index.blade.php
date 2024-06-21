@extends('template_admin')

@section('page-title')
<x-page-title title="Project">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Project</li>
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
        overflow-y: scroll;
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
@stop

@push('scripts')
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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
                success: function(response) {
                    $(refCardLoading).hide();
                    const source = response?.data?.source ?? []
                    let listProject = ``;
                    source.forEach(function(item) {
                        listProject += `
                            <div class="card custom-card card-item" style="cursor: pointer;">
                                <div class="stacked">
                                    <div class="dropdown">
                                        `+(item.creator==`{{Auth::user()->id}}`? 
                                        `<button class="btn ${item.foto? 'text-white':'text-black'} fs-4" type="button" id="dropmenu${item.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropmenu${item.id}">
                                            <li><a class="dropdown-item action-delete" href="#" data-id="${item.id}" data-judul="${item.judul}">hapus</a></li>
                                            <li><a class="dropdown-item action-invite" href="#" data-id="${item.id}" data-judul="${item.judul}">undang anggota</a></li>
                                        </ul>`:
                                        ``
                                        )+`
                                    </div>
                                    <img src="${item.foto??`https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg`}" class="media" data-id="${item.id}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-item-title fs-4 text-primary">${item.judul}</h5>
                                    <p class="card-text card-item-desc">${item.deskripsi??""}</p>
                                </div>
                            </div>
                        `
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
                success: function(response) {
                    modal.hide();
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        })
    });
</script>
@endpush