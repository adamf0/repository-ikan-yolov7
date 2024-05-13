@extends('template_admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Katalog Ikan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body row">
                        <a href="{{route('katalog_ikan.add')}}" class="btn btn-primary">Tambah Ikan</a>
                        <table id="tb" class="table table-responsive table-stripped">
                            <thead>
                            <tr>
                                    <th>#</th>
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
                                    <th>Upaya Konservasi</th>
                                    <th>Foto</th>
                                    <th>Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{$item->iteration}}</td>
                                    <td>{{ $item->fillum }}</td>
                                    <td>{{ $item->super_kelas }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->ordo }}</td>
                                    <td>{{ $item->famili }}</td>
                                    <td>{{ $item->genus }}</td>
                                    <td>{{ $item->spesies }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->habitat }}</td>
                                    <td>{{ $item->nama_daerah }}</td>
                                    <td>{{ $item->pengarang }}</td>
                                    <td>{{ $item->karakteristik_morfologi }}</td>
                                    <td>{{ $item->kemunculan }}</td>
                                    <td>{{ $item->panjang_maksimal }}</td>
                                    <td>{{ $item->id_genom }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->upaya_konservasi }}</td>
                                    <td></td>
                                    <td>{{ $item->komentar }}</td>
                                    <td class="d-flex flex-row">
                                        <a href="{{route('katalog_ikan.delete',['id'=>$item->id])}}" class="btn btn-danger">Hapus</a>
                                        <a href="{{route('katalog_ikan.edit',['id'=>$item->id])}}" class="mx-2 btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@stop

@push('scripts')
<script>
    $(document).ready(function() {
        let table = $('#tb').DataTable({
            pageLength: 10,
            filter: true,
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true,
            "searching": true,
        });
    });
</script>
@endpush