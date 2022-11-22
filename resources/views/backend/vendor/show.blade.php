@extends('backend.layouts.app')

@section('style')
    
@endsection

    @section('breadcumb')
    <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('backend.master-data.index')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('vendor.index')}}"></a>List Finance</li>
                    <li class="breadcrumb-item active" aria-current="page">List Finance Detail</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end( breadcrumb-->
@endsection

@section('content')
<div class="row mt-4">
        <div class="col-lg-6">
            <div class="card animated fadeInLeft" style="border-radius: 15px">
                <div class="card-body">
                    <h4 class="text-center">{{$vendor->email}} - {{date('F Y', strtotime($vendor->created_at))}}</h4>
                    <hr>
                    <span class="fw-bold" style="font-size: 16px">Tanggal Dibuat: {{date('d/m/Y', strtotime($vendor->created_at))}}</span>
                    <br>
                    <span class="fw-bold" style="font-size: 16px">Email : {{($vendor->email)}}</span>
                    <br>
                    <span class="fw-bold" style="font-size: 16px">Status :  {{($vendor->status)}}</span>
                    <br>
                    <span class="fw-bold" style="font-size: 16px">Note : {{($vendor->note)}}</span>
                    <br><br>
                </div>
            </div>
        </div>
        @if ($vendor->description != '')
        <div class="col-lg-6">
            <div class="card" style="border-radius: 15px">
                <div class="card-body">
                    <h4 class="text-center">Note</h4>
                    <hr>
                    <span style="font-size: 16px">{{$vendor->description}}</span>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="card" style="border-radius:15px;">
            {{-- <div class="card-header card-primary" style="border-radius:15px 15px 0px 0px;">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-1" style="font-size:1.2rem;">
                        <span class="tx-bold tx-dark text-lg">
                            <h5>Material</h5>
                        </span>
                    </div>
                </div>
            </div> --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-hover mb-0" id="HistoryTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>No Po</th>
                                <th>Tanggal Po</th>
                                <th>No Invoice</th>
                                <th>Tanggal Kirim</th>
                            </tr>
                        </thead>
                            <tbody>
                                @if ($vendor->vendorPivot->count() > 0)
                                            @foreach ($vendor->vendorPivot as $key => $vendorPivot)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{$vendorPivot->no_po}}
                                                </td>
                                                <td>
                                                    {{$vendorPivot->tanggal_po}}
                                                </td>
                                                <td>
                                                    {{$vendorPivot->no_invoice}}
                                                </td>
                                                <td>
                                                    {{$vendorPivot->tanggal_kirim}}
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection

@section('script')
    
@endsection