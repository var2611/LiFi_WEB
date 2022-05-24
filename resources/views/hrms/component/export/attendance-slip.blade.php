<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
@php
    use \Carbon\Traits\Date;
    use App\Models\Company;


        /* @var $data_attendance_slip */
        /* @var $companyData Company */
        /* @var $daysInMonth int*/
        /* @var $sundays Date[]*/
        /* @var $holidays Date[]*/
        /* @var $monthName Date[]*/
        /* @var $month Date[]*/
        /* @var $year Date[]*/

@endphp
<html lang="en">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salary Punching</title>
    <style type="text/css">
        .page-break {
            page-break-after: always;
        }

        body {
            margin: 2em;
        }

        table {
            /*font-size: 12px;*/
            width: 100%;
            border-collapse: inherit;
            text-align: center;
            table-layout: fixed;
        }

        thead {
            border-bottom-width: 2px;
        }

        div p {
            width: 100%;
            display: flex;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        table {
            border: 1px solid black;
            margin-left: auto;
            margin-right: auto;
        }

        tbody {
            min-width: 100%;
        }

    </style>
</head>
<body>
<div style="font-weight: bold;font-size: 1.5em;">
    <p>{{ strtoupper($companyData->name) }}</p>
</div>
<div>
    <p>Time Sheet For Month : {{ $monthName.'-'.$year }}</p>
</div>

<div>
    <table>
        <thead>
        <tr>
            <th style="width:5%"></th>
            @for($i = 1; $i <= $daysInMonth; $i++)

                <th>{{ $i }}</th>

            @endfor
        </tr>
        </thead>
    </table>
</div>

@for($j = 1; $j <= sizeof($data_attendance_slip); $j++)
    @php

        $empCode = $data_attendance_slip[$j-1]['UserEmployee']['emp_code'];
        $empName = $data_attendance_slip[$j-1]['name'];

    @endphp
    <div>
        <table>
            <tbody>
            <tr>
                <td style="width:6%;">{{ $empCode }}</td>
                <td style="text-align: center;" colspan="4">{{ $empName }}</td>
                <td style="text-align: right;" colspan="5">Shift :</td>
                <td style="text-align: center;" colspan="0">GEN</td>
                <td style="text-align: right;" colspan="5">Present Days :</td>
                <td style="text-align: center;" colspan="1">24</td>
                <td style="text-align: center" colspan="15"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table>
            <tbody>
            <tr>
                <!-- 5 -->
                <td rowspan="6" style="width:5%;line-height: 2em;border-right: 1px solid">
                    <div>&nbsp;</div>
                    <div>In</div>
                    <div>out</div>
                    <div>Duration</div>
                    <div>Early by</div>
                    <div>Late by</div>
                    <div>OT</div>
                </td>

                @for($i = 1; $i <= $daysInMonth; $i++)

                    @php

                        $weekOff = null;
                        $inTime = 'AB';
                        $outTime = '-';
                        $duration = 00.00;
                        if (in_array($i, $sundays)){
                            $weekOff = 'WO';
                            $inTime = '-';
                        }
                        $attendanceDetails = json_decode($data_attendance_slip[$j-1]['att_' . $i]);
                        if (isset($attendanceDetails)){
                            $inTime = $attendanceDetails[0] ?? '';
                            $outTime = $attendanceDetails[1] ?? ' ';

                            if (isset($inTime)){
                                $inTime = getDateTimeFromStringAsFormat(getDBDateAndTimeFormat(), getDBTimeFormat(), $inTime);
                            }

                            if (isset($outTime)){
                                $outTime = getDateTimeFromStringAsFormat(getDBDateAndTimeFormat(), getDBTimeFormat(), $outTime);
                            }

                            $duration = number_format($attendanceDetails[2],2);
                        }
                    @endphp

                    <td rowspan="6"
                        style="line-height: 2em;@if($i != $daysInMonth)border-right: 1px solid; @endif">
                        <div>&nbsp;{{ $weekOff ?? '' }}</div>
                        <div>{{ $inTime }}</div>
                        <div>{{ $outTime }}</div>
                        <div>{{ $duration }}</div>
                        <div>&nbsp;</div>
                        <div>00:00</div>
                        <div>&nbsp;</div>
                    </td>
            @endfor
            </tbody>
        </table>
    </div>

    @if(($j%3) == 0)
        <div class="page-break"></div>
    @endif
@endfor


</body>
</html>
