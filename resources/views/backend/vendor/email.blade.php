<div class="row mt-4">
    <div class="col-lg-6">
        <div style="border-radius: 15px">
            <div class="card-body">
                <h4 class="text-center">{{$data->email}} - {{date('F Y', strtotime($data->created_at))}}</h4>
                <hr>
                <span class="fw-bold" style="font-size: 16px">Tanggal Dibuat: {{date('d/m/Y', strtotime($data->created_at))}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Email : {{($data->email ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Status :  {{($data->status)}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">No Faktur : {{($data->no_faktur ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Note : {{($data->description ?? 'N/A')}}</span>
                {{-- {{ dd($data->vendorPivot) }} --}}
                <br><br>
            </div>
        </div>
    </div>
</div>
    {{-- <div class="card" style="border-radius:15px;">
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
                                {{ dd($data->dataPivot) }}
                                @if ($data->dataPivot->count() > 0)
                                            @foreach ($data->dataPivot as $key => $dataPivot)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{$dataPivot->no_po}}
                                                </td>
                                                <td>
                                                    {{$dataPivot->tanggal_po}}
                                                </td>
                                                <td>
                                                    {{$dataPivot->no_invoice}}
                                                </td>
                                                <td>
                                                    {{$dataPivot->tanggal_kirim}}
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
