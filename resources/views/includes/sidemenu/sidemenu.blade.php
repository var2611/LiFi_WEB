@extends((Auth::user()->isHR() || Auth::user()->isAdmin()) ? 'includes.sidemenu.hrms-menu' : ((Auth::user()->isArmy()) ? 'includes.sidemenu.army-menu' : 'includes.sidemenu.hrms-menu'))
{{--@extends((Auth::user()->isArmy()) ?? 'includes.sidemenu.army-menu')--}}
