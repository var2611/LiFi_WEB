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
        tbody:before, tbody:after {
            display: none;
        }

        body {
            margin: 2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            table-layout: fixed;
        }

        thead {
            border-bottom-width: 2px;
        }

        div p {
            width: 100%;
            display: flex;
            text-align: center;
        }

        table {
            border: 1px solid black;
            border-bottom: none;
            margin-left: auto;
            margin-right: auto;
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
            <th></th>
            @for($i = 1; $i <= $daysInMonth; $i++)

                <th>{{ $i }}</th>

            @endfor
        </tr>
        </thead>
        @for($j = 0; $j < sizeof($data_attendance_slip); $j++)
            @php

                $empCode = $data_attendance_slip[$j]['UserEmployee']['emp_code'];
                $empName = $data_attendance_slip[$j]['name'];

            @endphp
            <tbody>
            <tr>
                <td style="border-top: 1px solid;">{{ $empCode }}</td>
                <td style="text-align: center; border-top: 1px solid;" colspan="4">{{ $empName }}</td>
                <td style="text-align: right; border-top: 1px solid;" colspan="5">Shift :</td>
                <td style="text-align: center; border-top: 1px solid;" colspan="0">GEN</td>
                <td style="text-align: right;border-top: 1px solid; " colspan="5">Present Days :</td>
                <td style="text-align: center;border-top: 1px solid;" colspan="1">24</td>
                <td style="text-align: center;border-top: 1px solid;" colspan="15"></td>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <!-- 5 -->
                <td rowspan="6"
                    style="border-top: 1px dashed;border-bottom: 1px dashed;line-height: 2em;border-right: 1px solid;">
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
                        $attendanceDetails = json_decode($data_attendance_slip[0]['att_' . $i]);
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
                        style="border-top: 1px dashed;border-bottom: 1px dashed;line-height: 2em; @if($i != $daysInMonth)border-right: 1px solid; @endif">
                        <div>&nbsp;{{ $weekOff ?? '' }}</div>
                        <div>&nbsp;{{ $inTime }}&nbsp;</div>
                        <div>&nbsp;{{ $outTime }}&nbsp;</div>
                        <div>&nbsp;{{ $duration }}&nbsp;</div>
                        <div> &nbsp;</div>
                        <div> 00:00</div>
                        <div> &nbsp;</div>
                    </td>

            @endfor
            </tbody>
        @endfor

    </table>
</div>
</body>
</html>
