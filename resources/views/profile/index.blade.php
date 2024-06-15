@extends('template_admin')

@section('page-title')
@stop

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map { min-height: 300px; }
</style>

<div class="row gutters-sm">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4>John Doe</h4>
                        <p class="text-secondary mb-1">Negara</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div id="map"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Nama Lengkap</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        Kenneth Valdez
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        fip@jukmuh.al
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Pekerjaan</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        -
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Instansi </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        -
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Bidang Keahlian</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        -
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-info" href="{{route('profile.edit')}}">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
        });
    });
</script>
@endpush