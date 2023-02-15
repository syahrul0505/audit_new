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
                    <li class="breadcrumb-item active"><a href="{{ route('backend.product.index') }}">Product</a></li>
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
            <form method="POST" action="{{ route('backend.customer.store') }}" novalidate>
                @csrf
                <div class="card-body">

                    {{-- @include('backend.components.form-message') --}}

                    <div class="form-group mb-3">
                        <label class="col-form-label">Customer</label>
                        <select class="form-select" name="customer">
                            <option disabled selected>Choose Customer</option>
                            <option value="End User">End User</option>
                            <option value="Vendor">Vendor</option>
                            <option value="End User & Vendor">End User & Vendor</option>
                            <option value="Distributor">Distributor</option>
                            <option value="Reseller">Reseller</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Name" required value="{{ old('name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat">Adress</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Adress"></textarea>

                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="no_tlp">Phone Number</label>
                        <input class="form-control @error('no_tlp') is-invalid @enderror" id="no_tlp" type="number" name="no_tlp" placeholder="No Tlp" required value="{{ old('no_tlp') }}">

                        @error('no_tlp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name_ppic">Name PPIC</label>
                        <input class="form-control @error('name_ppic') is-invalid @enderror" id="name_ppic" type="text" name="name_ppic" placeholder="Name PPIC" required value="{{ old('name_ppic') }}">

                        @error('name_ppic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="email" required value="{{ old('email') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-form-label">Term Of Payment</label>
                        <select class="form-select" name="term_of_payment">
                            <option disabled selected>Choose Payment</option>
                            <option value="Cash On Delivery (COD)">Cash On Delivery (COD)</option>
                            <option value="Cash Before Delivery(CBD)">Cash Before Delivery(CBD)</option>
                            <option value="Net3">Net3</option>
                            <option value="Net7">Net7</option>
                            <option value="Net14">Net14</option>
                            <option value="Net30">Net30</option>
                        </select>
                    </div>
                   
                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Add</button>
                    <a href="{{ route('backend.customer.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection