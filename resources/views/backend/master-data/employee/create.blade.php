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
<link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
              <a href="{{ route('backend.employee.index') }}" class="btn btn-secondary btn-footer">Back</a>
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
                <h3 class="card-title text-white">{{ $page_title }}</h3>
            </div>
            <form method="POST" action="{{ route('backend.employee.store') }}" novalidate enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    {{-- @include('backend.components.form-message') --}}

                    <div class="form-group mb-3">
                      <label for="name">Employee Name</label>
                      <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Employee Name" required value="{{ old('name') }}">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                    <div class="form-group mb-3">
                        <label for="nik">Nik</label>
                        <input class="form-control @error('nik') is-invalid @enderror" id="nik" type="number" name="nik" placeholder="Nik" required value="{{ old('nik') }}">

                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="npwp">NPWP</label>
                      <input class="form-control @error('npwp') is-invalid @enderror" id="npwp" type="number" name="npwp" placeholder="npwp" required value="{{ old('npwp') }}">

                      @error('npwp')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Gender</label>
                        <div class="form-group">
                          <input type="radio" name="jenis_kelamin" value="Pria">
                          <label class="form-check-label">Pria</label>
                          <input type="radio" name="jenis_kelamin" value="Wanita">
                          <label class="form-check-label">Wanita</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                      <label for="tanggal_lahir">Date Of Birth</label>
                      <input class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" type="date" name="tanggal_lahir" placeholder="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">

                      @error('tanggal_lahir')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message}}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="alamat">Address</label>
                      <textarea name="alamat" class="form-control" rows="3" placeholder="Address"></textarea>

                      @error('alamat')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="no_hp">Phone Number</label>
                      <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" type="number" name="no_hp" placeholder="Phone Number" required value="{{ old('no_hp') }}">

                      @error('no_hp')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                    <div class="form-group mb-3">
                      <label for="upload_ktp">Upload KTP</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('upload_ktp') is-invalid @enderror" value="{{ old('upload_ktp') }}" id="upload_ktp" name="upload_ktp">
                        </div>
                        <div class="small text-danger">*Required (Max 5mb)</div>
                        @error('upload_ktp')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="upload_npwp">Upload NPWP</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('upload_npwp') is-invalid @enderror" value="{{ old('upload_npwp') }}" id="upload_npwp" name="upload_npwp">
                        </div>
                        <div class="small text-danger">*Required (Max 5mb)</div>
                        @error('upload_npwp')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="upload_cv">Upload CV/RESUME</label>
                      <div class="input-group">
                          <input type="file" class="form-control @error('upload_cv') is-invalid @enderror" value="{{ old('upload_resume') }}" id="upload_cv" name="upload_cv">
                      </div>

                      @error('upload_cv')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                      <div class="small text-danger">*Required (Max 10mb)</div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="upload_cv">Upload CV/RESUME</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('upload_cv') is-invalid @enderror" value="{{ old('upload_resume') }}" id="upload_cv" name="upload_cv">
                        </div>
  
                        @error('upload_cv')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
  
                        <div class="small text-danger">*Required (Max 10mb)</div>
                      </div>

                    <div class="form-group mb-3">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control" rows="3" placeholder="Description"></textarea>

                      @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                   
                <div class="card-footer bg-gray1 text-end" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Save And Add</button>
                    {{-- <a href="{{ route('backend.employee.index') }}" class="btn btn-secondary btn-footer">Back</a> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var nik = document.getElementById("nik");
      var npwp = document.getElementById("npwp");
      var no_hp = document.getElementById("no_hp");

      var invalidChars = [
      "-",
      "+",
      "e",
      ];

      nik.addEventListener("keydown", function(e) {
      if (invalidChars.includes(e.key)) {
          e.preventDefault();
      }
      });

      npwp.addEventListener("keydown", function(e) {
      if (invalidChars.includes(e.key)) {
          e.preventDefault();
      }
      });

      no_hp.addEventListener("keydown", function(e) {
      if (invalidChars.includes(e.key)) {
          e.preventDefault();
      }
    });
</script>
@endsection