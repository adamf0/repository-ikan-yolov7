@extends('template_admin')
 
@section('page-title')
    <x-page-title title="Arsip Publikasi">
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('arsip_publikasi.index') }}">Arsip Publikasi</a></li>
            <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </x-page-title>
@stop

@section('content') 
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    {{ \App\Helper\Utility::showNotif() }}
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('arsip_publikasi.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label>Url Arsip Publikasi</label>
                                            <input type="text" class="form-control" name="url" placeholder="Masukkan url arsip publikasi..." value="{{old('url')}}">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Arsip</label>
                                            <textarea name="arsip" rows="10" cols="30" class="form-control">{{old('arsip')}}</textarea>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Tahun</label>
                                            <input type="text" class="form-control" name="tahun" placeholder="Masukkan tahun publikasi..." value="{{old('tahun')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush