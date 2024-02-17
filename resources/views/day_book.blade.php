<!DOCTYPE html>
<html>

<head>
    <style>
        h1,
        h2,
        h3 {
            text-align: center;
        }

        /* Add your CSS styles for the PDF here */
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        h2 {
            color: #555;
            font-size: 20px;
            margin-bottom: 8px;
        }

        h3 {
            color: #777;
            font-size: 18px;
            margin-bottom: 6px;
        }

        .header {
            text-align: center;
            position: relative;
        }

        .header img {
            height: 100px;
            position: relative;
            max-width: 100%;
            border-radius: 0.25em;
            /* Ensure the image doesn't exceed its container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            border: 1px solid #ddd;
            border-bottom: 1px double #000;
            background-color: #f2f2f2;
        }

        .key {
            font-weight: bold;
            color: #333;
        }

        .key-value-pair {
            margin-bottom: 10px;
        }

        body {
            border: 1px solid #000;
            /* Set the border style, adjust color and width as needed */
            padding: 20px;
            /* Optional: Add padding to give some space between the content and the border */
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="https://media.istockphoto.com/id/490736905/photo/meenakshi-hindu-temple-in-madurai-tamil-nadu-south-india.jpg?s=612x612&w=0&k=20&c=OlOLvdryIdkdyKcY9gRPsM1RZa5HiP6QBr2JVAIvPb0=" alt="Header Image" />

    </div>
    <!-- Your PDF content here -->
    <h1>Title</h1>
    <h2>Day Book Report Date- {{$data['daybook']['date']}}</h2>

    <div class="key-value-pair">
        <span class="key">Opening Balance:</span>
        <span class="value">{{ number_format($data['daybook']['opening_balance'],2) }}</span>
    </div>
    <div class="key-value-pair">
        <span class="key">Closing Balance:</span>
        <span class="value">{{number_format($data['daybook']['closing_balance'],2) }}</span>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Pariculars</th>
                <th>Credit</th>
                <th>Debit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['vouchers'] as $key=> $voucher)
            <tr>
                <td>{{$voucher['date']}}</td>
                <td>{{$voucher['narration']}}</td>
                @if($voucher['transaction_type'] == "credit")
                <td>{{number_format($voucher['amount'],2)}}</td>
                @else
                <td>---</td>
                @endif

                @if($voucher['transaction_type'] == "debit")
                <td>{{number_format($voucher['amount'],2)}}</td>
                @else
                <td>---</td>
                @endif
            </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
    </table>

</body>

</html>