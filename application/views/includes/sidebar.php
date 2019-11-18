<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="height: 100vh; overflow-y: scroll;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>study_material" >
                <i class="fa fa-plane"></i>
                <span>Study Material</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>video" >
                <i class="fa fa-ticket"></i>
                <span>Videos</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>current_affairs" >
                <i class="fa fa-ticket"></i>
                <span>Current Affairs</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>favorite" >
                <i class="fa fa-ticket"></i>
                <span>My Favorite</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>category" >
                <i class="fa fa-ticket"></i>
                <span>Category</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>subcategory" >
                <i class="fa fa-ticket"></i>
                <span>Sub Category</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>questions" >
                <i class="fa fa-ticket"></i>
                <span>Question's</span>
              </a>
            </li>
            <!-- <li>
              <a href="<?php echo base_url(); ?>exam" >
                <i class="fa fa-ticket"></i>
                <span>Examination</span>
              </a>
            </li> -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Examination</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>examcategory"><i class="fa fa-circle-o"></i><span>Category</span></a></li>
                <li><a href="<?php echo base_url(); ?>examsubcategory"><i class="fa fa-circle-o"></i><span>Sub Category</span></a></li>
                <li><a href="<?php echo base_url(); ?>exam"><i class="fa fa-circle-o"></i><span>Examination</span></a></li>
              </ul>
            </li>

            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level One
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li> -->

            <?php
            if($role == ROLE_ADMIN || $role == ROLE_INSTITUTE)
            {
            ?>
            <!-- <li>
              <a href="#" >
                <i class="fa fa-thumb-tack"></i>
                <span>Task Status</span>
              </a>
            </li>
            <li>
              <a href="#" >
                <i class="fa fa-upload"></i>
                <span>Task Uploads</span>
              </a>
            </li> -->
            <?php
            }
            if($role == ROLE_ADMIN)
            {
            ?>
            <li>
              <a href="<?php echo base_url(); ?>userListing">
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li>
            <!-- <li>
              <a href="#" >
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
              </a>
            </li> -->
            <?php
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>