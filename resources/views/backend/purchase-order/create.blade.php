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
                    <li class="breadcrumb-item active"><a href="{{ route('backend.absen.index') }}">Absen</a></li>
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
            <form method="POST" action="{{ route('backend.inventory_product.store') }}" novalidate>
                @csrf
                <div class="card-body">

                    @include('backend.components.form-message')

                    <div class="form-group mb-3">
                        <label>Product</label>

                        <select class="form-control js-example-basic-single @error('forecast_id') is-invalid @enderror" name="forecast_id">
                            <option disabled selected>Choose Production</option>
                            @foreach ($forecast as $forecasts)
                            <option value="{{ $forecasts->id }}"
                                {{ old('forecast_id') == $forecasts->id ? 'selected' : '' }}>
                                {{ $forecasts->product->name }} </option>
                            @endforeach
                        </select>
                        @error('forecast_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Po Number</label>
                        <input class="form-control @error('date') is-invalid @enderror" id="date" type="date" name="text" placeholder="Po Number" required>

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Vendor</label>
                        <input class="form-control @error('date') is-invalid @enderror" id="date" type="date" name="vendor" placeholder="Vendor" required>

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <select class="" name="state">
                            <option value="AL">Alabama</option>
                              ...
                            <option value="WY">Wyoming</option>
                          </select>
                    </div>

                    

                    <div class="form-group mb-3">
                        <label for="begin_stock">Begin Stock</label>
                        <input class="form-control @error('begin_stock') is-invalid @enderror" id="begin_stock" type="number" name="begin_stock" placeholder="Begin Stock" required value="{{ old('begin_stock') }}">

                        @error('begin_stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                   
                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Add</button>
                    <a href="{{ route('backend.inventory.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    });
</script>
@endsection