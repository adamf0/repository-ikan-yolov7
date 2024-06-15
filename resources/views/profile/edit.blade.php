@extends('template_admin')
 
@section('page-title')
    <x-page-title title="Profile">
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profile</a></li>
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
                            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$old->id}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap..." value="{{$old->nama}}" required>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Masukkan email..." value="{{$old->email}}" required>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                            <label>Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan" placeholder="Masukkan pekerjaan..." value="{{$old->pekerjaan}}">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                            <label>Instansi</label>
                                            <input type="text" class="form-control" name="instansi" placeholder="Masukkan instansi..." value="{{$old->instansi}}">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                            <label>Negara</label>
                                            <input type="text" class="form-control" name="negara" placeholder="Masukkan negara..." value="{{$old->negara}}">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                            <label>Lokasi</label>
                                            <input type="hidden" name="lokasi" id="lokasi">
                                            <div id="map"></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                            <label>Bidang Keahlian</label>
                                            <input type="text" class="form-control" name="bidang_keahlian" placeholder="Masukkan bidang keahlian..." value="{{$old->bidang_keahlian}}">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                            <label>Foto</label>
                                            <input type="file" class="form-control" name="foto">
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
            var map = L.map('map').setView([51.505, -0.09], 13); // Set the view to a specific location and zoom level

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

            map.on('click', function(e){
                var coord = e.latlng;
                var lat = coord.lat;
                var lng = coord.lng;
                map.eachLayer((layer) => {
                    if (layer instanceof L.Marker) {
                        layer.remove();
                    }
                });
                
                L.marker([lat, lng]).addTo(map);
                $('#lokasi').val(`${lat},${lng}`)
            });
        });
    </script>
@endpush