<table>
    <thead>
        <tr>
            <th colspan="4" rowspan="3" style="border: 1px solid black;text-align: center;"></th>
            {{-- <th colspan="3" rowspan="3" style="border: 1px solid black; font-weight: bolder; text-align:center;" >{{ date('F Y', strtotime($date)) }}</th> --}}
        </tr>
        <tr></tr>
    </thead>
    <tbody>
        <tr></tr>
        <tr style="background-color:black">
            <td rowspan="2" style="width: 25px; margin: auto; text-align: center; border: 1px solid black;">No</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Product</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Total Stock</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Stock Awal</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Stock In</td>
            <td rowspan="2" style="width: 50px; margin: auto; text-align: center; border: 1px solid black;">Stock Out</td>
            <td rowspan="2" style="width: 50px; margin: auto; text-align: center; border: 1px solid black;">Unit</td>
        </tr>
        <tr></tr>

        @foreach ($products as $item)
        <tr>
            <td style="border: 1px solid black">{{ $loop->iteration }}</td>
            <td style="border: 1px solid black">{{$item->product->name}}</td>
            {{-- <td style="border: 1px solid black">{{$item->calculateStock($item->product->id)}}</td> --}}
            {{-- <td style="border: 1px solid black">{{$item->stok_awal}}</td> --}}
            {{-- <td style="border: 1px solid black">{{$item->stockIncoming($item->product->id)}}</td> --}}
            {{-- <td style="border: 1px solid black">{{$item->stockOutgoing($item->product->id)}}</td> --}}
            {{-- <td style="border: 1px solid black">{{$item->product->unit->name}}</td> --}}
        </tr>
        @endforeach
    </tbody>
</table>