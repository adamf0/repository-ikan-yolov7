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
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-12">
                <a href="{{route('katalog_ikan.add')}}" class="btn btn-primary">Tambah Ikan</a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Aksi</th>
                                        <th>Ordo</th>
                                        <th>Famili</th>
                                        <th>Genus</th>
                                        <th>Spesies</th>
                                        <th>Status</th>
                                        <th>Tahun Konservasi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-lg fade" id="modalDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modalDetailTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modalDetailBody"></div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
    <script>
        $(document).ready(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            let modalDetail         = new bootstrap.Modal(document.getElementById('modalDetail'));
            let modalDetailTitle = $('.modalDetailTitle');
            let modalDetailBody = $('.modalDetailBody');

            let table = eTable({
                url: `{{ route('datatable.KatalogIkan.index') }}`,
            }, [
                {
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    sWidth:'3%'
                },
                {
                    data: 'action', 
                    name: 'action'
                },
                {
                    data: 'ordo',
                    name: 'ordo',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'famili',
                    name: 'famili',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'genus',
                    name: 'genus',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'spesies',
                    name: 'spesies',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'status_konservasi',
                    name: 'status_konservasi',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'status_konservasi_tahun',
                    name: 'status_konservasi_tahun',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
            ]);

            $('#tb tbody').on('click', '.btn-detail', function(e) {
                e.preventDefault();
                const type = $(this).data('type');
                const rowData = table.row($(this).closest('tr')).data();
                let contentTable = `<tr>
                                        <th>Kingdom</th>
                                        <td>${rowData.kingdom}</td>
                                    </tr>
                                    <tr>
                                        <th>Fillum</th>
                                        <td>${rowData.fillum}</td>
                                    </tr>
                                    <tr>    
                                        <th>Super Kelas</th>
                                        <td>${rowData.super_kelas}</td>
                                    </tr>
                                    <tr>
                                        <th>Ordo</th>
                                        <td>${rowData.ordo}</td>
                                    </tr>
                                    <tr>
                                        <th>Famili</th>
                                        <td>${rowData.famili}</td>
                                    </tr>
                                    <tr>    
                                        <th>Genus</th>
                                        <td>${rowData.genus}</td>
                                    </tr>
                                    <tr>    
                                        <th>Spesies</th>
                                        <td>${rowData.spesies}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>${rowData.kategori}</td>
                                    </tr>
                                    <tr>
                                        <th>Habitat</th>
                                        <td>${rowData.habitat}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Daerah</th>
                                        <td>${rowData.nama_daerah}</td>
                                    </tr>
                                    <tr>
                                        <th>Pengarang</th>
                                        <td>${rowData.pengarang}</td>
                                    </tr>
                                    <tr>
                                        <th>Karakteristik</th>
                                        <td>${rowData.karakteristik_morfologi}</td>
                                    </tr>
                                    <tr>
                                        <th>Kemunculan</th>
                                        <td>${rowData.kemunculan}</td>
                                    </tr>
                                    <tr>
                                        <th>Panjang</th>
                                        <td>${rowData.panjang_maksimal}</td>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <td>${rowData.id_genom}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>${rowData.status_konservasi}</td>
                                    </tr>
                                    <tr>    
                                        <th>Tahun</th>
                                        <td>${rowData.status_konservasi_tahun}</td>
                                    </tr>
                                    <tr>
                                        <th>Upaya</th>
                                        <td>${rowData.upaya_konservasi}</td>
                                    </tr>
                                    <tr>
                                        <th>Komentar</th>
                                        <td>${rowData.komentar}</td>
                                    </tr>`;
                
                modalDetailTitle.text("Detail Spesies ");
                modalDetailBody.html(`<div class="row table-responsive offset-x">
                                        <table class="col-12 table">
                                            ${contentTable}
                                        </table>
                                    </div>`);
                modalDetail.show();
            });
        });
        
    </script>
@endpush
