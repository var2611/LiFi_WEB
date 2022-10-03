@if(Auth::user()->isHR() || Auth::user()->isAdmin())
    @extends('includes.sidemenu.hrms-menu')
@endif
@if(Auth::user()->isArmy())
    @extends('includes.sidemenu.army-menu')
@endif
