<div class="row mt-4">
    <div class="col-lg-6">
        <div style="border-radius: 15px">
            <div class="card-body">
                {{-- {{ dd($email) }} --}}
                <img src="{{ asset('img/MPI.png') }}" style="width: 200px; height:100px;" alt="">
                <hr>
                <span class="fw-bold" style="font-size: 16px">Tanggal Dibuat: {{date('d/m/Y', strtotime($tanggal_kirim[0]))}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Email : {{($email ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Status :  {{($status)}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">No Faktur Pajak : {{($no_faktur ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Note : {{($description ?? 'N/A')}}</span>
                {{-- <span class="fw-bold" style="font-size: 16px">Note : {{($no_po ?? 'N/A')}}</span> --}}
                <br><br>
                {{-- <h1>tes</h1> --}}
            </div>
        </div>
    </div>
</div>

<div class="card" style="border-radius:15px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table  table-hover mb-0" id="HistoryTable">
                <thead>
                    <tr>
                        <th style="padding-right: 30px !important; text-align:left !important;">NO</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">No Po</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">Tanggal Po</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">No Invoice</th>
                        <th style="padding-right: 30px !important; text-align:left !important;">Tanggal Kirim</th>
                    </tr>
                </thead>
                    <tbody>
                        {{-- {{ dd($data) }} --}}
                        @foreach ($no_po as $key => $np) 
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{ $loop->iteration }}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$no_po[$key]}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$tanggal_po[$key]}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$no_invoice[$key]}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important;">
                                    {{$tanggal_kirim[$key]}}
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>
