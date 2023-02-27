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
                <a href="{{ route('backend.customer.index') }}" class="btn btn-secondary btn-footer"> <i class="bx bx-undo"></i> Back</a>
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
            <form method="POST" action="{{ route('backend.customer.store') }}" novalidate>
                @csrf
                <div class="card-body">

                    {{-- @include('backend.components.form-message') --}}

                    <div class="form-group mb-3">
                        <label class="col-form-label">Customer</label>
                        <select class="form-select @error('customer') is-invalid @enderror" name="customer">
                            <option disabled selected>Choose Customer</option>
                            <option value="End User">End User</option>
                            <option value="Vendor">Vendor</option>
                            <option value="End User & Vendor">End User & Vendor</option>
                            <option value="Distributor">Distributor</option>
                            <option value="Reseller">Reseller</option>
                        </select>

                        @error('customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                        <label for="kota">City</label>
                        <input class="form-control @error('kota') is-invalid @enderror" id="kota" type="text" min= "0" name="kota" placeholder="City" required value="{{ old('kota') }}">

                        @error('kota')
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
                        <label for="kode_pos">Pos Code</label>
                        <input class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" type="number" min= "0" name="kode_pos" placeholder="Pos Code" required value="{{ old('kode_pos') }}">

                        @error('kode_pos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="no_tlp">Hanphone Number</label>
                        <input class="form-control @error('no_tlp') is-invalid @enderror" id="no_tlp" type="number" name="no_tlp" placeholder="Hanphone Number" required value="{{ old('no_tlp') }}">

                        @error('no_tlp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="office_number">Office Number</label>
                        <input class="form-control @error('office_number') is-invalid @enderror" id="office_number" type="number" name="office_number" placeholder="Office Number" required value="{{ old('office_number') }}">

                        @error('office_number')
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
                        <select class="form-select @error('term_of_payment') is-invalid @enderror" name="term_of_payment">
                            <option disabled selected>Choose Payment</option>
                            <option value="Cash On Delivery (COD)">Cash On Delivery (COD)</option>
                            <option value="Cash Before Delivery(CBD)">Cash Before Delivery(CBD)</option>
                            <option value="Net3">Net3</option>
                            <option value="Net7">Net7</option>
                            <option value="Net14">Net14</option>
                            <option value="Net30">Net30</option>
                        </select>

                        @error('term_of_payment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="sales_peson_in_charge">Sales Person In Charge</label>
                        <input class="form-control @error('sales_peson_in_charge') is-invalid @enderror" id="sales_peson_in_charge" type="text" name="sales_peson_in_charge" placeholder="Sales Person In Charge" required value="{{ old('sales_peson_in_charge') }}">

                        @error('sales_peson_in_charge')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                   
                <div class="card-footer bg-gray1 text-end" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Save And Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection