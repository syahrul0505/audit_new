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
                <h3 class="card-title text-white">{{ $page_title }}</h3>
            </div>
            <form action="{{ route('backend.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="card-body">

                    @include('backend.components.form-message')
                  
                    <div class="form-group mb-3">
                        <label for="code">Product Code</label>
                        <input class="form-control @error('code') is-invalid @enderror" id="code" type="text" name="code" placeholder="Product Code " required value="{{ old('code') ?? $product->code }}">

                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Product Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Product Name " required value="{{ old('name') ?? $product->name }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="gramasi">Gramasi</label>
                        <input class="form-control @error('gramasi') is-invalid @enderror" id="gramasi" step="0.01" type="number" name="gramasi" placeholder="0,00 " required value="{{ old('gramasi') ?? $product->gramasi }}">

                        @error('gramasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="thickness">Thickness</label>
                        <input class="form-control @error('thickness') is-invalid @enderror" id="thickness" step="0.01" type="number" name="thickness" placeholder="0,00 " required value="{{ old('thickness') ?? $product->thickness }}">

                        @error('thickness')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="panjang">Panjang</label>
                        <input class="form-control @error('panjang') is-invalid @enderror" id="panjang" step="0.01" type="number" name="panjang" placeholder="0,00 " required value="{{ old('panjang') ?? $product->panjang }}">

                        @error('panjang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="lebar">Lebar</label>
                        <input class="form-control @error('lebar') is-invalid @enderror" id="lebar" step="0.01" type="number" name="lebar" placeholder="0,00 " required value="{{ old('lebar') ?? $product->lebar }}">

                        @error('lebar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ $product->description }}</textarea>

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
                    <a href="{{ route('backend.product.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection