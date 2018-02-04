<?php
$Permission = json_decode($this->Session->read('PerMissioUser'));
if($this->Session->read('UserAuth.User.id')!=""): ?>
    <div class="sidebar-menu">
        <!-- <div class="nav_welcome">
		<h1><?php echo __('Main'); ?></h1>
		<div class="clearfix"></div>
	</div> -->
        <?php
        if($this->params['controller']=="cars" && $this->params['action'] == "admin_index"){
            $active= "active";

        }
        else {
            $active= "";
        }?>
        <div class="nav-collapse sidebar-nav">
            <nav>

            </nav>
        </div><!--/.well -->
    </div><!--/span-->
<?php endif; ?>
