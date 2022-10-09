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

                        @can('departement-create')
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('backend.absen.create') }}" class="btn btn-md btn-info">
                                <i class="fa fa-plus"></i> 
                                Add New
                            </a>
                        </div>
                        @endcan
                    </div>

                    <div class="row">
                        <div class="col-6">
                            @include('backend.components.flash-message')
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <div style="margin-top: 20px;">
                            {{-- <form action="{{ route('backend.report-absen-export') }}" method="POST">
                                @csrf
                                <div>
                                    <p class="tx-black" style="display: inline;">Download :</p>
                                </div>
                                <div>
                                <button class="btn btn-sm btn-danger">PDF</button>
                                </div>
                            </form>   --}}
                            {{-- <div id="buttons" style="padding: 10px; margin-bottom: 10px; width: 100%; border-radius:5px; display:inline;"></div> --}}
                        </div>
                        <table class="table table-hover" id="reportTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Tanda Tangan</th>
                                    <th>Description</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($absen as $absens)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $absens->name}}</td>
                                    <td>{{ $absens->date}}</td>
                                    <td><img src="{{ asset('storage/'. $absens->ttd .'.jpg') }}" alt="" width="30%"></td>
                                    <td>{{ $absens->description }}</td>
                                   
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

<script>
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
</script>
@endsection