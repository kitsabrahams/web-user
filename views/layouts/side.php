<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

   <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="images/profile.jpg" class="img-circle" alt="User Image" />

            </div>
            <div class="pull-left info">
              <p><?php if(!\Yii::$app->user->isGuest){
                echo Yii::$app->user->identity->username;
              } ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview" id="my_account">
              <a href="#">
                <i class="fa fa-user"></i> <span>MY ACCOUNT</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="my_profile"><a href="<?= Url::to(['/user/view', 'id'=>\Yii::$app->user->id]); ?>"><i class="fa fa-circle-o"></i> Account</a></li>
                <li id="reset_password"><a href="<?= Url::to(['/user/change', 'id'=>\Yii::$app->user->id]); ?>"><i class="fa fa-circle-o"></i> Reset Password</a></li>
              </ul>
            </li>
            <?php if(\Yii::$app->user->can('admin')): ?>
            <li id="user" class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Users Panel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
                <li id="user_index"><a href="<?= Url::to(['/user/index']); ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
                <li id="user_create"><a href="<?= Url::to(['/user/create']); ?>"><i class="fa fa-circle-o"></i> New User</a></li>
                <li id="user_permissions"><a href="<?= Url::to(['/auth-item/create']); ?>"><i class="fa fa-circle-o"></i> New Permisson</a></li>
             
              </ul>
            </li>
             <?php endif; ?>
            </li>
            <li class="treeview" id="insurance">
              <a href="#">
                <i class="fa fa-table"></i> <span>Insurance</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if(\Yii::$app->user->can('insurance_user')): ?>
                <li id="insurance_create"><a href="<?= Url::to(['/insurance/create']); ?>"><i class="fa fa-circle-o"></i>Add Company</a></li>
              <?php endif; ?>
                <li id="policies"><a href="<?= Url::to(['/policies']); ?>"><i class="fa fa-circle-o"></i> Policies</a></li>
                <li id="payments"><a href="<?= Url::to(['/payments-received/index']); ?>"><i class="fa fa-circle-o"></i> Payments Received</a></li>
                <li id="aggregators"><a href="<?= Url::to(['/payment-aggregators/index']); ?>"><i class="fa fa-circle-o"></i> Aggregators</a></li>

              </ul>
            </li>
            <li class="treeview" id="ura">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>URA</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="ura_index"><a href="<?= Url::to(['/ura-firstime-reg']); ?>"><i class="fa fa-circle-o"></i> First Time Registrations</a></li>
                <li id="ura_stampduty"><a href="<?= Url::to(['/ura-stampduty-prn-reg']); ?>"><i class="fa fa-circle-o"></i> Stamp Duty Prn</a></li>
              </ul>
            </li>

            <?php if(\Yii::$app->user->can('admin')): ?>
            <li class="treeview" id="mobile_users">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Mobile Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="muser_index"><a href="<?= Url::to(['/mobile-users']); ?>"><i class="fa fa-circle-o"></i> View Mobile Users</a></li>
                <li id="muser_create"><a href="<?= Url::to(['/mobile-users/create']); ?>"><i class="fa fa-circle-o"></i> Add Mobile User</a></li>
              </ul>
            </li>
             <?php endif; ?>

             <li id="messages">
              <a>
                <i class="fa fa-envelope"></i> <span>Messages</span>
                <?php
                $unread = app\models\Inbox::find()->where(['read'=>false])->count();
                if($unread > 0): ?>
                <small class="label pull-right bg-red"><?php echo $unread ?></small>
                <?php endif; ?>
              </a>
              <ul class="treeview-menu">
                <li id="inbox"><a href="<?= Url::to(['/inbox']); ?>"><i class="fa fa-circle-o"></i> Inbox
                <?php if($unread > 0): ?>
                <small class="label pull-right bg-yellow"><?php echo $unread; ?></small>
                <?php endif; ?></a></li>

                <li id="outbox"><a href="<?= Url::to(['/outbox']); ?>"><i class="fa fa-circle-o"></i> Outbox
                   <?php 
                   $outbox = app\models\MessageOutbox::find()->count();
                  if($outbox > 0): ?>
                <small class="label pull-right bg-yellow"><?php echo $outbox; ?></small>
                <?php endif; ?>
                </a></li>
              </ul>
            </li>
           
           
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>