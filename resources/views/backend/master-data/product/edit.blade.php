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
        <div class="page-title-box d-sm-flex align-items-center">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            {{-- <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('backend.users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div> --}}

            <div class="page-title-right">
                <a href="{{ route('backend.product.index') }}" class="btn btn-secondary btn-footer"> <i class="bx bx-undo"></i> Back</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-6 mx-auto">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white" style="font-size: 24px; !important">{{ $page_title }}</h3>
            </div>
            <form action="{{ route('backend.product.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="card-body">

                    @include('backend.components.form-message')

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="code">Product Code</label>
                            <input class="form-control @error('code') is-invalid @enderror" id="code" type="text"
                                name="code" placeholder="Material Code " required
                                value="{{ old('code') ?? $product->code }}">

                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="name">Product Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                                name="name" placeholder="Material Name " required
                                value="{{ old('name') ?? $product->name }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 col-12">
                        <div class="form-group mb-3">
                            <label class="">Category Product</label>
                            <select class="form-select @error('category_product') is-invalid @enderror" id="type"
                                name="category_product">
                                <option value="">Select Category Product</option>
                                <option value="Raw Material" {{ $product->unit == 'Raw Material' ? 'selected' : '' }}>Raw Material</option>
                                <option value="Ready To Sell" {{ $product->unit == 'Ready To Sell' ? 'selected' : '' }}>Ready To Sell</option>
                            </select>

                            @error('category_product')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="merk">Merek</label>
                            <input class="form-control @error('merk') is-invalid @enderror" id="merk" type="text"
                                name="merek" placeholder="Merk" required value="{{ old('merk') ?? $product->merk }}">

                            @error('merk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="jenis_barang">Jenis Barang</label>
                            <input class="form-control @error('jenis_barang') is-invalid @enderror" id="jenis_barang"
                                type="text" name="jenis_barang" placeholder="Jenis Barang" required
                                value="{{ old('jenis_barang') ?? $product->jenis_barang }}">

                            @error('jenis_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <div class="form-group mb-3">
                                <label for="ukuran_barang">Ukuran Barang </label>
                                <input class="form-control @error('ukuran_barang') is-invalid @enderror"
                                    id="ukuran_barang" type="text" name="ukuran_barang" placeholder="Ukuran Barang"
                                    required value="{{ old('ukuran_barang') ?? $product->ukuran_barang }}">

                                @error('ukuran_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-6">
                            <div class="form-group mb-3">
                                <label class="">Satuan barang</label>
                                <select class="form-select @error('satuan_barang') is-invalid @enderror" id="type" name="satuan_barang">
                                    <option value="">Select Satuan Barang</option>
                                    <option value="Meter" {{ $product->unit == 'Meter' ? 'selected' : '' }}>Meter
                                    </option>
                                    <option value="Kg" {{ $product->unit == 'Kg' ? 'selected' : '' }}>Kg</option>
                                    <option value="Pcs" {{ $product->unit == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                    <option value="Pack" {{ $product->unit == 'Pack' ? 'selected' : '' }}>Pack</option>
                                    <option value="Roll" {{ $product->unit == 'Roll' ? 'selected' : '' }}>Roll</option>
                                </select>

                                @error('satuan_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <div class="form-group mb-3">
                                <label for="qty">Quantity</label>
                                <input class="form-control @error('qty') is-invalid @enderror" id="qty" type="text"
                                    name="qty" placeholder="Quantity" required
                                    value="{{ old('qty') ?? $product->qty }}">

                                @error('qty')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-6">
                            <div class="form-group mb-3">
                                <label class="">Satuan Qty</label>
                                <select class="form-select @error('unit') is-invalid @enderror" id="type" name="unit">
                                    <option value="">Select Satuan Qty</option>
                                    <option value="Meter" {{ $product->unit == 'Meter' ? 'selected' : '' }}>Meter
                                    </option>
                                    <option value="Kg" {{ $product->unit == 'Kg' ? 'selected' : '' }}>Kg</option>
                                    <option value="Pcs" {{ $product->unit == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                    <option value="Pack" {{ $product->unit == 'Pack' ? 'selected' : '' }}>Pack</option>
                                    <option value="Roll" {{ $product->unit == 'Roll' ? 'selected' : '' }}>Roll</option>
                                </select>

                                @error('unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="description">Description <small>(optional)</small></label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Description">{{ $product->description }}</textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer bg-gray1 text-end" style="border-radius:0px 0px 10px 10px;">
            <button type="submit" id="submit_button" class="btn btn-success btn-footer">Save</button>
        </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('script')

@endsection
