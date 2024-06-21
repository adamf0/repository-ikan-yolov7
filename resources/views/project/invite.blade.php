<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fishiden | Invite Project</title>
    <link href="{{ \App\Helper\Utility::loadAsset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light py-3 py-md-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                @php
                $image = match($type){
                'success'=>'https://bootstrapbrain.com/demo/components/facts/fact-3/assets/img/fact-img-1.webp',
                'expire'=>'https://cdns.klimg.com/merdeka.com/i/w/news/2012/11/10/113499/540x270/5-alasan-kenapa-anda-selalu-terlambat.jpg',
                default=>'https://glints.com/id/lowongan/wp-content/uploads/2022/01/berbuat-kesalahan-di-tempat-kerja-akui-kesalahan.jpg',
                };
                @endphp
                <img class="img-fluid rounded" loading="lazy" src="{{$image}}" alt="Our Success">
            </div>
            <div class="col-12 col-lg-6">
                <div class="row justify-content-xl-end">
                    <div class="col-12 col-xl-11">
                        <div class="row gy-4 gy-sm-0 overflow-hidden">
                            <div class="col-12">
                                <div class="card border-0 border-bottom border-primary shadow-sm mb-4">
                                    <div class="card-body text-center p-4 p-xxl-5">
                                        <!-- <h3 class="display-2 fw-bold mb-2"></h3> -->
                                        <p class="fs-5 mb-0 text-secondary">
                                            {{$message}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>