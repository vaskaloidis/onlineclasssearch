<?php global $sea_settings; ?>
<div id="header">
			

            <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <li>
                      
                  </li>
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <span class="username">Welcome, <?php echo get_username(); ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          <li><a href="<?php echo base_url() ?>admin/profile"><i class="fa fa-suitcase"></i>Profile</a></li>
                          <li><a href="<?php echo base_url();?>logout"><i class="fa fa-key"></i>Log Out</a></li>
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>
 
</div>