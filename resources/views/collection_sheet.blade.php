<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 15px;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0 5px;
            border: 1px solid #000;
        }

        .container {
            width: 100%;
            /* padding: 20px; */
            box-sizing: border-box;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
        }

        .image-column {
            width: 30%;
            vertical-align: top;
        }

        .image-column img {
            width: 100%;
            height: auto;
        }

        .text-column {
            /* vertical-align: top; */
            margin-top: 0;
            text-align: center;

            /* padding-left: 20px; */
        }

        .key-value-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
            padding-top: 0;
        }

        .inner-table {
            font-size: 13px;
            margin-top: 0;
            padding-top: 0;
            width: 100%;
            border-collapse: collapse;
        }

        .key-value-table td {
            margin-top: 0;
            padding: 10px;
            vertical-align: top;
        }

        .inner-table td {
            padding: 5px 10px;
        }

        .pdf-title {
            margin-top: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-bottom: 0;
            font-size: 24px;
        }

        .collection-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            /* Collapse borders */
        }

        .collection-table>thead>tr>th {
            font-size: 11px;
            padding: 5px 5px;
            border: 1px solid #000;
        }

        .collection-table>tbody>tr>td {
            font-size: 11px;
            /* padding: 5px 5px; */
            text-align: center;
            border: 1px solid #000;
        }
    </style>
</head>

<body>

    <div class="container">
        <table class="main-table">
            <tr>
                <td class="image-column">
                    <img src="https://media.istockphoto.com/id/490736905/photo/meenakshi-hindu-temple-in-madurai-tamil-nadu-south-india.jpg?s=612x612&w=0&k=20&c=OlOLvdryIdkdyKcY9gRPsM1RZa5HiP6QBr2JVAIvPb0=" alt="Header Image" />

                </td>
                <td class="text-column">
                    <h1 class="pdf-title">Thulir Finance</h1>
                    <table class="key-value-table">
                        <tr>
                            <td>
                                <table class="inner-table">
                                    <tr>
                                        <td><strong>Center</strong></td>
                                        <td>00{{$data['center']->id}}-{{$data['center']->center_name}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Staff</strong></td>
                                        <td>00{{$data['employee']->id}}-{{$data['employee']->staff_name}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Meeting Day</strong></td>
                                        <td>{{$data['center']->meeting_day}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="inner-table">
                                    <tr>
                                        <td><strong>Meeting Date</strong></td>
                                        <td>{{$data['center']->meeting_date}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Meeting Time</strong></td>
                                        <td>{{$data['center']->meeting_time}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>

        <table class="collection-table">
            <thead>
                <tr>
                    <th>Member Id</th>
                    <th>Member Name</th>
                    <th>Dis. Date</th>
                    <th>Loan Amount</th>
                    <th>Loan O/S</th>
                    <th colspan="2">Dues</th>
                    <th>Opening Arr</th>
                    <th>Current Due Amount</th>
                    <th>Total Amount</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Cur</th>
                    <th>Coll</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['collections'] as $collection)
                <tr>
                    <td> {{$collection['member']->id }} </td>
                    <td> {{$collection['member']->client_name }} </td>
                    <td> {{$collection['loan']->dis_date }} </td>
                    <td> {{$collection['loan']->loan_amount }} </td>
                    <td> {{$collection['loan']->outstanding_amount }} </td>
                    <td> {{$collection->due_number }} </td>
                    <td> {{$collection->paid_due }} </td>

                    <td> {{$collection->balance_amount }} </td>
                    <td> {{$collection->collection_amount }} </td>
                    <td> {{$collection->total_amount }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</body>

</html>
