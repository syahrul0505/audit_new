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
            <form method="POST" action="{{ route('backend.forecast.store') }}" id="formPO">
                @csrf
                <div class="card-body">

                    @include('backend.components.form-message')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name">Product</label>
                                <select name="product_id" id="" class="form-select @error('product_id') is-invalid @enderror">
                                    <option disabled selected>Choose Product</option>
                                    @foreach ($product as $products)
                                        <option value="{{$products->id}}" {{(old('product_id') == $products->id ? 'selected' : '')}}>{{$products->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date</label>
                                <input class="form-control @error('date') is-invalid @enderror" id="month" type="date" name="date" value="{{ date('Y-m-d') }}">
        
                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="name">Employee</label>
                                <select name="employee_id" id="" class="form-select @error('employee_id') is-invalid @enderror">
                                    <option disabled selected>Choose Employee</option>
                                    @foreach ($employee as $employees)
                                        <option value="{{$employees->id}}" {{(old('employee_id') == $employees->id ? 'selected' : '')}}>{{$employees->name}}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
                <div class="card-body">
                    <h4>Material <small class="text-danger">*</small></h4>
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
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="material_id[]" id="" class="select_part form-select @error('material_id[]') is-invalid @enderror" onchange="changeOptionValue()">
                                                    <option disabled selected>Choose Part Name</option>
                                                    @foreach ($material as $materials)
                                                        <option value="{{$materials->id}}">{{$materials->name}}<p id="noteDisabled">&nbsp;</p></option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Input Description" type="text" name="description[]" id="qty1">
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
                    <a href="{{ route('backend.forecast.index') }}" class="btn btn-secondary btn-footer">Back</a>
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
                    '<td><select name="material_id[]" id="" class="select_part form-select" onchange="changeOptionValue()"><option disabled selected>Choose Part Name</option>@foreach ($material as $materials)<option value="{{$materials->id}}" {{(old('material_id') == $materials->id ? 'selected' : '')}}>{{$materials->name}} <p id="noteDisabled">&nbsp;</p></option>@endforeach</select></td>'+
                    '<td><input class="form-control" placeholder="Input Description" type="text" name="description[]" id="qty'+rowCount+'" onkeyup="calculatePrice('+rowCount+')"></td>' +
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