<!DOCTYPE html>
<html>
<head>
    <style>
        #ownerPdf {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #ownerPdf td, #ownerPdf th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #ownerPdf tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #ownerPdf tr:hover {
            background-color: #ddd;
        }

        #ownerPdf th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #96b4a9;
            color: white;
        }
    </style>
</head>
<body>
@if($owners->ownerProperties)
    <table id="ownerPdf">
        <thead>
        <tr>
            <th>#</th>
            <th>Property Name</th>
            <th>Bank Account</th>
            <th>Income</th>
        </tr>
        </thead>
        <tbody>
        @php
            $total_income=0;
        @endphp
        @foreach($owners->ownerProperties as $ownerProperty)
            @if($ownerProperty->property->bookings)
                @foreach($ownerProperty->property->bookings as $ownerBooking)
                    @php
                        $total_income+=$ownerBooking->total_price;
                    @endphp
                    <tr>
                        <td>{{$ownerBooking->id}}</td>
                        <td>{{$ownerProperty->property->name}}</td>
                        <td>{{$ownerProperty->property->name}}</td>
                        <td>{{$ownerBooking->total_price}}</td>
                    </tr>
                @endforeach

            @endif
        @endforeach
        <tr>
            <td colspan="3" style="text-align: right;">Total Payment</td>
            <td class="total-income">{{$total_income}}</td>
        </tr>
        </tbody>
    </table>
@endif
</body>
</html>