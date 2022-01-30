<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>PDF</title>
    <style>
        body {
            margin: 10%;
            font-size: 1em;
        }

        table.table {
            width: 100%;
            background-color: #ffffff;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #d4d3d3;
            border-style: solid;
            color: black;
        }

        table.table td, table.table th {
            border-width: 1px;
            border-color: #d4d3d3;
            border-style: solid;
            padding: 1%;
        }

        table.table thead {
            background-color: #1c1c1c;
            color: white;
        }

        /*no border*/
        table.noborder {
            width: 100%;
            background-color: #ffffff;
            border-collapse: collapse;
            border-width: 0px;
            border-color: #ffffff;
            border-style: solid;
            color: #000000;
        }

        table.noborder td {
            border-width: 0px;
            border-color: #ffffff;
            border-style: solid;
            padding: 3px;
        }

        table.noborder th {
            padding: 0 0 2% 0;
        }

        table.noborder thead {
            background-color: #ffffff;
        }

        /*no last*/
        table.last {
            width: 100%;
            background-color: #ffffff;
            border-collapse: collapse;
            border-width: 0px;
            /*border-color: #ffffff;*/
            border-style: solid;
            color: #000000;
        }

        .black {
            background: #1c1c1c;
            color: white;
            height: 20px;
            width: 20px;

        }

        table.last thead {
            background-color: white;
        }

        table.last last-child {
            border: 1px solid black;
            padding: 1% 5px 1% 0;
        }

        .inwords {
            border-width: 1px;
            border-color: #d4d3d3;
            border-style: solid;
            padding: 1% 5px 1% 0;
        "
        }

        .align-right {
            text-align: right
        }

        .align-left {
            text-align: left;
        }

        .align-center {
            text-align: center;
        }

        .pb-5 {
            padding: 0 0 1% 0;
        }

        .mb-2 {
            margin: 0 0 2% 0;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
<table class="noborder mb-2">

    <thead>
    <tr class="align-center">
        <th class="pb-5" colspan="3"> Pay slip <br> Payment slip for the month of December 2021</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>Working Branch : <span>Paarth </span></td>
    </tr>
    <tr>
        <td>EMP Code <span> 2132 (December 2021 ) </span></td>
        <td>EMP Name <span>VINOD VINOD</span></td>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>PF No.<span>Nil</span></td>
        <td>Mode of Pay <span>Nil</span></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Designation <span>Paarth (SKILLED)</span></td>
        <td>UAN. <span>Nil</span></td>
        <td>&nbsp;</td>
    </tr>
    </tbody>
</table>
<table class="table align-left pb-5">

    <thead>
    <tr class="black">
        <th>Earnings</th>
        <th>Amount</th>
        <th>Deductions</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="bold">Basic</td>
        <td>₹0.00</td>
        <td>₹0.00</td>
        <td>₹0.00</td>

    </tr>
    <tr>
        <td class="bold">HRA</td>
        <td>₹0.00</td>
        <td>₹0.00</td>
        <td>₹0.00</td>
    </tr>
    <tr>
        <td class="bold">Total Earning</td>
        <td>₹0.00</td>
        <td>Total Deductions</td>
        <td>₹0.00</td>
    </tr>
    <!--    <tr>-->
    <!--      <th>&nbsp;</th>-->
    <!--        <td colspan="3">In Words ZERO</td>-->
    <!--    </tr>-->
    </tbody>
</table>
<table class="last">

    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td class="bold">Net Pay : ₹0.00</td>
        <td class="inwords" colspan="3">In Words ZERO</td>
    </tr>
    <tr class="align-right">
        <td>&nbsp;</td>
        <td colspan="3">For Paarth Clothing Pvt. Ltd
        </td>
    </tr>
    <tr class="align-right">
        <td>&nbsp;</td>
        <td colspan="3">Authorised Signatory
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
