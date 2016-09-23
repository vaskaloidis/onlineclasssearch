<div class="sidebar-background">
	<div class="primary-sidebar-background">
	</div>
</div>
<div class="primary-sidebar">
	<!-- Main nav -->
    <br />
    <div style="text-align:center;">

        <a href="<?php echo base_url();?>">
        	<img src="<?php echo base_url();?>uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
        </a>

    </div>
   	<br />
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------dashboard----->
		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>dashboard" rel="tooltip" data-placement="right" 
                	data-original-title="<?php _e('dashboard_help');?>">
					<!--<i class="icon-desktop icon-1x"></i>-->
                    <img src="<?php echo TEMPLATE_URL; ?>images/icons/dashboard.png" />
					<span><?php _e('dashboard');?></span>
				</a>
		</li>
        
		<li class="<?php if($page_name == 'project')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>project" rel="tooltip" data-placement="right" 
                	data-original-title="<?php _e('Project Help');?>">
					<!--<i class="icon-desktop icon-1x"></i>-->
                    <img src="<?php echo TEMPLATE_URL; ?>images/icons/group.png" />
					<span><?php _e('Project');?></span>
				</a>
		</li>

		<li class="dark-nav <?php if(	$page_name == 'group' 		|| 
										$page_name == 'client'  		)echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#clients_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php _e('bed_ward_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo TEMPLATE_URL; ?>images/icons/client.png" />
                <span><?php _e('clients');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="clients_submenu" class="collapse <?php if(	$page_name == 'group' 		|| 
																$page_name == 'client' 			)echo 'in';?>">
                <li class="<?php if($page_name == 'group')echo 'dark-nav active';?>">
                        <a href="<?php echo base_url();?>group" rel="tooltip" data-placement="right" 
                            data-original-title="<?php _e('group_details');?>">
                            <!--<i class="icon-user icon-1x"></i>-->
                            <img src="<?php echo TEMPLATE_URL; ?>images/icons/group.png" />
                            <span><?php _e('group');?></span>
                        </a>
                </li>
                <li class="<?php if($page_name == 'client')echo 'dark-nav active';?>">
                        <a href="<?php echo base_url();?>client" rel="tooltip" data-placement="right" 
                            data-original-title="<?php _e('client_details');?>">
                            <!--<i class="icon-user icon-1x"></i>-->
                            <img src="<?php echo TEMPLATE_URL; ?>images/icons/client.png" />
                            <span><?php _e('all_clients');?></span>
                        </a>
                </li>
            </ul>
		</li>

		<li class="dark-nav <?php if(	$page_name == 'type' 		|| 
										$page_name == 'category' 	||
										$page_name == 'product' 			)echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#products_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php _e('bed_ward_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo TEMPLATE_URL; ?>images/icons/product.png" />
                <span><?php _e('products');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="products_submenu" class="collapse <?php if(	$page_name == 'type' 		|| 
																$page_name == 'category' 	||
																$page_name == 'product' 		)echo 'in';?>">
                <li class="<?php if($page_name == 'category')echo 'dark-nav active';?>">
                        <a href="<?php echo base_url();?>index.php?admin/category" rel="tooltip" data-placement="right" 
                            data-original-title="<?php _e('category_details');?>">
                            <!--<i class="icon-user icon-1x"></i>-->
                            <img src="<?php echo TEMPLATE_URL; ?>images/icons/category.png" />
                            <span><?php _e('category');?></span>
                        </a>
                </li>
                <li class="<?php if($page_name == 'type')echo 'dark-nav active';?>">
                        <a href="<?php echo base_url();?>index.php?admin/type" rel="tooltip" data-placement="right" 
                            data-original-title="<?php _e('type_details');?>">
                            <!--<i class="icon-user icon-1x"></i>-->
                            <img src="<?php echo TEMPLATE_URL; ?>images/icons/type.png" />
                            <span><?php _e('type');?></span>
                        </a>
                </li>
                <li class="<?php if($page_name == 'product')echo 'dark-nav active';?>">
                        <a href="<?php echo base_url();?>index.php?admin/product" rel="tooltip" data-placement="right" 
                            data-original-title="<?php _e('product_details');?>">
                            <!--<i class="icon-user icon-1x"></i>-->
                            <img src="<?php echo TEMPLATE_URL; ?>images/icons/product.png" />
                            <span><?php _e('product');?></span>
                        </a>
                </li>
            </ul>
		</li>
        <li class="<?php if($page_name == 'user')echo 'dark-nav active';?>">
                <a href="<?php echo base_url();?>users" rel="tooltip" data-placement="right" 
                    data-original-title="<?php _e('Users');?>">
                    <!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo TEMPLATE_URL; ?>images/icons/client.png" />
                    <span><?php _e('Users');?></span>
                </a>
        </li>
                
		<li class="dark-nav <?php if(	$page_name == 'order' 		|| 
										$page_name == 'invoice'  		)echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#orders_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php _e('bed_ward_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo TEMPLATE_URL; ?>images/icons/order.png" />
                <span><?php _e('orders');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="orders_submenu" class="collapse <?php if(	$page_name == 'order' 		|| 
																$page_name == 'invoice' 		)echo 'in';?>">
                <li class="<?php if($page_name == 'order')echo 'dark-nav active';?>">
                        <a href="<?php echo base_url();?>index.php?admin/order" rel="tooltip" data-placement="right" 
                            data-original-title="<?php _e('order_details');?>">
                            <!--<i class="icon-user icon-1x"></i>-->
                            <img src="<?php echo TEMPLATE_URL; ?>images/icons/invoice.png" />
                            <span><?php _e('all_orders');?></span>
                        </a>
                </li>
                <li class="<?php if($page_name == 'invoice')echo 'dark-nav active';?>">
                        <a href="<?php echo base_url();?>index.php?admin/invoice" rel="tooltip" data-placement="right" 
                            data-original-title="<?php _e('invoice_details');?>">
                            <!--<i class="icon-user icon-1x"></i>-->
                            <img src="<?php echo TEMPLATE_URL; ?>images/icons/order.png" />
                            <span><?php _e('all_invoices');?></span>
                        </a>
                </li>
            </ul>
		</li>

		<!------transaction----->
		<li class="<?php if($page_name == 'transaction')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/transaction" rel="tooltip" data-placement="right" 
					data-original-title="<?php _e('transaction_details');?>">
					<!--<i class="icon-user icon-1x"></i>-->
					<img src="<?php echo TEMPLATE_URL; ?>images/icons/transaction.png" />
					<span><?php _e('transaction');?></span>
				</a>
		</li>

		<!------message----->
		<li class="<?php if($page_name == 'message')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/message" rel="tooltip" data-placement="right" 
					data-original-title="<?php _e('message_details');?>">
					<!--<i class="icon-user icon-1x"></i>-->
					<img src="<?php echo TEMPLATE_URL; ?>images/icons/message.png" />
					<span><?php _e('message');?></span>
				</a>
		</li>

        
        <!------system settings------>
        <li class="<?php if($page_name == 'system_settings')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/system_settings" rel="tooltip" data-placement="right" 
                	data-original-title="<?php _e('system_settings');?>">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo TEMPLATE_URL; ?>images/icons/settings.png" />
					<span><?php _e('system_settings');?></span>
				</a>
		</li>
        
        <li class="<?php if($page_name == 'manage_language')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_language" rel="tooltip" data-placement="right" 
                	data-original-title="<?php _e('manage_language');?>">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo TEMPLATE_URL; ?>images/icons/language.png" />
					<span><?php _e('manage_language');?></span>
				</a>
		</li>

		<!------manage own profile--->
		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/manage_profile" rel="tooltip" data-placement="right" 
                	data-original-title="<?php _e('profile_help');?>">
					<!--<i class="icon-lock icon-1x"></i>-->
                    <img src="<?php echo TEMPLATE_URL; ?>images/icons/profile.png" />
					<span><?php _e('profile');?></span>
				</a>
		</li>
		
	</ul>
	
</div>