@extends('template')
 
@section('css')
<style>

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
                        <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">Videos</h1>
                    </div>
                </div>
            </div>
            <div class="spacer"></div>
        </div>
    </section>

    <!-- Konten -->
    @foreach ($video as $kategori => $items)
    <div class="container py-5">
        <h5 class="text-heading text-white">{{!empty($kategori)? $kategori:"Tanpa Kategori"}}</h5>
        <hr style="border-top: white var(--bs-border-width) solid">
        <div class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-2">
            @foreach ($items as $item)
            <div class="col">
                <div class="card-news bg-light rounded-3 p-2">
                    <div class="row gy-3">
                        <div class="col-sm-12">
                            <iframe style="width:100%; height: 400px;" src='{{str_replace("youtu.be","youtube.com/embed",$item->url)}}'></iframe>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
@stop

@section('script')
<script>
    $(document).ready(function(){
        
    });
</script>
@stop