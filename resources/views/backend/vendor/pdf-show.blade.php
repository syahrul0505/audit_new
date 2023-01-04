<div class="row mt-4">
    <div class="col-lg-6">
        <div style="border-radius: 15px">
            <table>
                <tr>
                    <td>
                        <img src="{{ asset('img/MPI.png') }}" style="width: 100px; height:50px;" alt="">
                    </td>
                    <td>
                        <h2 style="margin-left:10px; margin-top: 0px; margin-bottom: 0px;">
                            PT. Megah Pita Indonesia
                        </h2>
                        <p style="margin-left:10px; margin-top: 0px; margin-bottom: 0px;">
                            Jl. Pangeran Jayakarta 68 Blok B 11 Jakarta Pusat 10730 Telp : 021 6007212
                        </p>
                    </td>   
                </tr>
            </table>
            {{-- {{ dd($vendor->tanggal_kirim) }} --}}
            {{-- <div style="display: flex !important; flex-wrap: nowrap !important;">
                <div style="">
                </div>
                <div style=""> 
                </div>
            </div> --}}
            <div class="">
                <div class="">
                    
                </div>
                <hr>
                <span class="fw-bold" style="font-size: 16px">Tanggal Dibuat: {{date('d/m/Y', strtotime($vendor->vendorPivot[0]->tanggal_kirim))}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Email : {{($vendor->email ?? 'N/A')}}</span>
                <br>
                <span class="fw-bold" style="font-size: 16px">Status :  {{($vendor->status)}}</span>
                <br>
                {{-- <span class="fw-bold" style="font-size: 16px">Total : Rp.{{($total ?? 'N/A')}}</span>
                <br> --}}
                <br>
                <h3 style="text-align: center"><b> Tanda Terima:</b></h3>
                @if ($vendor->status == 'Approve')
                    <h3 style="text-align: center"><b> No. {{ $vendor->no_po }}</b></h3>
                @else
                    <h3 style="text-align: center"><b> N/A</b></h3>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card" style="border-radius:15px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table  table-hover mb-0" id="HistoryTable" style="">
                <thead style="">
                    <tr>
                        <th style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">NO</th>
                        <th style="padding-right: 30px !important; text-align:left !important; width: 100px; border: 1px solid #000">No Po</th>
                        <th style="padding-right: 30px !important; text-align:left !important; width: 100px; border: 1px solid #000">Tanggal Po</th>
                        <th style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">No Invoice</th>
                        <th style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">Tanggal Kirim</th>
                        <th style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">Amount</th>
                    </tr>
                </thead>
                    <tbody style="">
                        @php
                        $sum = 0;   
                        @endphp
                        @foreach ($vendor->vendorPivot as $np) 
                        @php
                        $sum += $np->amount;   
                        @endphp
                        {{-- {{ dd($amount) }} --}}
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{ $loop->iteration }}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{$np->no_po}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{ date('d-m-Y', strtotime($np->tanggal_po)) }}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{$np->no_invoice}}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{ date('d-m-Y', strtotime($np->tanggal_kirim)) }}
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{number_format($np->amount) ?? ''}}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    &nbsp; 
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{-- Total :  --}} &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{-- {{number_format($sum, 2) ?? ''}} --}} &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{-- Pembayaran Ke : --}} &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{-- PPN 11%  --}} &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{-- {{number_format($sum * 0.11, 2) ?? ''}} --}} &nbsp;

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">

                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{-- BCA PT.MEGAH Indonesia --}} &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000" >
                                    {{-- AC.No.241,300,8,999 --}} &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   &nbsp;
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                   
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">

                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    Total Invoice : 
                                </td>
                                <td style="padding-right: 30px !important; text-align:left !important; border: 1px solid #000">
                                    {{number_format($sum) ?? ''}}
                                </td>
                            </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<div class="">
    <table>
        <tr>
            <td>
                {{-- <p style="margin-left:20px; margin-top: 10px; margin-bottom: 0px;">NOTE: SURAT JALAN,INVOICE</p> --}}
                <textarea name="description" class="form-control" style="width: 380px; height: 100px;"  placeholder="Description">NOTE : {{ $vendor->description }}</textarea>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-left:465px; margin-top: 35px; margin-bottom: 0px;">Jakarta, {{ date('d F Y') }}</p>
                <p style="margin-left:465px; margin-top: 0px; margin-bottom: 0px;">dibuat Oleh,</p>
                <p style="margin-left:465px; margin-top: 60px; margin-bottom: 0px;">( <span style="margin-left: 50px;" > {{ $vendor->dibuat }} <span style="margin-left: 50px;">)</span> </span></p>
            </td>
        </tr>
    </table>
</div>
