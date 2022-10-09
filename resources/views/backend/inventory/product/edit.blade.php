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
                    <li class="breadcrumb-item"><a href="{{ route('backend.master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('backend.users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
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
                <h3 class="card-title text-white">Employee Edit</h3>
            </div>
            <form action="{{ route('backend.inventory_product.update', $inventory_product->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="card-body">

                    @include('backend.components.form-message')
                  
                    <div class="form-group mb-3">
                        <label for="date">Date</label>
                        <input class="form-control @error('date') is-invalid @enderror" id="date" type="date" name="date" placeholder="date " required value="{{ old('date') ?? $inventory_product->date }}">

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-lg-6 ml-20">
                        <div class="form-group">
                            <label>Product Name</label>
                            <select class="form-control @error('productid') is-invalid @enderror" name="product_id">
                                <option disabled selected>Choose Product</option>
                                @foreach ($product as $products)
                                    <option value="{{ $products->id ?? '' }}"
                                        {{ (old('product_id') ?? ($inventory_product->product->id ?? '')) == $products->id ?? '' ? 'selected' : '' }}>
                                        {{ $products->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('Product_id_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>*Product Wajib Diisi!</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="begin_stock">Begin Stock</label>
                        <input class="form-control @error('begin_stock') is-invalid @enderror" id="begin_stock" type="number" name="begin_stock" placeholder="Begin Stock " required value="{{ old('begin_stock') ?? $inventory_product->begin_stock }}">

                        @error('begin_stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ $inventory_product->description }}</textarea>

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
                    <a href="{{ route('backend.inventory_product.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection