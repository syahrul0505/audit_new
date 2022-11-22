<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    <div class="card-body">
        <div class="table-r esponsive">
            <table class="table datatable table-hover" style="border: 1px solid black">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="margin-left: 200px;">{{ $data['email'] }}</td>
                        <td style="margin-left: 200px;">{{ $data['status'] }}</td>
                        @if ( $data['status'] == 'Approve')
                                <td><h5>
                                <span style="color: #19e0fa;">{{ $data['status'] }}</span></h5>
                                </td>
                                @elseif($data['status'] == 'WO Belum Dikerjakan')
                                <td>
                                    <h5>
                                    <span style="color: #ff3224;">{{ $data['status'] }}</span>
                                    </h5>
                                </td>
                                @elseif($data['status'] == 'WO Sudah Selesai')
                                <td>
                                    <h5>
                                    <span style="color: #00f73a;">{{ $data['status'] }}</span>
                                    </h5>
                                </td>
                                @endif
                        {{-- <td style="margin-left: 200px; color:blue">{{ $data['status'] }}</td> --}}
                        <td style="margin-left: 200px;">{{ $data['description   '] }}</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>