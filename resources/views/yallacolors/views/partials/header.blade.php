<!-- begin #header -->
<div id="header" class="header navbar navbar-fixed-top navbar-inverse">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
			<a href="{{ website()->adminUrl() }}" class="navbar-brand">
				<span class="navbar-logo"></span>
				{{ trans('core::adminMain.control') }}
			</a>
			<ul class="navbar-nav p-0">
				@include('core::admin.partials.navBar.languagesMenu')
			</ul>
			<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>
		<!-- end mobile sidebar expand / collapse button -->
		<div class="row header-box">
			@include('core::admin.partials.navBar.search')
			<div class="col-xs-12 col-sm-6 user-box">
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					@include('core::admin.partials.navBar.viewWebsite')
					{{--@include('core::admin.partials.navBar.notifications')--}}
					@include('core::admin.partials.navBar.languagesMenu')
					@include('core::admin.partials.navBar.userMenu')
				</ul>
				<!-- end header navigation right -->
			</div>
		</div>
	</div>
	<!-- end container-fluid -->
</div><!-- end #header -->
