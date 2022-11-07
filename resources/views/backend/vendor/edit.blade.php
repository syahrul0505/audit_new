@extends('backend.layouts.app')

@section('style')
    
@endsection

@section('content')
<div class="row mt-2">
    <div class="col-lg-12 col-xl-12 col-sm-12">
        <div class="card card-primary" style="border-radius:18px;">
            <div class="card-header text-center " style="border-radius:10px 10px 0px 0px;">
                <h4 class="card-title">{{$page_title}}</h4>
            </div>
            <form method="POST" action="{{ route('backend.vendor.update', $vendor->id) }}" id="formPO">
                @csrf
                @method('PATCH')
                <div class="card-body">

                    @include('backend.components.form-message')
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="">Tanggal PO</label>
                                        <input class="form-control @error('tanggal_po') is-invalid @enderror" id="month" type="date" name="tanggal_po" value="{{ $vendor->tanggal_po }}">
                
                                        @error('tanggal_po')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="">No PO</label>
                                        <input class="form-control @error('no_po') is-invalid @enderror"  type="text" name="no_po" value="{{ $vendor->no_po }}">
                
                                        @error('no_po')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="">No Inv Vendor</label>
                                        <input class="form-control @error('no_inv_vendor') is-invalid @enderror" id="month" type="text" name="no_inv_vendor" value="{{ $vendor->no_inv_vendor }}">
                
                                        @error('no_po')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="">Tanggal Kirim</label>
                                        <input class="form-control @error('tanggal_kirim') is-invalid @enderror" id="month" type="date" name="tanggal_kirim" value="{{ $vendor->tanggal_kirim }}">
                
                                        @error('tanggal_kirim')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="">Email Vendor</label>
                                        <input class="form-control @error('email_vendor') is-invalid @enderror" id="month" type="date" name="email_vendor" value="{{ $vendor->email_vendor }}">
                
                                        @error('email_vendor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="border-radius:0px 0px 10px 10px;background-color:#fff;">
                    <button type="submit" class="btn btn-success btn-footer" onclick="save()">Save</button>
                    <a href="{{ route('backend.vendor.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection