@extends('template_admin')
 
@section('page-title')
    <x-page-title title="Arsip Publikasi">
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Arsip Publikasi</li>
            </ol>
        </nav>
    </x-page-title>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-12">
                <a href="{{route('arsip_publikasi.add')}}" class="btn btn-primary">Tambah Arsip Publikasi</a>
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
                                        <th>Tahun</th>
                                        <th>Arsip</th>
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
                url: `{{ route('datatable.ArsipPublikasi.index') }}`,
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
                    data: 'tahun',
                    name: 'tahun',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'arsip_url',
                    name: 'arsip_url',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
            ]);
        });
        
    </script>
@endpush
