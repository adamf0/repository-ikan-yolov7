@extends('template')
 
@section('css')
<style>
/*page 2*/
*{
    --primary: #136c72;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-radius: 10px;
  padding: 10px;
}
.grid{
    display: grid;
    grid-template-columns: repeat(2, minmax(10vmax, 1fr));
    grid-gap: 50px;
    padding: 10px;
}
.box{
    background: var(--primary);
    padding: min(8vmax, 80px) 0;
    font-size: 22px;
    color: white;
    opacity: .8;
    border-radius: 10px;
}
.box--icon{
    font-size: 54px;
    margin-bottom: 20px;
}

.section2{
    padding: 50px 0;
    text-align: left;
}

.content__section--grid{
    display: grid;
    grid-template-columns: repeat(1, minmax(10vmax, 1fr));
    /* grid-auto-rows: 1fr; */
    grid-template-areas: 
        "klasifikasi"
        "taksonomi"
        "karakteristik"
        "genom"
        "status"
        "filogenetik upaya";
    grid-column-gap: 5px;
    grid-row-gap: 20px;

    & * > h3{
        font-size: 1.7rem;
        color: var(--primary);
    }
    & * > h5{
        font-size: 1.2rem;
        color: var(--primary);
        text-transform: uppercase;
    }
    & * > p{
        font-size: .9rem;
        color: #3b3b3b;
    }

    & * > table{
        & tr{
            & td:nth-child(2)::before {
                content: ":";
                display: inline-block;
                margin-right: 5px;
            }
        }
    }

    & * > ol {
        list-style: none;
        counter-reset: item; /*(variable, init)*/

        & li{
            counter-increment: item;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        & li::before {
            margin-right: 5px;
            content: counter(item);
            background: var(--primary);
            border-radius: 100%;
            color: white;
            width: 1.5rem;
            height: 1.5rem;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
    }

    & div[data-area]::before {
        grid-area: attr(data-area);
    }
}
.klasifikasi{
    width: -webkit-fill-available;
    max-height: 500px;
    /* height: 40vmax; */
    object-fit: fill;
}
.content--image{
    width: 70%;
    max-height: 400px;
    margin: 0 auto 20px auto;

    display: block;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
}
@media (min-width: 750px){
    .content__section--grid{
        grid-template-columns: repeat(2, minmax(10vmax, 1fr));
        grid-template-areas: 
        "klasifikasi klasifikasi"
        "taksonomi karakteristik"
        "genom status" 
        "filogenetik upaya";
    }

    & div[data-area="klasifikasi"] {
        grid-column: span 2;
    }

    .klasifikasi{
        width: -webkit-fill-available;
        max-height: 400px;
        /* height: 40vmax; */
    }
}

.bullet__point{
    border-radius: 100%;
    width: 1.5rem;
    height: 1.5rem;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-items: center;
    justify-content: center;
    font-size: 0.9rem;
}
.bullet__point[data-point="EX"]{
    background-color: black;
    color: red;
}
.bullet__point[data-point="EW"]{
    background-color: #552444;
    color: white;
}
.bullet__point[data-point="CR"]{
    background-color: #d81f07;
    color: white;
}
.bullet__point[data-point="EN"]{
    background-color: #fc7f40;
    color: black;
}
.bullet__point[data-point="VU"]{
    background-color: #f9e812;
    color: black;
}
.bullet__point[data-point="NT"]{
    background-color: #cce225;
    color: black;
}
.bullet__point[data-point="LC"]{
    background-color: #61c658;
    color: black;
}
.bullet__point[data-point="DD"]{
    background-color: #d1d1c5;
    color: black;
}
.bullet__point[data-point="NE"]{
    background-color: white;
    border: 1px solid black;
    color: black;
}

.highlight{
    font-weight: 600;
    color: black;
}
.text-break{
    word-break: break-all;
}
.ucfirst{
    text-transform: capitalize;
}

/*end page 2*/
</style>
@stop

@section('content')
<section class="section2">
        <div class="container">
            <img src="{{ \App\Helper\Utility::loadAssetbase64($image) }}" class="content--image" alt="hasil prediksi"/>
            
            @foreach ($classification as $klasifikasi => $item)
            <div class="card content__section--grid">
                <div data-area="klasifikasi">
                    <h3>{{$klasifikasi}}</h3>
                    <img src='{{$item["foto"]}}' class="klasifikasi" alt="gambar ikan">
                </div>

                <div data-area="taksonomi">
                    <h5>Taksonomi</h5>
                    <table>
                        <tr>
                            <td>Kingdom</td>
                            <td class="ucfirst text-break">{{$item["kerajaan"]}}</td>
                        </tr>
                        <tr>
                            <td>Phylum</td>
                            <td class="ucfirst text-break">{{$item["filum"]}}</td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td class="ucfirst text-break">{{$item["kelas"]}}</td>
                        </tr>
                        <tr>
                            <td>Order</td>
                            <td class="ucfirst text-break">{{$item["ordo"]}}</td>
                        </tr>
                        <tr>
                            <td>Family</td>
                            <td class="ucfirst text-break">{{$item["famili"]}}</td>
                        </tr>
                        <tr>
                            <td>Genus</td>
                            <td class="ucfirst text-break">{{$item["genus"]}}</td>
                        </tr>
                        <tr>
                            <td>Species</td>
                            <td class="ucfirst text-break highlight">{{$item["spesies"]}}</td>
                        </tr>
                    </table>
                </div>
                
                <div data-area="karakteristik">
                    <h5>Karakteristik</h5>
                    <ol class="circle">
                        @foreach ($item["karakteristik"] as $karakteristik)
                        <li class="ucfirst text-break">{{$karakteristik}}</li>
                        @endforeach
                    </ol>
                </div>

                <div data-area="genom">
                    <h5>Data Genom</h5>
                    <p highlight="true">{{$item["genom"]}}</p>
                </div>

                <div data-area="status">
                    <h5>Status Konservasi</h5>
                    <p><span class="bullet__point" data-point='{{$item["status_konservasi"]}}'>{{$item["status_konservasi"]}}</span> {{\App\Helper\Utility::deskripsiStatus($item["status_konservasi"])}}</p>
                </div>

                <div data-area="filogenetik">
                    <h5>Pohon Filogenetik</h5>
                    <div id="filogenetik"></div>
                </div>

                <div data-area="upaya">
                    <h5>Upaya Konservasi</h5>
                    <p>{{$item["upaya_konservasi"]}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@stop

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/treegraph.js"></script>
<script src="{{ \App\Helper\Utility::loadAsset('data-filogenetik.js') }}"></script>
<script>
    $(document).ready(function(){
        const navToggle = document.querySelector('.nav-toggle');
        const nav = document.querySelector('.nav');


        navToggle.addEventListener('click', () => {
            nav.classList.toggle('nav--visible');
        })

        Highcharts.chart('filogenetik', {
            credits: {
                enabled: false
            },
            chart: {
                spacingBottom: 30,
                marginRight: 120,
                height: 1200
            },
            title: {
                text: ''
            },
            series: [
                {
                    type: 'treegraph',
                    clip: false,
                    data: data,
                    ooltip: {
                        pointFormat: '{point.name}'
                    },
                    marker: {
                        symbol: 'circle',
                        radius: 6,
                        fillColor: '#ffffff',
                        lineWidth: 3
                    },
                    dataLabels: {
                        align: 'left',
                        pointFormat: '{point.name}',
                        style: {
                            color: '#000000',
                            textOutline: '3px #ffffff',
                            whiteSpace: 'nowrap'
                        },
                        x: 24,
                        crop: false,
                        overflow: 'none'
                    },
                    levels: [
                        {
                            level: 1,
                            levelIsConstant: false
                        },
                        {
                            level: 2,
                            colorByPoint: true
                        },
                        // {
                        //     level: 3,
                        //     colorVariation: {
                        //         key: 'brightness',
                        //         to: -0.5
                        //     }
                        // },
                    ]
                }
            ]
        });
    });
</script>
@stop