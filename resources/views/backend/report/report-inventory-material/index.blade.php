@extends('backend.layouts.app')

@section('style')
@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('backend.departements.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background-color: #2a3042dc !important; border-radius:10px 10px 0px 0px;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 mt-1 text-white" style="font-size:1.2rem;">
                            <span class="tx-bold tx-dark text-white text-lg">
                                <i class="far fa-building text-lg"></i>
                                {{-- {{$page_title}} --}}
                            </span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            @include('backend.components.flash-message')
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="date">Date</label>
                                        <input class="form-control @error('date') is-invalid @enderror" type="month" name="start_date" value="{{ date('Y-m', strtotime(Request::get('start_date') ?? date('Y-m'))) }}">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="">&nbsp</label>
                                        <div class="d-flex flex-wrap gap-3">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </form>    
                        <div style="margin-top: 20px;">
                            <div>
                                <p class="tx-black" style="display: inline;">Download :</p>
                            </div>
                                <a href="{{ route('backend.report-inventory-material-export') }}" class="btn btn-sm btn-danger">
                                    PDF
                                </a>
                            {{-- <div id="buttons" style="padding: 10px; margin-bottom: 10px; width: 100%; border-radius:5px; display:inline;"></div> --}}
                        </div>
                        <table class="table datatable table-hover" id="reportTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Begin Stock</th>
                                    <th>Total Stock</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach ($inventory_material as $inventory_materials)
                                <tr >
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-Y', strtotime($inventory_materials->created_at));}}</td>
                                    <td>{{ $inventory_materials->product->name ?? ''}}</td>
                                    <td>{{ $inventory_materials->begin_stock ?? ''}}</td>
                                    <td>{{ $inventory_materials->begin_stock ?? ''}}</td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('backend/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.print.min.js') }}"></script> 

{{-- <script>
    // $(document).ready(function() {
    //     var table = $('#reportTable').DataTable( {
    //         lengthChange: false,
    //         buttons: [ 'pdf', 'print', 'pdf']
    //     } );
     
    //     table.buttons().container()
    //         .appendTo( '#reportTable_wrapper .col-md-6:eq(0)' );
    // } );
    $(document).ready(function () {
     $("#reportTable").DataTable({
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"]
    }).buttons().container().appendTo("#reportTable_wrapper .col-md-6:eq(0)"),
     $(".dataTables_length select").addClass("form-select form-select-sm")
});
</script> --}}

<script>
    var table = $('.datatable').DataTable();

    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
        //     {
        //     extend: 'pdfHtml5',
        //     title   : 'Alarm Backup',
        //     orientation: 'potrait',
        //     pageSize: 'A4',
        //     className: 'btn btn-danger btn-sm btn-corner',
        //     text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
        //     titleAttr: 'Download as PDF',
        //     customize: function (doc) {
        //         doc.content.splice(0, 0, {
        //             margin: [0, 0, 0, 12],
        //             alignment: 'center',
        //             image: getBase64Image(myGlyph),
        //             width: 140,
        //             height: 40,
        //         });
        //     }
        // }, 
        {
            extend: 'print',
            text: '<i class="fas fa-print"></i>&nbsp; Print',
            title: 'List WO',
            className: 'btn btn-danger btn-sm btn-corner',
            titleAttr: 'Download as Excel',
            exportOptions: {
            columns: ':visible'
            }
        }],
    }).container().appendTo($('#buttons'));
</script>
@endsection