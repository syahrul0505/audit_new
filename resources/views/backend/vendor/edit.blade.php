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
            <form method="POST" action="{{ route('backend.purchase_order.update', $vendor->id) }}" id="formPO">
                @csrf
                @method('PATCH')
                <div class="card-body">

                    @include('backend.components.form-message')
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror"  type="text" name="email" value="{{ $vendor->email }}">
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ $vendor->description }}</textarea>
          
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                            <th>No Po</th>
                                            <th>Tanggal Po</th>
                                            <th>No Invoice</th>
                                            <th>Tanggal Kirim</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{ dd($vendor->vendorPivot) }} --}}
                                        @if ($vendor->vendorPivot->count() > 0)
                                            @foreach ($vendor->vendorPivot as $key => $vendorPivot)
                                            <tr>
                                                <td>
                                                    <input class="form-control {{ $errors->has('no_po') ? 'is-invalid' : '' }}" placeholder="Input no_po" type="text" name="no_po[]" id="qty1" value="{{$vendorPivot->no_po}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('tanggal_po') ? 'is-invalid' : '' }}" placeholder="Input tanggal_po" type="date" name="tanggal_po[]" id="qty1" value="{{$vendorPivot->tanggal_po}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('no_invoice') ? 'is-invalid' : '' }}" placeholder="no_invoice" type="number" name="no_invoice[]" id="qty1" value="{{$vendorPivot->no_invoice}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('tanggal_kirim') ? 'is-invalid' : '' }}" placeholder="Date" type="date" name="tanggal_kirim[]" id="qty1" value="{{$vendorPivot->tanggal_kirim}}">
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