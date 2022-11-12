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
            {{-- <td rowspan="2" style="width: 25px; margin: auto; text-align: center; border: 1px solid black;">Date</td> --}}
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Material</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Total Stock</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Stock Awal</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Stock In</td>
            <td rowspan="2" style="width: 150px; margin: auto; text-align: center; border: 1px solid black;">Stock Out</td>
        </tr>
        <tr></tr>

        @foreach ($materials as $item)
        <tr>
            <td style="border: 1px solid black">{{ $loop->iteration }}</td>
            {{-- <td style="border: 1px solid black">{{date('d-m-Y', strtotime($products->created_at))}}</td> --}}
            <td style="border: 1px solid black">{{$item->material->name}}</td>
            <td style="border: 1px solid black">{{$item->totalStock($item->material->id)}}</td>
            <td style="border: 1px solid black">{{$item->begin_stock}}</td>
            <td style="border: 1px solid black">{{$item->stockIncoming($item->material->id)}}</td>
            <td style="border: 1px solid black">{{$item->stockOutgoing($item->material->id)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>