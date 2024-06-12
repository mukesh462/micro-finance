<!DOCTYPE html>
<html>

<head>
    <style>
     @page {
            margin: 10px; /* Adjust the margin as needed */
            padding:15px;
            
        }
       
        .header {
            /* text-align: center; */
            position: relative;
            padding-bottom: 20px;
            margin-bottom: 10px;
        }

        .header img {
            height: 100px;
            float: left;
            /* position: relative; */
            max-width: 100%;
            border-radius: 0.25em;
            /* Ensure the image doesn't exceed its container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 70px;
        }

        th,
        td {
            /* border: 1px solid #000; */
            padding: 8px;
            text-align: left;
            font-size:15px
        }

        th {
            /* border: 1px double #000; */
            border-top: 2px solid #000;
            padding: 10px;
            border-bottom: 3px double #000;
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
        
            
            /* Set the border style, adjust color and width as needed */
        
            /* Optional: Add padding to give some space between the content and the border */
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .sub-total1 {
            padding: 10px;
            border-top: 3px double #000;
            border-bottom: 3px double #000;
        }

        .sub-total {
            padding: 10px;
            border-bottom: 3px double #000;
        }

        .bold-text {
            font-weight: bold;
            text-align: right;
            padding-right: 20px;
        }

        .reason {
            text-transform: uppercase;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .opening {
            text-transform: uppercase;
            font-size: 15px;
        }
        .title-description{
            text-align:center
        }
        
    </style>
</head>

<body>
    <div class="header">
        <img src="https://media.istockphoto.com/id/490736905/photo/meenakshi-hindu-temple-in-madurai-tamil-nadu-south-india.jpg?s=612x612&w=0&k=20&c=OlOLvdryIdkdyKcY9gRPsM1RZa5HiP6QBr2JVAIvPb0="
            alt="Header Image" />
        <div class="title-description">
            <h1>Thulir Finance</h1>

        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>S.no</th>
                <th>Center</th>
                 <th>Member ID</th>
                <th>Member</th>
                <th>Nominee </th>
                <th>Product</th>
                <th>Purpose</th>
                <th>Loan Amount</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $ke => $list)
            <tr>
                <td>{{ $ke + 1 }}</td>
                <td>{{ $list->center_name }}</td>
                <td>#{{ $list->member_id }}</td>
                <td>{{ $list->member_name }}</td>
                <td>{{ $list->nominee_name }}</td>
                <td>{{ $list->product_name }}</td>
                <td>{{ $list->purpose }}</td>
                <td>{{ $list->amount }}</td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th colspan="6"></th>
            
                <th  colspan="">Total</th>
                <th>{{collect($data)->sum('amount')}}</th>
            </tr>
        </tfoot>
    </table>

</body>

</html>