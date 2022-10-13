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
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.inventory.index') }}">Inventory</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('backend.stock_in_product.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">{{ $page_title }}</h3>
            </div>
            <form action="{{ route('backend.stock_in_product.update', $stock_in->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="card-body">

                    @include('backend.components.form-message')

                    <div class="form-group mb-3">
                        <label>Product Name</label>
                        <select class="form-select @error('product_id') is-invalid @enderror" name="product_id" id="product_id">
                            <option disabled selected>Choose Product</option>
                            @foreach ($product as $products)
                                <option value="{{ $products->id ?? '' }}"
                                    {{ (old('product_id') ?? ($stock_in->product->id ?? '')) == $products->id ?? '' ? 'selected' : '' }}>
                                    {{ $products->name ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('Product_id_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>*Product Wajib Diisi!</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Employee Name</label>
                        <select class="form-select @error('employee_id') is-invalid @enderror" name="employee_id">
                            <option disabled selected>Choose Employee</option>
                            @foreach ($employee as $employees)
                                <option value="{{ $employees->id ?? '' }}"
                                    {{ (old('employee_id') ?? ($stock_in->employee->id ?? '')) == $employees->id ?? '' ? 'selected' : '' }}>
                                    {{ $employees->name ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('Product_id_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>*Product Wajib Diisi!</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="product_incoming">Product Incoming</label>
                        <input class="form-control @error('product_incoming') is-invalid @enderror" onkeyup="calculateStock()" id="product_incoming" type="number" name="product_incoming" placeholder="Product Incoming " required value="{{ old('product_incoming') ?? $stock_in->product_incoming }}">

                        @error('product_incoming')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="available_stock">Stok Tersedia</label>
                        <input type="number" readonly class="form-control @error('available_stock') is-invalid @enderror" name="current_stock" id="available_stock" required value="{{ $stock_in->current_stock }}">
                    </div>

                    <div class="form-group mb-3">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ $stock_in->description }}</textarea>

                      @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Save</button>
                    <a href="{{ route('backend.stock_in_product.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    let stok_tersedia = $('#available_stock').val() - $('#product_incoming').val();
    $('#product_id').change(function () {
        let product_id = $('#product_id').val();
        $.ajax({
            url: "{{ route('backend.inventory-product.get-stock') }}",
            type: "GET",
            data: {
                product_id: product_id
            },
            success: function (data) {
                stok_tersedia = data.total_stock;
                $('#available_stock').val(data.total_stock);
            }
        });
    });


    function calculateStock() {
        let incoming = $('#product_incoming').val();
        $('#available_stock').val(stok_tersedia + Number(incoming));
    }

</script>

@endsection