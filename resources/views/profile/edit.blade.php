@extends('template')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map { min-height: 600px; }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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

    <!-- Konten -->
    <section class="bg-dark">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            {{ \App\Helper\Utility::showNotif() }}
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" id="form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$old->id}}">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 form-group">
                                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap..." value="{{old('nama',$old->nama)}}">
                                                    @error('nama')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="email" placeholder="Masukkan email..." value="{{old('email',$old->email)}}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                                    <label>Instansi</label>
                                                    <input type="text" class="form-control" name="instansi" placeholder="Masukkan instansi..." value="{{old('instansi',$old->instansi)}}">
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                                    <label>Pekerjaan <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pekerjaan" placeholder="Masukkan pekerjaan..." value="{{old('pekerjaan',$old->pekerjaan)}}">
                                                    @error('pekerjaan')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                                    <label>Bidang Keahlian</label>
                                                    <select class="form-control" id="bidang_keahlian" name="bidang_keahlian[]" multiple="multiple"></select>
                                                    <small class="text-primary">*ketik jika tidak ada di pilihan</small>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                                    <label>Negara <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="negara" name="negara"></select>
                                                    @error('negara')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                                    <label>Lokasi <span class="text-danger">*</span></label>
                                                    <input type="hidden" name="lokasi" id="lokasi" value="{{$old->latitude}},{{$old->longitude}}">
                                                    <div id="map"></div>
                                                    @error('lokasi')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxl-4 form-group">
                                                    <x-input-file title="foto" name="foto" accept="image/*" default="{{old('foto',$old->foto)}}"/>
                                                    <small class="text-primary">* Gambar yang boleh diupload</small><br>
                                                    <small class="text-primary">* Maksimal 10Mb</small>
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
        </div>
    </section>
@stop

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('my.js') }}"></script>
    <script>
        $(document).ready(function () {
            var map = L.map('map').setView([-6.200000, 106.816666], 5); // Set the view to a specific location and zoom level

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);
            @if(!empty($old->latitude) && !empty($old->longitude))
                L.marker([`{{$old->latitude}}`,`{{$old->longitude}}`]).addTo(map);
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
                $('#lokasi').val(`${lat},${lng}`)
            });

            function formatOption(option) {
                if (!option.id) {
                    return option.text;
                }
                var optionWithImage = $(
                    '<span><img src="' + option.flag + '" class="img-flag" style="width:45px"/> ' + option.text + '</span>'
                );
                return optionWithImage;
            }
            let list_keahlian = [
                {
                    id:"accountancy",
                    text:"accountancy",
                },
                {
                    id:"education",
                    text:"education",
                },
                {
                    id:"IT",
                    text:"IT",
                },
                {
                    id:"social care",
                    text:"social care",
                }, 
                {
                    id:"financial services",
                    text:"financial services",
                 }, 
                {
                    id:"engineering",
                    text:"engineering",
                },
                {
                    id:"business support",
                    text:"business support",
                }, 
                {
                    id:"healthcare",
                    text:"healthcare",
                },
                {
                    id:"construction",
                    text:"construction",
                },
                {
                    id:"property",
                    text:"property",
                },
                {
                    id:"sales",
                    text:"sales",
                },
            ];
            let selected = {!! json_encode(explode(",",$old->bidang_keahlian)??old('bidang_keahlian')) !!}
            const selectedFormat = selected.map((value) => ({
                "id":value,
                "text":value,
            }));
            const list_keahlian_merge = list_keahlian.concat(selectedFormat);
            const list_keahlian_unique = Array.from(new Set(list_keahlian_merge.map(a => a.id))).map(id => list_keahlian_merge.find(a => a.id === id));
            
            $.ajax({
                type: "GET",
                url: `{{route('select2.negara.list')}}`,
                data: {},
                dataType: 'json',
                accepts: 'json',    
                success: function (r1) {
                    $("#negara").select2({
                        theme: 'bootstrap-5',
                        dropdownParent: parent,
                        data: r1,
                        dropdownParent:"#form",
                        placeholder: "Masukkan negara asal",
                        templateResult: formatOption,
                        templateSelection: formatOption,
                    }).val(`{{old('negara',$old->negara)}}`).trigger("change");
                }
            });

            $("#bidang_keahlian").select2({
                theme: 'bootstrap-5',
                dropdownParent: parent,
                data: list_keahlian_unique,
                dropdownParent:"#form",
                tags: true,
                placeholder: "Masukkan bidang keahlian",
            }).val(selected).trigger("change");
        });
    </script>
@stop