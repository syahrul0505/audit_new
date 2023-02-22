@extends('backend.layouts.app')

@section('style')
<style>
    .description{
        width: 25%;
    }

    @media only screen and (max-width: 500px) {
        .description{
            width: 100% !important;
            background-color: aqua !important;
        }
    }
</style>
@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.product.index') }}">Product</a></li>
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
                        <div class="col-6 mt-1 text-white my-auto" style="font-size:1.2rem;">
                            <span class="tx-bold tx-dark text-white text-lg">
                                <i class="fas fa-boxes text-lg"></i>
                                {{$page_title}} 
                            </span>
                        </div>
                        {{-- @include('backend.components.flash-message') --}}

                        @can('departement-create')
                        <div class="col-6 text-end my-auto">
                            <a href="{{ route('backend.product.create') }}" class="btn btn-md btn-info">
                                <i class="fa fa-plus"></i> 
                                Add New Product
                            </a>
                        </div>
                        @endcan
                    </div>

                    <div class="row">
                        <div class="col-6">
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover d-none dataTables_filter" id="departementTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Code </th>
                                    <th>Product Name</th>
                                    <th>Merk</th>
                                    <th>Jenis Barang</th>
                                    <th>Ukuran Barang</th>
                                    <th>Quantity</th>
                                    {{-- <th>Unit</th> --}}
                                    <th class="description">Description</th>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($product as $products)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $products->code}}</td>
                                    <td>{{ $products->name}}</td>
                                    <td>{{ $products->merk ?? 'N/A'}}</td>
                                    <td>{{ $products->jenis_barang}}</td>
                                    <td>{{ $products->ukuran_barang. ($products->satuan_barang)}}</td>
                                    <td>{{ $products->qty }} ({{ $products->unit}})</td>
                                    {{-- <td>{{ $products->unit}}</td> --}}
                                    <td>{{ $products->description }}</td>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <td>
                                        <div class="btn-group">
                                            @can('departement-edit')
                                            <a href="{{ route('backend.product.edit', $products->id) }}"
                                                class="btn btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>
                                            @endcan

                                            @can('departement-delete')
                                            <a href="#" class="btn btn-danger f-12" onclick="modalDelete('Product', '{{ $products->name }}', '/aduitt/admin/master-data/product/' + {{ $products->id }}, '/aduitt/admin/master-data/product/')">
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

@push('script')

@endpush