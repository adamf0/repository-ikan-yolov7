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
                                        <th>Fillum</th>
                                        <th>Super Kelas</th>
                                        <th>Kelas</th>
                                        <th>Ordo</th>
                                        <th>Famili</th>
                                        <th>Genus</th>
                                        <th>Spesie</th>
                                        <th>Kategori</th>
                                        <th>Habitat</th>
                                        <th>Nama daerah</th>
                                        <th>Pengarang</th>
                                        <th>Karakteristik Morfologi</th>
                                        <th>Kemunculan</th>
                                        <th>Panjang Maksimal</th>
                                        <th>ID Genus</th>
                                        <th>Status</th>
                                        <th>Tahun Konservasi</th>
                                        <th>Upaya Konservasi</th>
                                        <!-- <th>Foto</th> -->
                                        <th>Komentar</th>
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
@stop

@push('scripts')
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
    <script>
        $(document).ready(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
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
                    data: 'fillum',
                    name: 'fillum',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'super_kelas',
                    name: 'super_kelas',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'kelas',
                    name: 'kelas',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
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
                    data: 'kategori',
                    name: 'kategori',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'kategori',
                    name: 'kategori',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'nama_daerah',
                    name: 'nama_daerah',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'pengarang',
                    name: 'pengarang',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'karakteristik_morfologi',
                    name: 'karakteristik_morfologi',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'kemunculan',
                    name: 'kemunculan',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'panjang_maksimal',
                    name: 'panjang_maksimal',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'id_genom',
                    name: 'id_genom',
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
                {
                    data: 'upaya_konservasi',
                    name: 'upaya_konservasi',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
                {
                    data: 'kometar',
                    name: 'kometar',
                    render: function ( data, type, row, meta ) {
                        return data;
                    }
                },
            ]);
        });
    </script>
@endpush
