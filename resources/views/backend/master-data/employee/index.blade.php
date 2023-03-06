@extends('backend.layouts.app')

@section('style')
<style>
    .description{
        width: 25%;
    }

    .date_of{
        width: 15%;
    }

    @media only screen and (max-width: 414px) {
        .description{
            width: 100% !important;
            /* background-color: aqua !important; */
        }
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
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.absen.index') }}">Absen</a></li>
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
                            <a href="{{ route('backend.employee.create') }}" class="btn btn-md btn-info">
                                <i class="fa fa-plus"></i> 
                                Add New
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
                                    <th>NIK </th>
                                    <th>Employee Name </th>
                                    <th>NPWP</th>
                                    <th>Gender</th>
                                    <th class="date_of">Date Of Birth</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Image KTP</th>
                                    <th>Image NPWP</th>
                                    <th>CV/RESUME</th>
                                    <th>Document</th>
                                    <th class="description">Description</th>
                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($employee as $employees)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $employees->nik}}</td>
                                    <td>{{ $employees->name}}</td>
                                    <td>{{ $employees->npwp}}</td>
                                    <td>{{ $employees->jenis_kelamin}}</td>
                                    <td>{{ date('d-m-Y', strtotime($employees->tanggal_lahir));}}</td>
                                    <td>{{ $employees->alamat}}</td>
                                    <td>{{ $employees->no_hp}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-{{ $employees->id }}">KTP</button>
                                        <div class="modal fade bs-example-modal-center-{{ $employees->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="card">
                                                        @if ($employees->upload_ktp != null)
                                                        <img class="card-img-top img-fluid" src="{{ asset('img/employee/'.$employees->upload_ktp) }}" alt="Card image cap">
                                                        <div class="card-body">
                                                            
                                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                            <a href="{{ asset('img/employee/'.($employees->upload_ktp ?? 'user.png')) }}" download="KTP" class="btn btn-primary waves-effect waves-light">Download</a>
                                                        </div>
                                                        @else
                                                        <img class="card-img-top img-fluid" src="{{ asset('img/employee/user.png') }}" alt="Card image cap">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                        
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-npwp{{ $employees->id }}">NPWP</button>
                                        <div class="modal fade bs-example-modal-npwp{{ $employees->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="card">
                                                        @if ($employees->upload_npwp != null)
                                                        <img class="card-img-top img-fluid" src="{{ asset('img/employee/'.$employees->upload_npwp) }}" alt="Card image cap">
                                                        <div class="card-body">
                                                            
                                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                            <a href="{{ asset('img/employee/'.($employees->upload_npwp ?? 'user.png')) }}" download="NPWP" class="btn btn-primary waves-effect waves-light">Download</a>
                                                        </div>
                                                        @else
                                                        <img class="card-img-top img-fluid" src="{{ asset('img/employee/user.png') }}" alt="Card image cap">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                        
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if (substr($employees->upload_cv, -3) == 'pdf')
                                        <div class="d-flex flex-wrap gap-3 ml-3">
                                            <a href="{{ asset('img/employee/'.($employees->upload_cv ?? 'user.png')) }}" target="_blank" class="btn btn-danger waves-effect waves-light"> <i class="bx bxs-file-pdf">{{ $employees->upload_cv }}</i></a>
                                        </div>
                                        @else
                                        <img class="card-img-top img-fluid" src="{{ asset('img/employee/user.png') }}" alt="Card image cap">
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if (substr($employees->upload_document, -4) == 'docx' || 'pdf')
                                            <div class="">
                                                <a href="{{ asset('img/employee/'.$employees->upload_document ) }}" target="_blank" class="btn btn-danger waves-effect waves-light"> <i class="bx bxs-file-pdf">{{ $employees->upload_document }}</i></a>
                                            </div>
                                        @else
                                            <img class="card-img-top img-fluid" src="{{ asset('img/employee/'.$employees->upload_document) }}" alt="Card image cap">
                                            <a href="{{ asset('img/employee/'.$employees->upload_document ) }}" download="Document" class="btn btn-primary waves-effect waves-light">Download</a>
                                            </div>
                                        @endif
                                        
                                    </td>

                                    <td>{{ $employees->description }}</td>

                                    @if(auth()->user()->can('departement-delete') || auth()->user()->can('departement-edit'))
                                    <td>
                                        <div class="btn-group">
                                            @can('departement-edit')
                                            <a href="{{ route('backend.employee.edit', $employees->id) }}"
                                                class="btn btn-warning text-white">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>
                                            @endcan

                                            @can('departement-delete')
                                            <a href="#" class="btn btn-danger f-12" onclick="modalDelete('Employee', '{{ $employees->name }}', '/aduitt/admin/master-data/employee/' + {{ $employees->id }}, '/aduitt/admin/master-data/employee/')">
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