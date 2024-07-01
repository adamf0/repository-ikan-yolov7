@extends('template_admin')

@section('page-title')
<x-page-title title="Dashboard">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</x-page-title>
@stop

@section('content')
<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/Calendar-Heatmap-Plugin-jQuery/jquery.CalendarHeatmap.css">
<style>
    .ch-day {
        min-width: 24px;
        min-height: 24px;
        border: 1px solid #fff;
        background-color: #dfdfe0;
        margin: 3px;
    }

    .ch-week {
        width: min-content;
    }

    .ch-month {
        margin: 0 auto;
    }

    .ch-year {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }

    .ch {
        display: flex;
        flex-direction: column;
        width: -webkit-fill-available;
    }
</style>
<div class="row">
    @if ($level=="sdm")
    <div class="col-12">
        <div class="alert alert-success">Selamat datang Admin</div>
    </div>
    <div class="col-4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Total Pengguna</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-row flex-wrap flex-grow-1 align-items-center placeholder-glow">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-file-earmark-x fs-1"></i>
                            </div>
                            <div class="mx-3 pt-3">
                                <h6>{{$total_pengguna}}</h6>
                                <span class="{{$detail_pengguna<0? 'text-danger':'text-success'}} small pt-1 fw-bold">{{$detail_pengguna}}%</span>
                                <span class="text-muted small pt-2 ps-1">{{$detail_pengguna<0? "berkurang":"bertambah"}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Total Project</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-row flex-wrap flex-grow-1 align-items-center placeholder-glow">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-file-earmark-x fs-1"></i>
                            </div>
                            <div class="mx-3 pt-3">
                                <h6>{{$total_project}}</h6>
                                <span class="{{$detail_project<0? 'text-danger':'text-success'}} small pt-1 fw-bold">{{$detail_project}}%</span>
                                <span class="text-muted small pt-2 ps-1">{{$detail_project<0? "berkurang":"bertambah"}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div id="info_persebaran_pengguna"></div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <h5 class="text-center fw-bold">Informasi Aktifitas Project<br>2024</h5>
        <div id="info_aktifitas_project"></div>
    </div>
    <div class="col-12">
        <div id="info_pendaftaran_pengguna"></div>
    </div>
    @else
    <div class="col-12">
        <div class="alert alert-success">
            @if ($user->setup_profile)
                Selamat datang {{ $user->nama }} di Fishiden
            @else
                Selamat datang di Fishiden        
            @endif
        </div>
    </div>
    @if (!$user->setup_profile)
        <div class="col-12">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2 d-none d-sm-block">
                            <img src="https://www.urbanbrush.net/web/wp-content/uploads/edd/2024/05/pro-20240528115103614184.png" alt="ilustrasi" class="w-100">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                            <h5 class="card-title fs-3">kami tidak dapat mengenali anda</h5>
                            <p class="card-description fs-5">tolong lengkapi data pribadi agar kami bisa mengetahui siapa anda</p>
                            <a href="{{route('profile.index')}}" class="btn btn-success">Buka Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endif
</div>
@stop

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/sunburst.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://www.jqueryscript.net/demo/Calendar-Heatmap-Plugin-jQuery/jquery.CalendarHeatmap.min.js"></script>

<script>
    $(document).ready(function() {
        @if ($level=="sdm")
            const resource1 = {!! $info_persebaran_pengguna !!};

            console.log(Highcharts.getOptions().colors)
            Highcharts.chart('info_persebaran_pengguna', {
                chart: {
                    height: '100%'
                },
                colors: ['#1d6b1dd9'].concat(Highcharts.getOptions().colors),
                title: {
                    text: 'Informasi Pengguna'
                },
                series: [{
                    type: 'sunburst',
                    data: resource1,
                    name: 'Root',
                    allowDrillToNode: true,
                    borderRadius: 3,
                    cursor: 'pointer',
                    levels: [{
                            level: 1,
                            levelIsConstant: false,
                        }, {
                            level: 2,
                            colorByPoint: true
                        },
                        {
                            level: 3,
                            colorVariation: {
                                key: 'brightness',
                                to: -0.5
                            }
                        }, {
                            level: 4,
                            colorVariation: {
                                key: 'brightness',
                                to: 0.5
                            }
                        }
                    ]
                }],
                tooltip: {
                    headerFormat: '',
                    pointFormat: '{point.value}</b>'
                }
            });

            var resource2 = {!! $info_aktifitas_project !!};
            $("#info_aktifitas_project").CalendarHeatmap(resource2, {

                // title of the calendar heatmap
                title: null,

                // the number of months to display
                months: 12,

                // the first day of the week: 1 is Monday
                weekStartDay: 1,

                // or rounded, circle
                tiles: {
                shape: "square"
                },

                // last month
                lastMonth: moment().month() + 1,

                // last year
                lastYear: moment().year(),

                // color gradients
                coloring: null,

                // custom labels
                labels: {
                days: false,
                months: true,
                custom: {
                    weekDayLabels: null,
                    monthLabels: null
                }
                },

                // custom legend
                legend: {
                show: true,
                align: "right",
                minLabel: "Less",
                maxLabel: "More",
                divider: " to "
                },

                // custom tooltips
                // requires <a href="https://www.jqueryscript.net/tags.php?/Bootstrap/">Bootstrap</a>
                tooltips: {
                show: false,
                options: {}
                }

            });

            const series1 = {!! $info_pendaftaran_pengguna !!};
            series1.forEach(series => {
                series.data = series.data.map(point => {
                    const [yearMonth, value] = point;
                    const [year, month] = yearMonth.split('-').map(Number);
                    return [Date.UTC(year, month - 1), value];
                });
            });
            
            Highcharts.chart('info_pendaftaran_pengguna', {
                title: {
                    text: 'Info Pendaftaran Pengguna<br>12 bulan terakhir',
                    align: 'center'
                },
                xAxis: {
                    type: 'datetime',
                    dateTimeLabelFormats: {
                        month: '%b %Y'
                    },
                    title: {
                        text: 'Tahun-Bulan'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Total Daftar'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        }
                    },
                },
                series: series1,
                tooltip: {
                    formatter: function () {
                        return '<b>' + this.series.name + '</b><br/>' +
                            this.y + ' Orang';
                    }
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
        @endif

    });
</script>
@endpush