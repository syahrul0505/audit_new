@extends('backend.layouts.app')

@section('style')
<style>
    #sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
</style>
@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active"><a href="{{ route('backend.stock_in_product.index') }}">Stock In Material</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-lg-6 col-xl-6 col-sm-12">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">{{ $page_title }}</h3>
            </div>
            <form method="POST" action="{{ route('backend.stock_in_material.store') }}" novalidate>
                @csrf
                <div class="card-body">

                    @include('backend.components.form-message')

                    <div class="form-group mb-3">
                        <label>Material</label>

                        <select class="form-select @error('material_id') is-invalid @enderror" id="material_id" name="material_id">
                            <option disabled selected>Choose Material</option>
                            @foreach ($material as $materials)
                            <option value="{{ $materials->id }}"
                                {{ old('material_id') == $materials->id ? 'selected' : '' }}>
                                {{ $materials->name }} </option>
                            @endforeach
                        </select>
                        @error('material_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="material_incoming">Material Incoming</label>
                        <input class="form-control @error('material_incoming') is-invalid @enderror" id="material_incoming" type="number" name="material_incoming" placeholder="material Incoming" required value="{{ old('material_incoming') }}">

                        @error('material_incoming')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Date</label>
                        <input class="form-control @error('date') is-invalid @enderror" id="date" type="date" name="date" placeholder="Date" required value="{{ old('date') }}">

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Employee</label>

                        <select class="form-select @error('employee_id') is-invalid @enderror" name="employee_id">
                            <option disabled selected>Choose Employee</option>
                            @foreach ($employee as $employees)
                            <option value="{{ $employees->id }}"
                                {{ old('employee_id') == $employees->id ? 'selected' : '' }}>
                                {{ $employees->name }} </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="available_stock">Stok Tersedia</label>
                        <input type="number" readonly
                            class="form-control @error('available_stock') is-invalid @enderror" name="available_stock"
                            id="available_stock">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Description"></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                   
                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Add</button>
                    <a href="{{ route('backend.stock_in_material.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let stok_tersedia = 0;
    $('#material_id').change(function () {
        let material_id = $('#material_id').val();
        $.ajax({
            url: "{{ route('backend.inventory-material.get-stock') }}",
            type: "GET",
            data: {
                material_id: material_id
            },
            success: function (data) {
                stok_tersedia = data.total_stock;
                $('#available_stock').val(stok_tersedia);
            }
        });
    });


    function calculateStock() {
        let qty = $('#qty').val();
        $('#available_stock').val(stok_tersedia + Number(qty));
    }


</script>
@endsection