<?php 
$expanded = 'false';
$class = 'collapse';
if ( isset ( $page_parent ) ) {
	if ( $page_parent = 'logodesign' ) {
		$expanded = 'true';
		$class = 'collapse in';
	}
}

$expanded = 'true';
$class = 'collapse in';

?>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
	<ul class="nav navbar-nav side-nav">
		<li class="sidebar-toggler-wrapper">
			<div class="sidebar-toggler"></div>
		</li>
		<li class="first" >
			<a href="<?php echo base_url(); ?>admin/dashboard/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
		</li>
		<li>
			<a href="javascript:;" data-toggle="collapse" data-target="#settings" class="collapsed" aria-expanded="<?php echo $expanded; ?>"><i class="fa fa-fw fa-cogs"></i> Settings <i class="fa fa-fw fa-caret-down"></i></a>
			<ul id="settings" class="<?php echo $class; ?> sub-menu" aria-expanded="<?php echo $expanded; ?>" >
				<li><a href="<?php echo base_url(); ?>admin/website_setup/">Website Setup</a></li>
			</ul>
		</li>

		<li class="active">
			<a href="<?php echo base_url(); ?>admin/emaildata/"><i class="fa fa-fw fa-flickr"></i>Email Data</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>admin/user_password/"><i class="fa fa-fw fa-key"></i> Change Password</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>logout/"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
		</li>
	</ul>
</div>
<!-- /.navbar-collapse -->
