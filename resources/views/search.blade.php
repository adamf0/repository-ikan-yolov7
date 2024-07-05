@extends('template')
 
@section('css')
<style>

</style>
@stop

@section('content')
    <!-- Data -->
    <div class="container py-5 text-light">
        <hr>
        <div class="row g-1 mb-3">
            @if (strtolower($ikan->status_konservasi)=="ne")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">NOT EVALUATED</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">NE</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: #666666">
                    <div style="height: 40px;" class="font-small border-bottom">NOT EVALUATED</div>
                    <div class="fw-bold">NE</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="dd")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">DATA DEFICIENT</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">DD</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: #999999; color: black">
                    <div style="height: 40px;" class="font-small border-bottom">DATA DEFICIENT</div>
                    <div class="fw-bold">DD</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="lc")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">LEAST CONCERN</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">LC</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: #cc3333; color: white">
                    <div style="height: 40px;" class="font-small border-bottom">LEAST CONCERN</div>
                    <div class="fw-bold">LC</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="nt")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">NEAR THREATENED</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">NT</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: #cc6633; color: white">
                    <div style="height: 40px;" class="font-small border-bottom">NEAR THREATENED</div>
                    <div class="fw-bold">NT</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="vu")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">VULNERABLE</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">VU</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: #cc9900; color: white">
                    <div style="height: 40px;" class="font-small border-bottom">VULNERABLE</div>
                    <div class="fw-bold">VU</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="en")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">ENDANGERED</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">EN</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: #006666; color: white">
                    <div style="height: 40px;" class="font-small border-bottom">ENDANGERED</div>
                    <div class="fw-bold">EN</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="cr")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">CRITICAL ENDANGERED</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">CR</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: #006666; color: white">
                    <div style="height: 40px;" class="font-small border-bottom">CRITICAL ENDANGERED</div>
                    <div class="fw-bold">CR</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="ew")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">EXTINCT IN THE WILD</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">EW</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: black;">
                    <div style="height: 40px;" class="font-small border-bottom">EXTINCT IN THE WILD</div>
                    <div class="fw-bold">EW</div>
                </div>
            </div>
            @endif

            @if (strtolower($ikan->status_konservasi)=="ex")
            <div class="col-6 col-md-2">
                <div class="rounded-2 border bg-light text-dark p-1 text-center h-100 position-relative">
                    <div style="height: 40px;" class="hstack border-bottom border-dark justify-content-between">
                        <div class="font-small">EXTINCT</div>
                        <img width="32" height="32" src="http://www.fishiden.com/red%20list.png" alt="">
                    </div>
                    <div class="hstack gap-2 justify-content-center">
                        <div class="fw-bold">EX</div>
                        <div class="fw-small">{{$ikan->status_konservasi_tahun}}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-3 col-md">
                <div class="rounded-2 border p-1 text-center h-100" style="background: black; color: #cc3333">
                    <div style="height: 40px;" class="font-small border-bottom">EXTINCT</div>
                    <div class="fw-bold">EX</div>
                </div>
            </div>
            @endif
        </div>
        <div class="row gy-3 mb-3">
            <div class="col-12 col-md-6">
                <div class="bg-glass p-3 rounded-3">
                    <h5 style="text-shadow: 2px 2px 4px #010351;" class="text-white mb-3">{{$ikan->spesies}}</h5>
                    <div class="text-center">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @for ($i=0; $i<count($ikan->foto);$i++)
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}" class="active" aria-current="true" aria-label="Slide {{$i+1}}"></button>    
                                @endfor
                            </div>
                            <div class="carousel-inner">
                                @foreach ($ikan->foto as $foto)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img src="{{$foto}}" class="d-block img-fluid rounded-2 w-100" style="height: 600px">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <h5 class="text-heading">
                    TAKSONOMI
                </h5>

                <table class="table text-light table-dark table-sm table-bordered table-striped table-hover font-small">
                    <tr>
                        <td>Kategori</td>

                        <td>{{$ikan->kategori}}</td>
                    </tr>
                    <tr>
                        <td>Kingdom</td>

                        <td>{{$ikan->kingdom}}</td>
                    </tr>
                    <tr>
                        <td>Fillum</td>

                        <td>{{$ikan->fillum}}</td>
                    </tr>
                    <tr>
                        <td>Super Kelas</td>

                        <td>{{$ikan->super_kelas}}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>

                        <td>{{$ikan->kelas}}</td>
                    </tr>
                    <tr>
                        <td>Ordo</td>

                        <td>{{$ikan->ordo}}</td>
                    </tr>
                    <tr>
                        <td>Familia</td>

                        <td>{{$ikan->famili}}</td>
                    </tr>
                    <tr>
                        <td>Genus</td>

                        <td>{{$ikan->genus}}</td>
                    </tr>
                    <tr>
                        <td>Nama Daerah</td>

                        <td>{{$ikan->nama_daerah}}</td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>

                        <td>{{$ikan->pengarang}}</td>
                    </tr>
                </table>

                <h5 class="text-heading">
                    ID GENOM
                </h5>
                <p style="word-wrap: break-word;" class="font-small">
                {{$ikan->id_genom}}
                </p>

                <h5 class="text-heading">
                    INFORMASI DETAIL
                </h5>

                <table class="table text-light table-dark table-sm table-bordered table-striped table-hover font-small">
                    <tr>
                        <td>Kemunculan</td>

                        <td>{{$ikan->kemunculan}}</td>
                    </tr>
                    <tr>
                        <td>Panjang Maksimal</td>

                        <td>{{$ikan->panjang_maksimal}}</td>
                    </tr>
                    <tr>
                        <td>Distribusi</td>

                        <td>{{$ikan->distribusi}}</td>
                    </tr>
                    <tr>
                        <td>Habitat</td>

                        <td>{{$ikan->habitat}}</td>
                    </tr>
                    <tr>
                        <td>Komentar</td>

                        <td>{!!$ikan->komentar!!}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="bg-glass rounded-3 p-3">
            <div class="row gy-3">
                <div class="col-12 col-md-6 karakteristik">
                    <h5 class="text-heading mb-3">
                        KARAKTERISTIK MORFOLOGI
                    </h5>
                    {!! $ikan->karakteristik_morfologi !!}
                </div>
                <div class="col-12 col-md-6 upaya_konservasi">
                    <h5 class="text-heading mb-3">
                        UPAYA KONSERVASI
                    </h5>
                    {!!$ikan->upaya_konservasi!!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/treegraph.js"></script>
<script src="{{ \App\Helper\Utility::loadAsset('data-filogenetik.js') }}"></script> -->
<script>
    $(document).ready(function(){
        ['karakteristik','upaya_konservasi'].forEach(function(item){
            $(`.${item} ol li`).each(function(index) {
                    const itemText = $(this).text();

                    const hstackDiv = $('<div>').addClass('hstack gap-2 align-items-start');

                    const numberDiv = $('<div>').addClass('d-block');

                    const circleDiv = $('<div>').css({
                        height: '24px',
                        width: '24px',
                        borderRadius: '50%'
                    }).addClass('bg-secondary d-flex align-items-center justify-content-center text-dark fw-bold')
                    .text(index + 1);

                    numberDiv.append(circleDiv);
                    hstackDiv.append(numberDiv);

                    const textParagraph = $('<p>').text(itemText);

                    hstackDiv.append(textParagraph);
                    $(`.${item}`).append(hstackDiv);
            });
            $(`.${item} ol`).remove();
        })
        
        // Highcharts.chart('filogenetik', {
        //     credits: {
        //         enabled: false
        //     },
        //     chart: {
        //         spacingBottom: 30,
        //         marginRight: 120,
        //         height: 1200
        //     },
        //     title: {
        //         text: ''
        //     },
        //     series: [
        //         {
        //             type: 'treegraph',
        //             clip: false,
        //             data: data,
        //             ooltip: {
        //                 pointFormat: '{point.name}'
        //             },
        //             marker: {
        //                 symbol: 'circle',
        //                 radius: 6,
        //                 fillColor: '#ffffff',
        //                 lineWidth: 3
        //             },
        //             dataLabels: {
        //                 align: 'left',
        //                 pointFormat: '{point.name}',
        //                 style: {
        //                     color: '#000000',
        //                     textOutline: '3px #ffffff',
        //                     whiteSpace: 'nowrap'
        //                 },
        //                 x: 24,
        //                 crop: false,
        //                 overflow: 'none'
        //             },
        //             levels: [
        //                 {
        //                     level: 1,
        //                     levelIsConstant: false
        //                 },
        //                 {
        //                     level: 2,
        //                     colorByPoint: true
        //                 },
        //                 // {
        //                 //     level: 3,
        //                 //     colorVariation: {
        //                 //         key: 'brightness',
        //                 //         to: -0.5
        //                 //     }
        //                 // },
        //             ]
        //         }
        //     ]
        // });
    });
</script>
@stop