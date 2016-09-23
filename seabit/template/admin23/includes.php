<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/font.css">
		<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800">-->
        <link href="<?php echo TEMPLATE_URL; ?>css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo TEMPLATE_URL; ?>css/jasny-bootstrap.css" media="screen" rel="stylesheet" type="text/css" />

        <link href="<?php echo TEMPLATE_URL; ?>css/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo TEMPLATE_URL; ?>css/datepicker.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo TEMPLATE_URL; ?>admin/css/style.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo TEMPLATE_URL; ?>admin/css/custom.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo TEMPLATE_URL; ?>admin/css/theme-color.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo TEMPLATE_URL; ?>css/chosen.css" media="screen" rel="stylesheet" type="text/css" />

        <script src="<?php echo TEMPLATE_URL; ?>js/jquery-1.11.1.min.js" type="text/javascript"></script> 
		<!--[if lt IE 9]>
        <script src="<?php echo TEMPLATE_URL; ?>js/html5shiv.js" type="text/javascript"></script>
        <script src="<?php echo TEMPLATE_URL; ?>js/excanvas.js" type="text/javascript"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/bootstrap-datepicker.js"></script>   
        
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.knob.js"></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.iframe-transport.js"></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.fileupload.js"></script>

        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/script.js" ></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/chosen.jquery.js" ></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/timer.jquery.js" ></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jasny-bootstrap.min.js" ></script>
        <script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/custom.js" ></script>
        <?php
		
		//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
		
		$system_name = "Seabit Payroll";
		$system_title = "Seabit Title";

	//	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	//	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;