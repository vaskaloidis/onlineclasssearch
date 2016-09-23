          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="<?php echo base_url();?>dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
				 <?php if ( get_user_right('project', 'view') == true  ) { ?>
                  <li class="sub-menu">
                      <a href="<?php echo base_url();?>project" >
                          <i class="fa fa-cubes"></i>
                          <span>Projects</span>
                      </a>
                  </li>
                  <?php } ?>
 				 <?php if ( get_user_right('project_message', 'view') == true  ) { ?>
                  <li class="sub-menu">
                      <a href="<?php echo base_url();?>project_message/message" >
                          <i class="fa fa-cubes"></i>
                          <span>Project Message</span>
                      </a>
                  </li>
                  <?php } ?>
				  <?php if ( get_user_right('client', 'view') == true  ) { ?>
                  <li class="sub-menu">
                      <a href="<?php echo base_url();?>client" >
                          <i class="fa fa-users"></i>
                          <span>Clients</span>
                      </a>
                  </li>
                  <?php } ?>
				  <?php if ( get_user_right('task', 'view') == true  ) { ?>
                  <li class="sub-menu">
                      <a href="<?php echo base_url();?>task" >
                          <i class="fa fa-users"></i>
                          <span>Task</span>
                      </a>
                  </li>
                  <?php } ?>
				  <?php if ( get_user_right('users', 'view') == true  ) { ?>
                  <li class="sub-menu">
                      <a href="<?php echo base_url();?>users" >
                          <i class="fa fa-user"></i>
                          <span>Users</span>
                      </a>
                  </li>
                  <?php } ?>
				  <?php if ( get_user_right('user_right', 'view') == true  ) { ?>
                  <li class="sub-menu">
                      <a href="<?php echo base_url();?>user_right" >
                          <i class="fa fa-user"></i>
                          <span>User Right</span>
                      </a>
                  </li>
                  <?php } ?>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->