@extends('layout.conquer2')

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Dashboard <small>statistics and more</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Dashboard</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height btn-primary" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
            </div>
        </div>

    <!-- END PAGE HEADER-->
</div>


<div class="container">

    <div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								{{$hotel->name}}
							</div>
							<div class="actions">
								<a href="#" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
								<a href="#" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="overflow: hidden; width: auto; height: 200px;" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                            {{$hotel->address}}, {{$hotel->city}} <br>
                            <img src={{ asset('image/'.$hotel->image)}} height='200px' />
                            <br/>
                           
							</div><div class="slimScrollBar" style="background: rgb(161, 178, 189); width: 7px; position: absolute; border-radius: 7px; z-index: 99; right: 1px; top: 73px; opacity: 0.4; height: 200px; display: none;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; border-radius: 7px; background: yellow; z-index: 90; right: 1px; display: block; opacity: 0.2;"></div></div>
						</div>
					</div>

</div>
@endsection