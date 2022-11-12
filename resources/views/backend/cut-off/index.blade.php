@extends('backend.layouts.app')

@section('style')
    
@endsection

@section('content')
<div class="row mt-2">
    <div class="col-lg-12 col-xl-12 col-sm-12">
        <div class="card card-primary" style="border-radius:18px;">
            <div class="card-header text-center " style="border-radius:10px 10px 0px 0px;">
            </div>
            <form method="POST" action="{{ route('backend.forecast.store') }}" id="formPO">
                @csrf
                <div class="card-body">
                    <h4 class="card-title text-center">{{$page_title}}</h4>
                    <h4> <small class="text-danger">*</small></h4>
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
                                            <th>No Inv</th>
                                            <th>Tanggal Po</th>
                                            <th>Tanggal Kirim</th>
                                            {{-- <th>Status</th> --}}
                                            {{-- <th>Description</th> --}}
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="No Po" disabled type="text" name="description[]" id="qty1">
                                            </td>
                                            <td>
                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="No Invoice" disabled type="text" name="description[]" id="qty1">
                                            </td>
                                            <td>
                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Tanggal Po" disabled type="date" name="description[]" id="qty1">
                                            </td>
                                            <td>
                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Tanggal Kirim" type="date" name="description[]" id="qty1">
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

                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input class="form-control @error('po_number') is-invalid @enderror" type="email" name="po_number" >
        
                                @error('po_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="">Note</label>
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
                <div class="card-footer" style="border-radius:0px 0px 10px 10px;background-color:#fff;">
                    <button type="submit" class="btn btn-success btn-footer" onclick="save()">Save</button>
                    <a href="{{ route('backend.warehouse.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function addField() {
            var rowCount = $('#contactTable tr').length;
            $("#contactTable").find('tbody')
                .append(
                    $('<tr>' +
                        '<td><input class="form-control" placeholder="No Po" type="text" name="description[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="No Invoice" type="text" name="description[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="Tanggal Po" type="date" name="description[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
                        '<td><input class="form-control" placeholder="Tanggal Kirim" type="date" name="description[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
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
    function calculatePrice(number)
    {
        var qty = $('#qty'+number).val();
        var unitPrice = $('#unit_price'+number).val();
        var total = parseInt(unitPrice * qty);

        $('#total_price'+number).val(total);
    }
</script>

@endsection