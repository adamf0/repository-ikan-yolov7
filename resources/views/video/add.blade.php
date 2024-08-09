@extends('template_admin')
 
@section('page-title')
    <x-page-title title="Video">
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('video.index') }}">Video</a></li>
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
                            <form action="{{route('video.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label>Url Video</label>
                                            <input type="text" class="form-control" name="url" placeholder="Masukkan url video..." value="{{old('url')}}">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Kategori</label>
                                            <select class="form-control" id="kategori" name="kategori"></select>
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
    <script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#kategori").select2({
                theme: 'bootstrap-5',
                data: [],
                tags: true,
                placeholder: "Masukkan kategori video",
            }).val("{{old('kategori')}}").trigger("change");
        });
    </script>
@endpush