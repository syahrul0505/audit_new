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
            <form method="POST" action="{{ route('backend.purchase_order.update', $purchase_order->id) }}" id="formPO">
                @csrf
                @method('PATCH')
                <div class="card-body">

                    @include('backend.components.form-message')
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Po No</label>
                                <input class="form-control @error('po_no') is-invalid @enderror"  type="text" name="po_no" value="{{ $purchase_order->po_no }}">
        
                                @error('po_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="col-form-label">Category</label>
                                <select class="form-select" id="type" name="category">
                                    <option value="">Select Category</option>
                                    <option value="Operasional" {{ $purchase_order->category == 'Operasional' ? 'selected' : '' }}>Operasional</option>
                                    <option value="Raw Material" {{ $purchase_order->category == 'Raw Material' ? 'selected' : '' }}>Raw Material</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Nama Barang</label>
                                <input class="form-control @error('nama_barang') is-invalid @enderror"  type="text" name="nama_barang" value="{{ $purchase_order->nama_barang }}">
        
                                @error('nama_barang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label class="col-form-label">Site</label>
                                <select class="form-select" id="type" name="site">
                                    <option value="">Select Site</option>
                                    <option value="Sunter" {{ $purchase_order->site == 'Sunter' ? 'selected' : '' }}>Sunter</option>
                                    <option value="Jayakarta" {{ $purchase_order->site == 'Jayakarta' ? 'selected' : '' }}>Jayakarta</option>
                                    <option value="Cikupa" {{ $purchase_order->site == 'Cikupa' ? 'selected' : '' }}>Cikupa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <h4>Material <small class="text-danger">*</small></h4> --}}
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
                                        @if ($purchase_order->purchaseOrderPivot->count() > 0)
                                            @foreach ($purchase_order->purchaseOrderPivot as $key => $purchaseOrderPivot)
                                            <tr>
                                                <td>
                                                    <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" placeholder="Input Qty" type="number" name="qty[]" id="qty1" value="{{$purchaseOrderPivot->qty}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}" placeholder="Input Harga" type="number" name="harga[]" id="qty1" value="{{$purchaseOrderPivot->harga}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" placeholder="Total" type="number" name="total[]" id="qty1" value="{{$purchaseOrderPivot->total}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" placeholder="Date" type="date" name="po_date[]" id="qty1" value="{{$purchaseOrderPivot->po_date}}">
                                                </td>
                                                
                                                <td>
                                                    @if ($key == 0)
                                                        <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addField()">
                                                            <i class="fas fa-plus-square"></i>
                                                        </button>
                                                    @else
                                                    <button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();"><i class="fa fa-minus"></i></button>
                                                    @endif
                                                <td> 
                                            </tr>
                                            @endforeach
                                        @endif
                                        
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

        var val12=[];
        changeOptionValue();

         function changeOptionValue()
        {
            // Ngambil Variable dari controller
            // 
            // Remove All DIsabled Option
            p_id.forEach(product => {
                $(".select_part option[value='"+product+"']").prop('disabled', false);
                $("#noteDisabled").text('masuk');
            });
            // Disabled selected option
            val1.forEach(item => {
                $(".select_part option[value='"+item+"']").attr('disabled', 'disabled');
            });

        }
        function save()
        {
            val12.forEach(item => {
                $(".select_part option[value='"+item+"']").removeAttr('disabled');
            });

            $('#formPO').submit();
        }
        function addField() {
            var rowCount = $('#contactTable tr').length;
            $("#contactTable").find('tbody')
                .append(
                    $('<tr>' +
                        '<td><input class="form-control" placeholder="Input Qty" type="number" name="qty[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="Input Harga" type="number" name="harga[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="Total" type="number" name="total[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="Po Date" type="number" name="po_date[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="unit_price[]" id="unit_price'+rowCount+'" placeholder="Input unit price" aria-describedby="basic-addon1" onkeyup="calculatePrice('+rowCount+')"></div></td>' +
                        // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="total_price[]" id="total_price'+rowCount+'" placeholder="Total" readonly aria-describedby="basic-addon1"></div></td>' +
                        '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();"><i class="fa fa-minus"></i></button></td>' +
                        '</tr>'
                    )
                )
                changeOptionValue();

        }
    </script>

    <script>
        function calculatePrice(number)
        {
            var qty = $('#qty'+number).val();
            var unitPrice = $('#unit_price'+number).val();
            var total = parseInt(unitPrice * qty);

            $('#total_price'+number).val(total);
        }
    </script>

@endsection