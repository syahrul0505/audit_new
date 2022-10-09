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
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="">{{ ($breadcumb ?? '') }}</a>
                    </li>
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
            <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <div class="row">
                    <div class="col-6 mt-1">
                        <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
                            <i class="far fa-user text-lg"></i>
                            {{$page_title}}
                        </span>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        {{-- @include('components.flash-message') --}}
                    </div>
                </div>
            </div>

                <div class="card-body">
                    <div class="">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-4">
                                    {{-- <div class="form-group">
                                        <label>Auto Close</label>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" class="form-control" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-container='#datepicker2'
                                            data-provide="datepicker" data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div> --}}
                                    <div class="form-group mb-3">
                                        <label for="date">Date</label>
                                        <input class="form-control @error('date') is-invalid @enderror" type="date" name="start_date" value="{{ date('Y-m-d', strtotime(Request::get('start_date') ?? 'today')) }}">
                                    </div>
                                </div>

                                {{-- <!-- <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="">WO No</label>
                                        <select class="form-select @error('wo_no') is-invalid @enderror" name="wo_no">
                                            <option value="all" {{Request::get('wo_no') == 'all' ? 'selected' : ''}}>All</option>
                                            @foreach ($work_order as $work_orders)
                                                <option value="{{ $work_orders->id }}"
                                                    {{Request::get('wo_no') == $work_orders->id ? 'selected' : ''}}>
                                                    {{ $work_orders->wo_no }}</option>
                                            @endforeach
                                        </select>
                                        @error('descripion_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --> --}}

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="">WO No</label>
                                        <select class="form-select @error('wo_no') is-invalid @enderror" name="wo_no">
                                            <option value="all" >All</option>
                                            <option value="all" >Aldi</option>
                                            <option value="all" >Tasya</option>
                                           
                                        </select>
                                        @error('descripion_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                    </div> 
                    <div class="table-responsive">                          
                        <table class="table table-striped datatable table-hover">
                            {{-- <p class="tx-black" style="display: inline;">Download :</p>
                                <div id="buttons" style="padding: 10px; margin-bottom: 10px; width: 100%; border-radius:5px; display:inline;"></div> --}}
                            <thead>
                                <tr style="border: 5px solid">
                                <th>No</th>
                                <th>Name</th>
                                <th>Approval</th>
                                <th>Date</th>
                                <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr style="border: 5px solid">
                                  
                                </tr>
                            </tbody>
                        </table>
                    </div>
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


<script>
    var table = $('.datatable').DataTable();

    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
        //     {
        //     extend: 'pdfHtml5',
        //     title: 'Alarm Backup',
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

<link rel="stylesheet" href="{{asset('backend/libs/datepicker/datepicker.min.css')}}">
<link href="{{asset('backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">

<script src="{{ asset('backend/libs/datepicker/datepicker.min.js')}}"></script>
@endsection
 