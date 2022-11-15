@extends('backend.layouts.app')

@section('style')
    
@endsection

@section('content')
<div class="row mt-2">
    <div class="col-lg-12 col-xl-12 col-sm-12">
        <div class="card card-primary" style="border-radius:18px;">
            <div class="card-header text-center " style="border-radius:10px 10px 0px 0px;">
                <h4 class="card-title">{{$page_title}}</h4>
            </div>
            <form method="POST" action="{{ route('backend.purchase_order.store') }}" id="formPO">
                @csrf
                <div class="card-body">

                    @include('backend.components.form-message')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Po Number</label>
                                <input class="form-control @error('po_no') is-invalid @enderror" id="month" type="text" name="po_no" >
        
                                @error('po_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Category</label> <br>
                                <select class="form-select" @error('category') is-invalid @enderror name="category" >
                                    <option disabled selected>Choose Category</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Raw Material">Raw Material</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Nama Barang</label>
                                <input class="form-control @error('nama_barang') is-invalid @enderror" id="month" type="text" name="nama_barang" >
        
                                @error('nama_barang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="">Site </label> <br>
                                <select class="form-select" @error('site') is-invalid @enderror name="site" >
                                    <option disabled selected>Choose Site</option>
                                    <option value="Sunter">Sunter</option>
                                    <option value="Jayakarta">Jayakarta</option>
                                    <option value="Cikupa">Cikupa</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <h4> <small class="text-danger">*</small></h4> --}}
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
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Po Date</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" placeholder="Input Qty" onkeyup="totalPo()" type="text" name="qty[]" id="qty">
                                            </td>
                                            <td>
                                                <input class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" placeholder="Input harga" onkeyup="totalPo()" type="number" name="harga[]" id="harga">
                                            </td>
                                            <td>
                                                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" placeholder="Total" type="number"  name="total[]" id="total">
                                            </td>
                                            <td>
                                                <input class="form-control {{ $errors->has('po_date') ? 'is-invalid' : '' }}" placeholder="Po Date" type="date" name="po_date[]" id="po_date">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addField()">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                            <td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="border-radius:0px 0px 10px 10px;background-color:#fff;">
                    <button type="submit" class="btn btn-success btn-footer" onclick="save()">Save</button>
                    <a href="{{ route('backend.purchase_order.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        var qty = $('#qty').val();
        var harga = $('#harga').val();
        var total = parseInt(qty * harga);
        console.log(qty, harga);
//    function calculateTotal()
//     {
//         var qty = $('#qty').val();
//         var harga = $('#harga').val();
//         var total = parseInt(qty * harga);
//         console.log(qty, harga);
//         // $('#total').val(total);
//         // console.log(total);
//         // $(total).val();
        
    
//     }

    function addField() {
        var rowCount = $('#contactTable tr').length;
        $("#contactTable").find('tbody')
            .append(
                $('<tr>' +
                    '<td><input class="form-control" placeholder="Input Qty" type="text" name="qty[]" id="qty'+rowCount+'" onkeyup="totalPo()"></td>' +
                    '<td><input class="form-control" placeholder="Input Harga" type="number" name="harga[]" id="harga'+rowCount+'" onkeyup="totalPo()"></td>' +
                    '<td><input class="form-control" placeholder="Total" type="number" name="total[]" id="total'+rowCount+'"></td>' +
                    '<td><input class="form-control" placeholder="po_date" type="date" name="po_date[]" id="qty1'+rowCount+'"></td>' +
                    // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="unit_price[]" id="unit_price'+rowCount+'" placeholder="Input unit price" aria-describedby="basic-addon1" onkeyup="calculatePrice('+rowCount+')"></div></td>' +
                    // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="po_date_price[]" id="total_price'+rowCount+'" placeholder="Total" readonly aria-describedby="basic-addon1"></div></td>' +
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

    function totalPo(number)
    {
        let qty = $('#qty').val();
        let harga = $('#harga').val();
        $('#total').val(harga * Number(qty));
  
    }

</script>

@endsection