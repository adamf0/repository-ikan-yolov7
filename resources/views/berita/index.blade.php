@extends('template_admin')
 
@section('page-title')
    <x-page-title title="Berita">
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Berita</li>
            </ol>
        </nav>
    </x-page-title>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-12">
                <a href="{{route('berita.add')}}" class="btn btn-primary">Tambah Berita</a>
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
                                        <th>Kategori</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
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
                url: `{{ route('datatable.Berita.index') }}`,
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
                    data: 'kategori',
                    name: 'kategori',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'judul_url_scrapping',
                    name: 'judul_url_scrapping',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'kontent_deskripsi',
                    name: 'kontent_deskripsi',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
            ]);
        });
        
    </script>
@endpush
