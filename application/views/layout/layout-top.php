<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Ticketing iDocs - Metro TV </title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Page level plugin CSS-->
	<link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<!-- SweetAlert-->
	<link href="<?php echo base_url(); ?>assets/vendor/sweetalert/sweetalert.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="<?=base_url("assets/adminlte/bower_components/select2/dist/css/select2.min.css")?>" />
	<!-- Custom styles for this template-->
	<link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">

</head>

<body id="page-top">

	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

		<a class="navbar-brand mr-1" href="<?php echo base_url() ?>">Ticketing</a>

		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>

		<!-- Navbar Search -->
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

		</form>

		<ul class="navbar-nav ml-auto ml-md-0">
			<li class="nav-item dropdown no-arrow mx-1">
				<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle fa-fw"></i> <?=$log_name?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
					<a class="dropdown-item" href="<?=base_url('site/signout')?>" title="">LOGOUT</a>
				</div>
			</li>

		</ul>

	</nav>

	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="sidebar navbar-nav">
			<li class="nav-item"> <br/>
				<a class="nav-link" title="" data-toggle="modal" data-target="#default-modal">
					<i class="fas fa-ticket-alt"></i>
					<span> Open New Ticket </span>
				</a>
			</li>
			<li class="nav-item <?= ($header == 'inbound' ? 'active' : '')?>">
				<a class="nav-link notification" href="<?php echo base_url() ?>inbound">
					<i class="fas fa-download"></i>
					<span>
						Inbound
					</span>
				</a>
			</li>
			<?php 
			if (isset($is_superadmin) and $is_superadmin == true) {
				?>
				<li class="nav-item <?= ($header == 'inboundAll' ? 'active' : '')?>">
					<a class="nav-link notification" href="<?php echo base_url() ?>inbound/inbound_all">
						<i class="fas fa-download"></i>
						<span>
							Inbound All
						</span>
					</a>
				</li>
				<?php 
			}
			?>
			<li class="nav-item <?= ($header == 'outbound' ? 'active' : '')?>">
				<a class="nav-link notification" href="<?php echo base_url() ?>outbound">
					<i class="fas fa-upload"></i>
					<span>
						Outbound
					</span>
				</a>
			</li>
			<?php 
			if (isset($is_admin) and $is_admin == true) {
				?>
				<li class="nav-item <?= ($header == 'approval' ? 'active' : '')?>">
					<a class="nav-link" href="<?php echo base_url() ?>inbound/approval"><i class="fas fa-fw fa-check"></i>
						<span>Approval</span>
					</a>
				</li>
				<?php 
			}
			?>
			<li class="nav-item <?= ($header == 'history_inbound' ? 'active' : '')?>">
				<a class="nav-link" href="<?php echo base_url() ?>inbound/history_inbound">
					<i class="fas fa-fw fa-table"></i>
					<span>History Inbound</span>
				</a>
			</li>
			<li class="nav-item <?= ($header == 'history_outbound' ? 'active' : '')?>">
				<a class="nav-link" href="<?php echo base_url() ?>outbound/history_outbound">
					<i class="fas fa-fw fa-table"></i>
					<span>History Outbound</span>
				</a>
			</li>
			<?php 
			if (isset($is_superadmin) and $is_superadmin == true) {
				?>
				<li class="nav-item <?= ($header == 'user_access' ? 'active' : '')?>">
					<a class="nav-link" href="<?php echo base_url() ?>uac">
						<i class="fas fa-fw fa-table"></i>
						<span>User Access</span>
					</a>
				</li>
				<?php 
			}
			?>
		</ul>
		<div id="content-wrapper">

			<div class="container-fluid">

				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">iDocs</a>
					</li>
					<li class="breadcrumb-item active">Ticketing</li>
					<li class="breadcrumb-item active"><?=$breadcumb?></li>
				</ol>