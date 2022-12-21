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
            <form method="POST" action="{{ route('vendor.update', $vendor->id) }}" id="formPO">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    @include('backend.components.form-message')
                    {{-- <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addField()">
                        <i class="fas fa-plus-square"></i>
                    </button> --}}
                    <img src="{{ asset('img/MPI.png') }}" style="width: 200px; height:100px;" alt="">
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
                                            <th>Amount</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <button type="button" class="btn btn-outline-success" id="btn-add-document" onclick="addField()">
                                        <i class="fas fa-plus-square"></i>
                                    </button>
                                    <tbody>
                                        {{-- {{ dd($vendor->vendorPivot) }} --}}
                                        @if ($vendor->vendorPivot->count() > 0)
                                            @foreach ($vendor->vendorPivot as $key => $vendorPivot)
                                            <tr>
                                                <td>
                                                    <div class="row">

                                                        <div class="col-lg-2">
                                                            <p><b>PO-</b></p>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <input class="form-control {{ $errors->has('no_po') ? 'is-invalid' : '' }}" placeholder="Input no_po" type="text" name="no_po[]" id="qty1" value="{{$vendorPivot->no_po}}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('tanggal_po') ? 'is-invalid' : '' }}" placeholder="Input tanggal_po" type="date" name="tanggal_po[]" id="qty1" value="{{$vendorPivot->tanggal_po}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('no_invoice') ? 'is-invalid' : '' }}" placeholder="no_invoice" type="text" name="no_invoice[]" id="qty1" value="{{$vendorPivot->no_invoice}}">
                                                </td>
                                                <td>
                                                    <input class="form-control {{ $errors->has('tanggal_kirim') ? 'is-invalid' : '' }}" placeholder="Date" type="date" name="tanggal_kirim[]" id="qty1" value="{{$vendorPivot->tanggal_kirim}}">
                                                </td>

                                                <td>
                                                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="Amount" type="text" name="amount[]" id="amount{{ $key+1 }}" value="{{$vendorPivot->amount}}">
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
                <div class="card-body">

                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Email <small class="text-danger">*(Wajib Isi)</small></label>
                                <input class="form-control @error('email') is-invalid @enderror"  type="text" name="email" value="{{ $vendor->email }}">
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Name Vendor <small class="text-danger">*(Wajib Isi)</small></label>
                                <input class="form-control @error('name_vendor') is-invalid @enderror"  type="text" name="name_vendor" value="{{ $vendor->name_vendor }}">
        
                                @error('name_vendor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="col-form-label">Status</label>
                                <select class="form-select" id="type" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Pending" class="text-warning" {{ $vendor->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Approve" class="text-success" {{ $vendor->status == 'Approve' ? 'selected' : '' }}>Approve</option>
                                    <option value="Reject" class="text-danger" {{ $vendor->status == 'Reject' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </div>

                                <div class="form-group mb-3">
                                    <label for="">No Faktur Pajak</label>
                                    <input class="form-control @error('no_pajak') is-invalid @enderror"  type="text" id="phone" name="no_faktur" value="{{ ($vendor->no_faktur) }}" >
            
                                    @error('no_pajak')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            <div class="form-group mb-3">
                                <label for="description">Description <small>(optional)</small></label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ $vendor->description }}</textarea>
          
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="">Dibuat Oleh</label>
                                    <input class="form-control @error('dibuat') is-invalid @enderror"  type="text" name="dibuat" value="{{ ($vendor->dibuat) }}" >
                                    
                                    @error('dibuat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        {{-- <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Total</label>
                                <input class="form-control @error('total') is-invalid @enderror"  type="number" name="total" value="{{ $vendor->total }}">
        
                                @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        

                    </div>
                </div>
                <div class="card-footer" style="border-radius:0px 0px 10px 10px;background-color:#fff;">
                    <button type="submit" class="btn btn-success btn-footer" onclick="save()">Save</button>
                    <a href="{{ route('vendor.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        var val12=[];
        // changeOptionValue();

        //  function changeOptionValue()
        // {
        //     // Ngambil Variable dari controller
        //     // 
        //     // Remove All DIsabled Option
        //     p_id.forEach(product => {
        //         $(".select_part option[value='"+product+"']").prop('disabled', false);
        //         $("#noteDisabled").text('masuk');
        //     });
        //     // Disabled selected option
        //     val1.forEach(item => {
        //         $(".select_part option[value='"+item+"']").attr('disabled', 'disabled');
        //     });

        // }
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
                        '<td><div class="row"><div class="col-lg-2"><p><b>PO-</b></p></div><div class="col-lg-10"><input class="form-control" placeholder="Input No Po" type="text" name="no_po[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></div></div></td>' +
                        '<td><input class="form-control" placeholder="Input Tanggal Po" type="date" name="tanggal_po[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="No Invoice" type="text" name="no_invoice[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="Po Date" type="date" name="tanggal_kirim[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="Amount" type="text" name="amount[]" id="amount'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="unit_price[]" id="unit_price'+rowCount+'" placeholder="Input unit price" aria-describedby="basic-addon1" onkeyup="calculatePrice('+rowCount+')"></div></td>' +
                        // '<td><div class="input-group"><span class="input-group-text" id="basic-addon1">IDR</span><input type="number" class="form-control" min="0" name="total_price[]" id="total_price'+rowCount+'" placeholder="Total" readonly aria-describedby="basic-addon1"></div></td>' +
                        '<td style="max-width: 6% !important"><button type="button" class="btn btn-outline-danger btn-remove" onclick="$(this).parent().parent().remove();"><i class="fa fa-minus"></i></button></td>' +
                        '</tr>'
                    )
                )
                // changeOptionValue();

                $("#amount"+rowCount).inputmask({"mask": "9.999.999.999,99"});
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

        $(":input").inputmask();

        $("#phone").inputmask({"mask": "999.999-99.99999999"});
        var rowCount = $('#contactTable tr').length;
        for (let index = 1; index < rowCount; index++) {
            $("#amount"+index).inputmask({"mask": "9.999.999.999,99"});
        }

    </script>

@endsection