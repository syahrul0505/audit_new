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
                    <li class="breadcrumb-item"><a href="{{ route('vendor.index') }}">Vendor</a></li>
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

                        {{-- @can('departement-create')
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('backend.vendor.create') }}" class="btn btn-md btn-info">
                                <i class="fa fa-plus"></i> 
                                Add New
                            </a>
                        </div>
                        
                        @endcan --}}
                    </div>
                </div>

                <div class="card-header" style="background-color: white !important; border-radius:10px 10px 0px 0px;">
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
                                    {{-- <th>Employee Name</th> --}}
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($vendor as $vendors)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vendors->email ?? 'N/A'}}</td>
                                    
                                    @if ($vendors->status == 'Pending')
                                    
                                    <td class="text-warning"><b>{{ $vendors->status ?? 'N/A'}}</b></td>

                                    @elseif($vendors->status == 'Approve')
                                    <td class="text-success"><b>{{ $vendors->status ?? 'N/A'}}</b></td>
                                    
                                    @elseif($vendors->status == 'Reject')
                                    <td class="text-danger"><b>{{ $vendors->status ?? 'N/A'}}</b></td>
                                    
                                    @else
                                    <td><b>N/A</b></td>
                                    @endif
                                    
                                    <td>{{ $vendors->description ?? 'N/A'}}</td>
                                    <td>{{ $vendors->total ?? 'N/A'}}</td>
                                    <td>
                                        <a href="{{route('vendor.show', $vendors->id)}}"
                                            class="btn btn-info text-white">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- <a href=""
                                            class="btn btn-secondary text-white">
                                            <i class="bx bxs-file-pdf"></i>
                                        </a> --}}

                                        <div class="btn-group">
                                            @can('departement-edit')
                                            <a href="{{ route('vendor.edit', $vendors->id) }}"
                                                class="btn btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>
                                            @endcan

                                            @can('departement-delete')
                                            <a href="#" class="btn btn-danger f-12" onclick="modalDelete('Vendor', '{{ $vendors->name }}', '/aduitt/vendor/' + {{ $vendors->id }}, '/aduitt/vendor/')">
                                                <i class="far fa-trash-alt"></i>
                                                Delete
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
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