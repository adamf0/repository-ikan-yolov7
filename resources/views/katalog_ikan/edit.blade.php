@extends('template_admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Katalog Ikan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Katalog Ikan</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
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
                    <form action="{{route('katalog_ikan.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$old->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 form-group">
                                    <label>Fillum</label>
                                    <input type="text" class="form-control" name="fillum" placeholder="Masukkan fillum..." value="{{$old->fillum}}">
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 form-group">
                                    <label>Super Kelas</label>
                                    <input type="text" class="form-control" name="super_kelas" placeholder="Masukkan super kelas..." value="{{$old->super_kelas}}">
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 form-group">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" name="kelas" placeholder="Masukkan kelas..." value="{{$old->kelas}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 form-group">
                                    <label>Ordo</label>
                                    <input type="text" class="form-control" name="ordo" placeholder="Masukkan ordo..." value="{{$old->ordo}}">
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 form-group">
                                    <label>Famili</label>
                                    <input type="text" class="form-control" name="famili" placeholder="Masukkan famili..." value="{{$old->famili}}">
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 form-group">
                                    <label>Genus</label>
                                    <input type="text" class="form-control" name="genus" placeholder="Masukkan genus..." value="{{$old->genus}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Spesies</label>
                                <input type="text" class="form-control" name="spesies" placeholder="Masukkan spesies..." value="{{$old->spesies}}">
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 form-group">
                                    <label>Kategori</label>
                                    <input type="text" class="form-control" name="kategori" placeholder="Masukkan kategori..." value="{{$old->kategori}}">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 form-group">
                                    <label>Habitat</label>
                                    <select class="form-control" name="habitat">
                                        <option value="" {{$old->habitat==""? "selected":""}}>-- Pilih --</option>
                                        <option value="air payau" {{$old->habitat=="aur payau"? "selected":""}}>Air Tawar</option>
                                        <option value="air laut" {{$old->habitat=="air laut"? "selected":""}}>Air Laut</option>
                                        <option value="air payau" {{$old->habitat=="air payau"? "selected":""}}>Air Payau</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama Daerah</label>
                                <input type="text" class="form-control" name="nama_daerah" placeholder="Masukkan nama Daerah..." value="{{$old->nama_daerah}}">
                            </div>
                            <div class="form-group">
                                <label>Pengarang</label>
                                <input type="text" class="form-control" name="pengarang" placeholder="Masukkan pengarang..." value="{{$old->pengarang}}">
                            </div>
                            <div class="form-group">
                                <label>Karakteristik Morfologi</label>
                                <input type="text" class="form-control" name="karakteristik_morfologi" placeholder="Masukkan karakteristik morfologi..." value="{{$old->karakteristik_morfologi}}">
                            </div>
                            <div class="form-group">
                                <label>Kemunculan</label>
                                <input type="text" class="form-control" name="kemunculan" placeholder="Masukkan kemunculan..." value="{{$old->kemunculan}}">
                            </div>
                            <div class="form-group">
                                <label>Panjang Maskimal</label>
                                <input type="text" class="form-control" name="panjang_maksimal" placeholder="Masukkan panjang maksimal..." value="{{$old->panjang_maksimal}}">
                            </div>
                            <div class="form-group">
                                <label>ID Genom</label>
                                <textarea class="form-control" name="id_genom" placeholder="Masukkan id genom...">{{$old->id_genom}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Status Konservasi</label>
                                <select class="form-control" name="status_konservasi">
                                    <option value="" {{strtolower($old->status_konservasi)==""? "selected":""}}>-- Pilih --</option>
                                    <option value="ex" {{strtolower($old->status_konservasi)=="ex"? "selected":""}}>ex</option>
                                    <option value="ew" {{strtolower($old->status_konservasi)=="ew"? "selected":""}}>ew</option>
                                    <option value="cr" {{strtolower($old->status_konservasi)=="cr"? "selected":""}}>cr</option>
                                    <option value="en" {{strtolower($old->status_konservasi)=="en"? "selected":""}}>en</option>
                                    <option value="vu" {{strtolower($old->status_konservasi)=="vu"? "selected":""}}>vu</option>
                                    <option value="nt" {{strtolower($old->status_konservasi)=="nt"? "selected":""}}>nt</option>
                                    <option value="lc" {{strtolower($old->status_konservasi)=="lc"? "selected":""}}>lc</option>
                                    <option value="dd" {{strtolower($old->status_konservasi)=="dd"? "selected":""}}>dd</option>
                                    <option value="ne" {{strtolower($old->status_konservasi)=="ne"? "selected":""}}>ne</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tahun Konservasi</label>
                                <input type="text" class="form-control" name="status_konservasi_tahun" placeholder="Masukkan tahun konservasi..." {{$old->status_konservasi_tahun}}>
                            </div>
                            <div class="form-group">
                                <label>Upaya konservasi</label>
                                <textarea class="form-control" name="upaya_konservasi" placeholder="Masukkan upaya konservasi...">{{$old->upaya_konservasi}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control" multiple name="foto">
                            </div>
                            <div class="form-group">
                                <label>Komentar</label>
                                <textarea class="form-control" name="komentar" placeholder="Masukkan komentar...">{{$old->komentar}}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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

    });
</script>
@endpush