
@section('style')

@endsection



<!doctype html>
<html lang="en">
    
    <head>
    @include('backend.layouts.partials.head')
    </head>

    <body data-sidebar="dark">

        <!-- ========== Loader ========== -->
        <div class="loader d-flex justify-content-center">
            <img class="d-block my-auto" src="{{ asset('img/loader.gif') }}" width="250" height="auto" alt="">
        </div>
        <!-- ========== End Loader ========== -->

        <div id="layout-wrapper">

            <!-- ========== Navbar Start ========== -->
            {{-- @include('backend.layouts.partials.navbar') --}}
            <!-- ========== End Navbar Start ========== -->

            <!-- ========== Left Sidebar Start ========== -->
            {{-- @include('backend.layouts.partials.sidebar') --}}
            <!-- ========== End Left Sidebar Start ========== -->

            <!-- ========== Content Start ========== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        @yield('breadcumb')

                        <div class="row mt-2">
                            <div class="col-lg-6 col-xl-6 col-sm-6 mx-auto">
                                <div class="card card-primary" style="border-radius:18px;">
                                    <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                                        <h3 class="card-title text-white">{{ $page_title }}</h3>
                                    </div>
                                    <form method="POST" action="{{ route('backend.vendor.store') }}" id="formPO">
                                        @csrf
                                        <div class="card-body">
                        
                                            @include('backend.components.form-message')
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label for="">Tanggal PO</label>
                                                        <input class="form-control @error('tanggal_po') is-invalid @enderror" id="month"
                                                        type="date" name="tanggal_po" value="{{ date('Y-m-d') }}">
                                                        
                                                        @error('tanggal_po')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-12">
                        
                                                    <div class="form-group mb-3">
                                                        <label for="">No PO</label>
                                                        <input class="form-control @error('no_po') is-invalid @enderror" id="month" type="date"
                                                        name="no_po" value="{{ date('Y-m-d') }}">
                                                        
                                                        @error('no_po')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                        
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label for="">No Inv Vendor</label>
                                                        <input class="form-control @error('no_inv_vendor') is-invalid @enderror" id="month"
                                                        type="text" name="no_inv_vendor">
                                                        
                                                        @error('no_inv_vendor')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                        
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label for="">Tanggal Kirim</label>
                                                        <input class="form-control @error('tanggal_kirim') is-invalid @enderror" id="month"
                                                        type="date" name="tanggal_kirim" value="{{ date('Y-m-d') }}">
                                                        
                                                        @error('tanggal_kirim')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                        
                        
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <label for="">Email Vendor</label>
                                                        <input class="form-control @error('email_vendor') is-invalid @enderror" id="month"
                                                        type="email" name="email_vendor">
                                                        
                                                        @error('vendor_vendor')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                        
                                            </div>
                                        </div>
                                        <div class="card-footer bg-gray1 text-center" style="border-radius:0px 0px 10px 10px;">
                                            <button type="submit" class="btn btn-success btn-footer" style="width: 200px;" onclick="save()">Save</button>
                                            <a href="{{ route('backend.inventory.index') }}" class="btn btn-secondary btn-footer">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                @include('backend.layouts.partials.footer')

            </div>
            <!-- ========== End Content Start ========== -->

        </div>
        <!-- END layout-wrapper -->

        @include('backend.layouts.partials.foot')
    </body>
</html>


@section('script')

@endsection
