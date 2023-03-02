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
                    <li class="breadcrumb-item active"><a href="{{ route('backend.users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div> --}}

            <div class="page-title-right">
                <a href="{{ route('backend.customer.index') }}" class="btn btn-secondary btn-footer"> <i class="bx bx-undo"></i> Back</a>
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
                <h3 class="card-title text-white">{{ $page_title }}</h3>
            </div>
            <form action="{{ route('backend.customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="card-body">

                    {{-- @include('backend.components.form-message') --}}
                  
                    <div class="form-group mb-3">
                        <label class="col-form-label">Customer</label>
                        <select class="form-select" id="type" name="customer">
                            <option value="">Select Status</option>
                            <option value="End User" {{ $customer->customer == 'End User' ? 'selected' : '' }}>End User</option>
                            <option value="Vendor" {{ $customer->customer == 'Vendor' ? 'selected' : '' }}>Vendor</option>
                            <option value="End User & Vendor" {{ $customer->customer == 'End User & Vendor' ? 'selected' : '' }}>End User & Vendor</option>
                            <option value="Distributor" {{ $customer->customer == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                            <option value="Reseller" {{ $customer->customer == 'Reseller' ? 'selected' : '' }}>Reseller</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Material Name " required value="{{ old('name') ?? $customer->name }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kota">City</label>
                        <input class="form-control @error('kota') is-invalid @enderror" id="kota" type="text" name="kota" placeholder="City" required value="{{ old('kota') ?? $customer->kota }}">

                        @error('kota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat">Adress</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Adress">{{ $customer->alamat }}</textarea>
  
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                    <div class="form-group mb-3">
                        <label for="kode_pos">Pos Code</label>
                        <input class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" type="number" name="kode_pos" placeholder="Pos Code" required value="{{ old('kode_pos') ?? $customer->kode_pos }}">

                        @error('kode_pos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
  

                    <div class="form-group mb-3">
                        <label for="no_tlp">Hanphone Number</label>
                        <input class="form-control @error('no_tlp') is-invalid @enderror" id="no_tlp" type="number" name="no_tlp" placeholder="Hanphone Number" required value="{{ old('no_tlp') ?? $customer->no_tlp }}">

                        @error('no_tlp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="office_number">Office Number</label>
                        <input class="form-control @error('office_number') is-invalid @enderror" id="office_number" type="number" name="office_number" placeholder="Office Number" required value="{{ old('office_number') ?? $customer->office_number }}">

                        @error('office_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name_ppic">Name PPIC</label>
                        <input class="form-control @error('name_ppic') is-invalid @enderror" id="name_ppic" type="text" name="name_ppic" placeholder="Name PPIC" required value="{{ old('name_ppic') ?? $customer->name_ppic }}">

                        @error('name_ppic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email </label>
                        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="Email" required value="{{ old('email') ?? $customer->email }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-form-label">Term OF Paymnet</label>
                        <select class="form-select" id="type" name="term_of_payment">
                            <option value="">Select Payment</option>
                            <option value="Cash On Delivery (COD)" {{ $customer->term_of_payment == 'Cash On Delivery (COD)' ? 'selected' : '' }}>Cash On Delivery (COD)</option>
                            <option value="Cash Before Delivery (CBD)" {{ $customer->term_of_payment == 'Cash Before Delivery (CBD)' ? 'selected' : '' }}>Cash Before Delivery (CBD)</option>
                            <option value="Net3" {{ $customer->term_of_payment == 'Net3' ? 'selected' : '' }}>Net3</option>
                            <option value="Net7" {{ $customer->term_of_payment == 'Net7' ? 'selected' : '' }}>Net7</option>
                            <option value="Net14" {{ $customer->term_of_payment == 'Net14' ? 'selected' : '' }}>Net14</option>
                            <option value="Net30" {{ $customer->term_of_payment == 'Net30' ? 'selected' : '' }}>Net3</option>
                        </select>
                    </div>

                    
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1 text-end" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Save</button>
                    {{-- <a href="{{ route('backend.customer.index') }}" class="btn btn-secondary btn-footer">Back</a> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection