@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu')

@section('container')
        <!-- START CONTENT -->
<div class="content">

    <header id="topbar" class="alt">
        <div class="topbar-left">
            <ol class="breadcrumb">
                <li class="breadcrumb-icon">
                    <a href="/dashboard">
                        <span class="fa fa-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-active">
                    <a href="/dashboard"> Dashboard </a>
                </li>
                <li class="breadcrumb-link">
                    <a href=""> Leave </a>
                </li>
                <li class="breadcrumb-current-item"> Apply Leave</li>
            </ol>
        </div>
    </header>
    <!-- -------------- Content -------------- -->
    <form>
        <div class="form-group">
            <label class="col-md-2 control-label"> Leave Type </label>
            <div class="col-md-10">
                <input type="hidden" value="{!! csrf_token() !!}" id="token">
                <input type="hidden" value="{{\Auth::user()->id}}" id="user_id">
                <select class="select2-multiple form-control select-primary leave_type"
                        name="leave_type" required>
                    <option value="" selected>Select One</option>
                    @foreach($leaves as $leave)
                        <option value="{{$leave->id}}">{{$leave->leave_type}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Date From</label>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-append">
                        <i class="fa fa-calender pr-10"></i>
                    </div>
                    <input class="date form-control" type="text">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script type="text/javascript">
        $('.date').datepicker({
            format: 'mm-dd-yyyy'
        });
    </script>

</div>
@endsection
