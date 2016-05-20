<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo $page_title; ?></title>
	
	<base href="<?php echo base_url() ?>admin">
	
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/neon-core.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/neon-theme.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/neon-forms.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/custom.css">
	
	<script src="<?php echo base_url() ?>assets/admin/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/toastr.js" id="script-resource-8"></script>
	
	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
    <style type="text/css">
	ul.ul_form_fields {
		width: 100%;
		padding: 20px 0 0;
		}
	.datatable {
		opacity:0;
		}
	ul.ul_form_fields .clearfix {
		height: 10px;
		float: left;
		width: 100%;
		}
	.datatable{
		table-layout: fixed;
		}
	th.sn{
		width: 50px !important;
		}
	th.display_order{
	   width: 70px !important; 
		}
	th.action{
		width: 100px !important;
		}
	td.action a {
		margin-right:5px;
		}
	td.action a:last-child {
		margin: 0;
		}
	th.status {
		width: 70px !important;
		}
	input.status {
		background-color: rgba(0, 0, 0, 0);
		background-position: center center;
		background-repeat: no-repeat;
		border: medium none;
		color: rgba(0, 0, 0, 0);
		cursor: pointer;
		font-size: 0;
		height: 14px;
		width: 20px;
		}
	.nopadding{
		padding: 0;
		}
	.nopadding-left{
		padding-left: 0;
		}
	.nopadding-right {
		padding-right: 0;
		}
	.tree,
	.tree li {
		float: left;
		height: auto;
		width: 100%;
		list-style: none;
		padding: 0;
		margin: 0;
		}
	.tree li a.user_class,
	.tree li label {
		cursor: pointer;
		}
	.tree li a.user_class {
		float: left;
		height: 20px;
		width: 100%;
		}
	.tree li label {
		position:relative;
		top:-1px;
		padding-left:5px;
		}
	.tree li a input {
		margin: 0;
		}
	.tree li ul {
		margin-left:23px;
		}
	.tree li ul li ul {
		margin-left: 23px;
		}
	.width-200 {
		width:120px !important;
		}
		p.text-info{
			padding: 8px 0px 0px 0px;
			font-style: italic;
			color: #949494;
			margin-bottom:0px;
		}
		.control-label{
		font-weight:bold;
		
		}
		.div-image{
			float:left;
			height:auto;
			width:auto;
		}
		.div-image a.entypo-close{
			position:absolute;
			margin-left:1px;
			margin-top:1px;
			padding:4px;
			background-color:#FFFFFF;
			color:#F00;
			font-size:16px;
		}
		.div-image a.entypo-close:hover{
			position:absolute;
			margin-right:1px;
			margin-top:1px;
			padding:4px;
			background-color:#FF8000;
		}
		.loading{
			-webkit-transition: all 0.6s ease-in-out;
  -moz-transition: all 0.6s ease-in-out;
  -o-transition: all 0.6s ease-in-out;
  transition: all 0.6s ease-in-out;
			opacity:0;
			-webkit-transform: scale(0.9);
			-moz-transform: scale(0.9);
			-o-transform: scale(0.9);
			transform: scale(0.9);
			-webkit-transform-origin: center center;
			-moz-transform-origin: center center;
			-o-transform-origin: center center;
			transform-origin: center center;
			background-color:#303641;
		}
		.loaded{
			opacity:1;
			-webkit-transform: scale(1);
			-moz-transform: scale(1);
			-o-transform: scale(1);
			transform: scale(1);
			-webkit-transform-origin: center center;
			-moz-transform-origin: center center;
			-o-transform-origin: center center;
			transform-origin: center center;
		}
			
	</style>
</head>
<script type="text/javascript">
var responsiveHelper;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};
var tableContainer;
jQuery(window).load(function() {
	var $ = jQuery;
	tableContainer=$(".datatable");
	tableContainer.dataTable({
		"sPaginationType"	: "bootstrap",
		"aLengthMenu"		: [[25, 50, -1], [25, 50, "All"]],
		"bStateSave"		: true,
		"iDisplayLength"	: 25,
		bAutoWidth     		: false,
		"bSort": false,
		fnPreDrawCallback	: function () {
			if (!responsiveHelper) {
				responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
			}
		},
		fnRowCallback  		: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			responsiveHelper.createExpandIcon(nRow);
		},
		fnDrawCallback 		: function (oSettings) {
			responsiveHelper.respond();
		}
	});
	$(".datatable").css('opacity','1');
	$(".dataTables_wrapper select").select2({
		minimumResultsForSearch: -1
	});
	
	// Highlighted rows
	
	
	// Replace Checboxes
	$(".pagination a").click(function(ev) {
		replaceCheckboxes();
	});
	$("body").on("click",".div-image a.entypo-close",function(){
		$(this).closest(".div-image").remove();
		$("#previous_image").val('');
	});

	var time=setTimeout(function(){
		$(".alert").fadeOut(1800); 
		clearTimeout(time);
	},2800);
});
</script>
<body class="page-body loading">