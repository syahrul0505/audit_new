@extends('backend.layouts.app')

@section('style')
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
                    <li class="breadcrumb-item"><a href="{{ route('backend.inventory_product.index') }}">Inventory Product</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                
                <div class="card-header" style="background-color: #2a3042dc !important; border-radius:10px 10px 0px 0px;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 mt-1 text-white" style="font-size:1.2rem;">
                            <span class="tx-bold tx-dark text-white text-lg">
                                <i class="far fa-building text-lg"></i>
                                {{$page_title}}
                            </span>
                        </div>

                        @can('departement-create')
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('backend.stock_out_product.create') }}" class="btn btn-md btn-info">
                                <i class="fa fa-plus"></i> 
                                Add New
                            </a>
                        </div>
                        
                        @endcan
                    </div>
                </div>

                <div class="card-header" style="background-color: white !important; border-radius:10px 10px 0px 0px;">
                    <div class="row align-items-center justify-content-between flex-wrap">
                        <div class="col-4 col-sm-3 col-md-4 col-lg-4 col-xl-4">
                            <div class="main-title">
                                <a href="{{ route('backend.inventory_product.index') }}">
                                    <div class="btn btn-warning btn-sm ml-10">
                                        <i class="ti-back-left"></i>
                                        Back
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            @include('backend.components.flash-message')
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover d-none" id="departementTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Outgoing</th>
                                    <th>Employee</th>
                                    <th>Description</th>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($stock_out as $stock_outs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stock_outs->product->name ?? ''}}</td>
                                    <td>{{ $stock_outs->product_outgoing}}</td>
                                    <td>{{ $stock_outs->employee->name ?? ''}}</td>
                                    <td>{{ $stock_outs->description }}</td>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <td>
                                        <div class="btn-group">
                                            {{-- @can('departement-edit')
                                            <a href="{{ route('backend.stock_out_product.edit', $stock_outs->id) }}"
                                                class="btn btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>
                                            @endcan --}}

                                            @can('departement-delete')
                                            <a href="#" class="btn btn-danger f-12" onclick="modalDelete('Stock Out', '{{ $stock_outs->name }}', '/aduitt/admin/stock_out_product/' + {{ $stock_outs->id }}, '/aduitt/admin/stock_out_product/')">
                                                <i class="far fa-trash-alt"></i>
                                                Delete
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@section('script')

@endsection