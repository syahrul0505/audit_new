
@section('style')

@endsection



<!doctype html>
<html lang="en">
    
    <head>
    @include('backend.layouts.partials.head')
    </head>

    <body data-sidebar="dark">

        <!-- ========== Loader ========== -->
        {{-- <div class="loader d-flex justify-content-center">
            <img class="d-block my-auto" src="{{ asset('img/loader.gif') }}" width="250" height="auto" alt="">
        </div> --}}
        <!-- ========== End Loader ========== -->

<div id="layout-wrapper">

    <!-- ========== Navbar Start ========== -->
    {{-- @include('backend.layouts.partials.navbar') --}}
    <!-- ========== End Navbar Start ========== -->

    <!-- ========== Left Sidebar Start ========== -->
    {{-- @include('backend.layouts.partials.sidebar') --}}
    <!-- ========== End Left Sidebar Start ========== -->

    <!-- ========== Content Start ========== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @yield('breadcumb')

                <div class="row mt-2">
                    <div class="col-lg-12 col-xl-12 col-sm-12">
                        <div class="card card-primary" style="border-radius:18px;">
                            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                                <h3 class="card-title text-white">{{ $page_title }}</h3>
                            </div>
                            <form method="POST" action="{{ route('backend.vendor.store') }}" id="formPO">
                                @csrf
                                <div class="card-body">
                                    {{-- <h4 class="card-title text-center">{{$page_title}}</h4> --}}
                                    <h6> <small class="text-danger">*</small><b> Tanggal Kirim Sesuai Dengan tanggal surat jalan </b></h6>
                                    <hr>
                                    <div class="row mt-2">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <div class="row">
                                                    <div class="col-6">
                                                        @include('backend.components.flash-message')
                                                    </div>
                                                </div>
                                                <table class="table table-hover" id="contactTable">
                                                    <thead>
                                                        <tr>
                                                            {{-- <th>No Po</th> --}}
                                                            <th>No Po</th>
                                                            <th>Tanggal Po</th>
                                                            <th>No Inv</th>
                                                            <th>Tanggal Kirim</th>
                                                            {{-- <th>Status</th> --}}
                                                            {{-- <th>Description</th> --}}
                                                            <th>ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="No Po"  type="text" name="no_po[]" id="ponum">
                                                            </td>
                                                            <td>
                                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Tanggal Po"  type="date"  name="tanggal_po[]" id="po_date" >
                                                            </td>
                                                            <td>
                                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="No Invoice" type="text" name="no_invoice[]" id="qty1">
                                                            </td>
                                                            <td>
                                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Tanggal Kirim" type="date" name="tanggal_kirim[]" id="qty1">
                                                            </td>
                                                            {{-- <td>
                                                                <select class="form-select" id="">pending
                
                                                                    <option value="">Pending</option>
                                                                </select>
                                                            </td> --}}
                                                            {{-- <td>
                                                                <textarea name="description" id="" cols="30" rows="7" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                                                                @error('description')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            <td>  --}}
                                                            <td>
                                                                <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addField()">
                                                                    <i class="fas fa-plus-square"></i>
                                                                </button>
                                                                {{-- <span class="btn btn-primary" onclick="checkPO()">check</span> --}}
                                                            <td> 
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                
                                    @include('backend.components.form-message')
                                    <div class="row">
                                        <div class="col-lg-6">
                
                                            {{-- <div class="form-group mb-3">
                                                <label for="">No Po</label>
                                                <input class="form-control @error('po_number') is-invalid @enderror" type="text" name="po_number" >
                        
                                                @error('po_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> --}}
                
                                            <div class="col-lg-8">
                                                <div class="form-group mb-3">
                                                    <label for="">Email</label>
                                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" >
                            
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <div class="col-lg-8">
                                                <div class="form-group mb-3">
                                                    <label for="">Note <small>(Optional)</small></label>
                                                    <textarea name="description" id="" cols="30" rows="7" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                
                                    </div>
                                </div>
                                <div class="card-footer text-center" style="border-radius:0px 0px 10px 10px;background-color:#fff;">
                                    <button type="submit" class="btn btn-success btn-footer" onclick="save()">Submit</button>
                                    <a href="{{ route('backend.warehouse.index') }}" class="btn btn-secondary btn-footer">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        
@section('script')
<script>
    function addField() {
        var rowCount = $('#contactTable tr').length;
        $("#contactTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><input class="form-control" placeholder="No Po" type="text" name="no_po[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                    '<td><input class="form-control" placeholder="Tanggal Po" type="date" name="tanggal_po[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                    '<td><input class="form-control" placeholder="No Invoice" type="text" name="no_invoice[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                    '<td><input class="form-control" placeholder="Tanggal Kirim" type="date" name="tanggal_kirim[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                    // '<td><select name="material_id[]" id="" class="select_part form-select" onchange="changeOptionValue()"><option disabled selected>Status</option></select></td>'+
                    // '<td><input class="form-control" placeholder="Description" type="number" name="description[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                    // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="unit_price[]" id="unit_price'+rowCount+'" placeholder="Input unit price" aria-describedby="basic-addon1" onkeyup="calculatePrice('+rowCount+')"></div></td>' +
                    // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="total_price[]" id="total_price'+rowCount+'" placeholder="Total" readonly aria-describedby="basic-addon1"></div></td>' +
                    '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();changeOptionValue();"><i class="fa fa-minus"></i></button></td>' +
                    '</tr>'
                )
            )
            changeOptionValue();
    }

    function save()
    {
        val12.forEach(item => {
            $(".select_part option[value='"+item+"']").removeAttr('disabled');
        });

        $('#formPO').submit();
    }

</script>
                        
<script>
// ajaxVendor();
// function ajaxVendor() {
//     $.ajax({
//     url: "http://megahpita.wiqi.co/api/index.php/Api/get/P2000023/21.04.2020",
//     type: 'GET',
//     dataType: 'json', // added data type
//     cors: true ,
//     contentType:'application/json',
//     secure: true,
//     headers: {
//         'Access-Control-Allow-Origin': '*',
//         'Access-Control-Allow-Credentials': 'true'
//     },
//     beforeSend: function (xhr) {
//         xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
//     },
//     success: function(res) {
//         console.log(res);

//     }
// });


// $('#no_po').change(function () {
//     $.ajax({
//         url: "{{ route('vendor.api') }}",
//         type: "GET",
//         data: {
//             no_po: no_po
//         },
//         success: function (data) {
//             stok_tersedia = data.total_stock;
//             $('#available_stock').val(stok_tersedia);
//         }
//     });
// });


// $.post( "ajax/test.html", function( data ) {
// $( ".result" ).html( data );
// });
function checkPO() {

$.ajax({
url: "{{ route('backend.get-data-api') }}",
type: 'GET',
dataType: 'json', // added data type
success: function(res) {
console.log(res);
// alert(res);
$('#ponum').val(res.PONUM);
$('#tanggal_po').val(res.PODATE);
}
});
}
</script>
@endsection
