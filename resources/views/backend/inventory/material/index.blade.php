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
                    <li class="breadcrumb-item"><a href="{{ route('backend.inventory_product.index') }}">Inventory Material</a></li>
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
                            <a href="{{ route('backend.inventory_material.create') }}" class="btn btn-md btn-info">
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
                                <a href="{{ route('backend.inventory_product.create') }}">
                                    <div class="btn btn-warning btn-sm ml-10">
                                        <i class="ti-back-left"></i>
                                        Back
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-8 col-sm-9 col-md-8 col-lg-8 col-xl-8 text-right">
                            <a href="{{ route('backend.stock_in_material.index') }}">
                                <div class="btn btn-success btn-sm ml-10">
                                    <i class=""></i>
                                    Stock In
                                </div>
                            </a>
    
                            <a href="{{ route('backend.stock_out_material.index') }}">
                                <div class="btn btn-danger btn-sm ml-10">
                                    <i class=""></i>
                                    Stock Out 
                                </div>
                            </a>
    
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
                                    <th>Date </th>
                                    <th>Material Name</th>
                                    <th>Begin Stock</th>
                                    <th>Total Stock</th>
                                    <th>Unit</th>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventory_material as $inventory_materials)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inventory_materials->date}}</td>
                                    <td>{{ $inventory_materials->date}}</td>
                                    <td>{{ $inventory_materials->begin_stock}}</td>
                                    <td>{{ $inventory_materials->totalStock($inventory_materials->material_id)}}</td>
                                    <td>{{ $inventory_materials->unit }}</td>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <td>
                                        <div class="btn-group">
                                            @can('departement-edit')
                                            <a href="{{ route('backend.inventory_material.edit', $inventory_materials->id) }}"
                                                class="btn btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>
                                            @endcan

                                            @can('departement-delete')
                                            <a href="#" class="btn btn-danger f-12" onclick="modalDelete('Inventory Material', '{{ $inventory_materials->name }}', '/aduitt/admin/inventory/inventory_material/' + {{ $inventory_materials->id }}, '/aduitt/admin/inventory/inventory_material/')">
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