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

            <div class="page-title-right">
                <a href="{{ route('backend.product.index') }}" class="btn btn-secondary btn-footer"> <i class="bx bx-undo"></i> Back</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-lg-6 col-xl-6 col-sm-12 mx-auto">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white" style="font-size: 24px; !important">{{ $page_title }}</h3>
            </div>
            <form method="POST" action="{{ route('backend.product.store') }}" novalidate>
                @csrf
                <div class="card-body">

                    @include('backend.components.form-message')

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="code">Product Code</label>
                            <input class="form-control @error('code') is-invalid @enderror" id="code" type="text" name="code" placeholder="Product Code" required value="{{ old('code') }}">
                            
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
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Product Name" required value="{{ old('name') }}">
                            
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="">Category Product</label>
                            <select class="form-select @error('category_product') is-invalid @enderror" name="category_product">
                                <option disabled selected>Pilih Category Product</option>
                                <option value="Raw Material">Raw Material</option>
                                <option value="Ready To Sell">Ready To Sell</option>
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
                            <input class="form-control @error('merk') is-invalid @enderror" id="merk" type="text" name="merk" placeholder="Merek" required value="{{ old('merk') }}">
                            
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
                            <input class="form-control @error('jenis_barang') is-invalid @enderror" id="jenis_barang" type="text" name="jenis_barang" placeholder="Jenis Barang" required value="{{ old('jenis_barang') }}">
                            
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
                                <label for="ukuran_barang">Ukuran Barang</label>
                                <input class="form-control @error('ukuran_barang') is-invalid @enderror" id="ukuran_barang" type="text" name="ukuran_barang" placeholder="Ukuran Barang" required value="{{ old('ukuran_barang') }}">
                                
                                @error('ukuran_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-6">
                            <div class="form-group mb-3">
                                <label class="">Satuan Barang</label>
                                <select class="form-select @error('satuan_barang') is-invalid @enderror" name="satuan_barang">
                                    <option disabled selected>Pilih Satuan Barang</option>
                                    <option value="Rolls">Rolls</option>
                                    <option value="㎡">㎡</option>
                                    <option value="box">box</option>
                                    <option value="pcs">pcs</option>
                                    <option value="drum">drum</option>
                                </select>
                                @error('satan_barang')
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
                                <input class="form-control @error('qty') is-invalid @enderror" id="qty" type="number" name="qty" placeholder="qty" required value="{{ old('qty') }}">
                                
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
                                <select class="form-select @error('unit') is-invalid @enderror" name="unit">
                                    <option disabled selected>Pilih Satuan Qty</option>
                                    <option value="Rolls">Rolls</option>
                                    <option value="㎡">㎡</option>
                                    <option value="box">box</option>
                                    <option value="pcs">pcs</option>
                                    <option value="drum">drum</option>
                                </select>

                                @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                    </div>

                    {{-- <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="unit">Unit</label>
                            <input class="form-control @error('unit') is-invalid @enderror" id="unit" type="text" name="unit" placeholder="unit" required value="{{ old('unit') }}">
                            
                            @error('unit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="description">Description <small>(Optional)</small></label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Description"></textarea>
                            
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                   
                <div class="card-footer bg-gray1 float-right text-end" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Save And Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection