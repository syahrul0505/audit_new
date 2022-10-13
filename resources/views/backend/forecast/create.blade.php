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
                    <li class="breadcrumb-item active"><a href="{{ route('backend.forecast.index') }}">Absen</a></li>
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
            <form method="POST" action="{{ route('backend.forecast.store') }}" novalidate>
                @csrf
                <div class="card-body">

                    @include('backend.components.form-message')

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
                        <label>Product</label>

                        <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                            <option disabled selected>Choose Product</option>
                            @foreach ($product as $products)
                            <option value="{{ $products->id }}"
                                {{ old('product_id') == $products->id ? 'selected' : '' }}>
                                {{ $products->name }} </option>
                            @endforeach
                        </select>
                        @error('inventory_product_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="available_stock">Gram</label>
                        <input type="number" readonly
                            class="form-control @error('available_stock') is-invalid @enderror" name="available_stock"
                            id="gramasi">
                    </div>

                    <div class="form-group mb-3">
                        <label for="perkiraan">Perkiraan</label>
                        <input type="number" readonly
                            class="form-control @error('perkiraan') is-invalid @enderror" name="perkiraan"
                            id="perkiraan">
                    </div>

                    <div class="form-group mb-3">
                        <label for="qty">Quantity</label>
                        <input class="form-control @error('qty') is-invalid @enderror" id="qty" type="number" name="qty" placeholder="Quantity" required value="{{ old('qty') }}">

                        @error('qty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Date</label>
                        <input class="form-control @error('date') is-invalid @enderror" id="date" type="date" name="date" placeholder="Quantity" required value="{{ old('date') }}">

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Description"></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                   
                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Add</button>
                    <a href="{{ route('backend.forecast.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let stok_tersedia = 0;
    $('#product_id').change(function () {
        let product_id = $('#product_id').val();
        console.log(product_id);
        $.ajax({
            url: "{{ route('backend.product.get-gramasi') }}",
            type: "GET",
            data: {
                product_id: product_id
            },
            success: function (data) {
                $('#gramasi').val(data)
                let rumusPerkiraan = data/100
                let perkiraan = Math.floor(rumusPerkiraan)
                $('#perkiraan').val(perkiraan)
            }
        });
    });


    function calculateStock() {
        let qty = $('#qty').val();
        $('#available_stock').val(stok_tersedia + Number(qty));
    }

</script>
@endsection