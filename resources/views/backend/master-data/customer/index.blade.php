@extends('backend.layouts.app')

@section('style')
@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center              ">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.material.index') }}">Customer</a></li>
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
                                <i class="fas fa-users text-lg"></i>
                                {{$page_title}}
                            </span>
                        </div>

                        @can('departement-create')
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('backend.customer.create') }}" class="btn btn-md btn-info">
                                <i class="fa fa-plus"></i> 
                                Add New Customer
                            </a>
                        </div>
                        @endcan
                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{-- @include('backend.components.flash-message') --}}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover d-none" id="departementTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer Type </th>
                                    <th>Name</th>
                                    <th>City</th>
                                    <th>Alamat</th>
                                    <th>Pos Code</th>
                                    <th>No Tlp</th>
                                    <th>Name PPIC</th>
                                    <th>Email</th>
                                    <th>Term Of Payment</th>
                                    {{-- <th>Sales Person In Charge</th> --}}
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customer as $customers)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customers->customer}}</td>
                                    <td>{{ $customers->name}}</td>
                                    <td>{{ $customers->kota}}</td>
                                    <td>{{ $customers->alamat ?? 'N/A'}}</td>
                                    <td>{{ $customers->kode_pos }}</td>
                                    <td>{{ $customers->no_tlp}}</td>
                                    <td>{{ $customers->name_ppic}}</td>
                                    <td>{{ $customers->email}}</td>
                                    <td>{{ $customers->term_of_payment}}</td>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <td>
                                        <div class="btn-group">
                                            @can('departement-edit')
                                            <a href="{{ route('backend.customer.edit', $customers->id) }}"
                                                class="btn btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>
                                            @endcan

                                            @can('departement-delete')
                                            <a href="#" class="btn btn-danger f-12" onclick="modalDelete('Customer', '{{ $customers->name }}', '/aduitt/admin/master-data/customer/' + {{ $customers->id }}, '/aduitt/admin/master-data/customer/')">
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