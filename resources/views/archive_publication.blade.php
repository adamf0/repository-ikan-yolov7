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
                        <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">Archive of scientific
                            publications</h1>
                    </div>
                </div>
            </div>
            <div class="spacer"></div>
        </div>
    </section>

    <!-- Data -->
    <div class="container py-5">
        <table id="tb" class="w-full table text-light table-dark table-sm table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-start">Publication Year</th>
                    <th class="align-middle">Full Citation</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td class="text-center">2004</td>
                    <td>Zhu, Longhuan, P Xue, GA Meadows, Ch Huang, J Ge, CD Troy and CH Wu. Trends of Sediment
                        Resuspension and Budget in Southern Lake Michigan Under Changing Wave Climate and Hydrodynamic
                        Environment. JGR Oceans. doi.org/10.1029/2023JC020180</td>
                </tr> -->
            </tbody>
        </table>
    </div>
@stop

@section('script')
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function(){
        $("#tb").DataTable({
            ajax: {
                url: `{{route('datatable.ArchivePublicaton.index')}}`,
                method: "GET"
            },
            serverSide: true,
            processing: true,
            responsive: true,
            columns: [
                {
                    data:"tahun",
                    name:"tahun",
                },
                {
                    data:"arsip_custom",
                    name:"arsip_custom",
                },
            ],
            // rowCallback: rowCallback,
            // drawCallback: drawCallback,
            initComplete: function() {
                $("input[type='search']").wrap("<form>");
                $("input[type='search']").closest("form").attr("autocomplete","off");
            },
            paging: true,
            autoFill: true
        });
    });
</script>
@stop