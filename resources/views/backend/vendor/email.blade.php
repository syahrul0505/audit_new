<div class="row mt-4">
    <div class="col-lg-6">
        <div style="border-radius: 15px">
            <div class="card-body">
                {{-- {{ dd($data['email'][0]) }} --}}
                <img src="{{ asset('img/MPI.png') }}" style="width: 200px; height:100px;" alt="">
                {{-- <h1>tes</h1> --}}
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
