@extends('template_admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                Selamat datang di Repository Ikan
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@stop

@push('scripts')
<script>
    $(document).ready(function() {
        let table = $('#tb').DataTable({
            pageLength: 10,
            filter: true,
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true,
            "searching": true,
        });
    });
</script>
@endpush