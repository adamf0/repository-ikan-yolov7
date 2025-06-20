@extends('template')

@section('css')
<style>
@media (max-width: 995px) {
    .image-container{
        height: 100px !important;
        width: -webkit-fill-available;
    }
    .vstack{
        font-size: clamp(.6rem, .6rem + 1vmax, 1.2rem);
    }
    .vstack>h5{
        font-size: clamp(.7rem, .7rem + 1.1vmax, 1.5rem);
    }
}
@media (max-width: 767px) {
    .vstack{
        height: 100px;
    }
}
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
                    <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">News Archive</h1>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
    </div>
</section>

<!-- Konten -->
@foreach ($news as $kategori => $items)
<div class="container py-5">
    <h5 class="text-heading text-white">{{!empty($kategori)? $kategori:"Tanpa Kategori"}}</h5>
    <hr style="border-top: white var(--bs-border-width) solid">
    <div class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-2">
        @foreach ($items as $item)
        <div class="col">
            <a href="{{!empty($item->url)? $item->url:route('news.detail',['id'=>$item->id])}}" target="_blank" class="text-decoration-none">
                <div class="card-news bg-light rounded-3 p-2" style="max-height: 215px;">
                    <div class="row gy-3">
                        <div class="col-sm-12 col-md-auto">
                            <div class="image-container rounded-2">
                                <img src="{{ \App\Helper\Utility::loadAsset('assets/img/ilustrasi_berita.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col" @if(empty($item->url)) style="height: 215px; overflow-y: hidden;" @endif>
                            <div class="vstack">
                                <!-- <span class="font-small">06/05/24</span> -->
                                <h5 class="fw-bold">{{$item->judul}}</h5>
                                <p class="mb-0">
                                    @if (empty($item->url))
                                    {!! $item->kontent_deskripsi !!}
                                    @else
                                    {!! $item->deskripsi !!}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endforeach
@stop

@section('script')
<script>
    $(document).ready(function() {

    });
</script>
@stop
