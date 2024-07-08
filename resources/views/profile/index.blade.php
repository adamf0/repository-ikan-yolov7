@extends('template')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map { min-height: 600px; }
</style>
@stop

@section('content')
    <!-- Hero -->
    <section class="bg-hero">
        <div class="bg-overlay">
            <div class="spacer-header"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">Profile </h1>
                    </div>
                </div>
            </div>
            <div class="spacer"></div>
        </div>
    </section>

    <!-- Data Profile -->
    <div class="container py-5 text-light">
        <div class="spacer"></div>
        <hr>
        <div class="row">
            <div class="col-12 text-center">
                <div class="d-flex justify-content-center mb-3">
                    <div style="width: 160px; height: 160px; border-radius: 50%; overflow: hidden;" class="shadow">
                        <img style="width: 100%; height: 100%; object-fit: cover;"
                            src="{{empty($profile->foto)? 'https://bootdey.com/img/Content/avatar/avatar7.png':\App\Helper\Utility::loadAsset('dokumen_foto/'.$profile->foto)}}" alt="" onerror="this.src='https://bootdey.com/img/Content/avatar/avatar7.png';">
                    </div>
                </div>
                <h5 style="text-shadow: 2px 2px 4px #010351;" class="text-white">{{empty($profile->nama)? '-':$profile->nama}}</h5>
                <p>{{empty($profile->negara)? '-':$profile->negara}}</p>
            </div>
            <div class="col-12 col-md-6">
                <table class="table text-light table-dark table-bordered table-striped table-hover">
                    <tr>
                        <td>Nama Lengkap</td>

                        <td>{{ $profile->nama }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>

                        <td>{{ $profile->email }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>

                        <td>{{ $profile->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td>Instansi</td>

                        <td>{{ $profile->instansi }}</td>
                    </tr>
                    <tr>
                        <td>Bidang Keahlian</td>

                        <td>{{ $profile->bidang_keahlian }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><a class="btn btn-warning" href="{{route('profile.edit')}}">Edit</a></td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <div id="map" width="100%" height="206" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></div>
            </div>
        </div>
    </div>

@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var map = L.map('map').setView([-6.200000, 106.816666], 5); // Set the view to a specific location and zoom level

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);
        @if(!empty($profile->latitude) && !empty($profile->longitude))
            L.marker([`{{$profile->latitude}}`,`{{$profile->longitude}}`]).addTo(map);
        @endif

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
        });
    });
</script>
@stop