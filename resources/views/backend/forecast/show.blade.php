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
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('backend.forecast.index')}}"></a>Production</li>
                    <li class="breadcrumb-item active" aria-current="page">Production Detail</li>
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
                    <h4 class="text-center">{{$forecast->product->name}} - {{date('F Y', strtotime($forecast->date))}}</h4>
                    <hr>
                    <span class="fw-bold" style="font-size: 16px">Tanggal Dibuat: {{date('d/m/Y', strtotime($forecast->created_at))}}</span>
                    <br><br>
                    <span class="fw-bold" style="font-size: 16px">{{$forecast->employee->name}}</span>
                    <br>
                    <span style="font-size: 16px">NIK: {{$forecast->employee->nik}}</span>
                </div>
            </div>
        </div>
        @if ($forecast->description != '')
        <div class="col-lg-6">
            <div class="card" style="border-radius: 15px">
                <div class="card-body">
                    <h4 class="text-center">Note</h4>
                    <hr>
                    <span style="font-size: 16px">{{$forecast->description}}</span>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="card" style="border-radius:15px;">
            <div class="card-header card-primary" style="border-radius:15px 15px 0px 0px;">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-1" style="font-size:1.2rem;">
                        <span class="tx-bold tx-dark text-lg">
                            <h5>Material</h5>
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-hover mb-0" id="HistoryTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ITEM</th>
                                <th>QTY</th>
                                {{-- <th>UNIT PRICE</th>  --}}
                                {{-- <th>TOTAL</th> --}}
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($forecast_product as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->material->name ?? ''}}</td>
                                    <td>{{$item->description}}</td>
                                 </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection

@section('script')
    
@endsection