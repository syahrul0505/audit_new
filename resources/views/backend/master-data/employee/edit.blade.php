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
            {{-- <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4> --}}

            <a href="{{ route('backend.employee.index') }}" class="btn btn-secondary btn-footer">Back</a>


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
            <form action="{{ route('backend.employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="card-body">

                    {{-- @include('backend.components.form-message') --}}
                  
                    <div class="form-group mb-3">
                        <label for="nik">NIK</label>
                        <input class="form-control @error('nik') is-invalid @enderror" id="nik" type="number" name="nik" placeholder="Nik " required value="{{ old('nik') ?? $employee->nik }}">

                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Employee Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="name " required value="{{ old('name') ?? $employee->name }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="npwp">NPWP</label>
                      <input class="form-control @error('npwp') is-invalid @enderror" id="npwp" type="number" name="npwp" placeholder="NPWP " required value="{{ old('npwp') ?? $employee->npwp }}">

                      @error('npwp')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="">Gender</label>
                      <div class="form-group">
                        <input type="radio" name="jenis_kelamin" value="Pria" {{ ($employee->jenis_kelamin=="Pria")? "checked" : "" }}>
                        <label class="form-check-label">Pria</label>
                        <input type="radio" name="jenis_kelamin" value="Wanita" {{ ($employee->jenis_kelamin=="wanita")? "checked" : "" }}>
                        <label class="form-check-label">Wanita</label>
                      </div>
                    </div>

                    <div class="form-group mb-3">
                      <label for="tanggal_lahir">Date Of Birth</label>
                      <input class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" type="date" name="tanggal_lahir" placeholder="Date Of Birth " required value="{{ old('tanggal_lahir') ?? $employee->tanggal_lahir }}">

                      @error('tanggal_lahir')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    
                    <div class="form-group mb-3">
                      <label for="alamat">Address</label>
                      <textarea name="alamat" class="form-control" rows="3" placeholder="alamat">{{ $employee->alamat }}</textarea>
                      
                      @error('alamat')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="no_hp">Phone Number</label>
                      <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" type="number" name="no_hp" placeholder="Phone Number" required value="{{ old('no_hp') ?? $employee->no_hp }}">

                      @error('no_hp')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="form-group mb-3">
                      <label for="upload_ktp">Image KTP :</label>
                      <img src="{{ asset('img/employee/'.($employee->upload_ktp ?? 'user.png')) }}" width="110px" class="image img" />

                      <div class="input-group mt-3">
                          <input type="file" class="form-control" id="upload_ktp" name="upload_ktp">
                      </div>
                      {{-- <div class="small text-secondary">Kosongkan jika tidak mau diisi</div> --}}
                    </div>
                    
                    <div class="form-group mb-3">
                      <label for="upload_npwp">Image NPWP :</label>
                      <img src="{{ asset('img/employee/'.($employee->upload_npwp ?? 'user.png')) }}" width="110px" class="image img" />

                      <div class="input-group mt-3">
                          <input type="file" class="form-control" id="upload_npwp" name="upload_npwp">
                      </div>
                      {{-- <div class="small text-secondary">Kosongkan jika tidak mau diisi</div> --}}
                    </div>

                    <div class="form-group mb-3">
                      <label for="upload_cv">Image CV/RESUME :</label>
                      {{-- <img src="{{ asset('img/employee/'.($employee->upload_cv ?? 'user.png')) }}" width="110px" class="image img" /> --}}

                      @if (substr($employee->upload_cv, -3) == 'pdf')
                          <div class="d-flex flex-wrap gap-3 ml-3">
                              {{-- <button type="submit" name="pdf" value="pdf" class="btn btn-danger waves-effect waves-light"> <i class="bx bxs-file-pdf"> {{ $employee->upload_cv }}</button></i> --}}
                              <a href="{{ asset('img/employee/'.($employee->upload_cv ?? 'user.png')) }}"  class="btn btn-danger waves-effect waves-light" target="_blank"><i class="bx bxs-file-pdf"> {{ $employee->upload_cv }}</i></a>

                          </div>
                          @else
                          <img class="" src="{{ asset('img/employee/user.png') }}" width="110px" class="image img">
                          @endif
                      <div class="input-group mt-3">
                          <input type="file" class="form-control" id="upload_cv" name="upload_cv">
                      </div>
                      {{-- <div class="small text-secondary">Kosongkan jika tidak mau diisi</div> --}}
                    </div>
                    
                    <div class="form-group mb-3">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ $employee->description }}</textarea>

                      @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
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