<?php
                if($d_detail[profile_photo]=="y")
                {
                    $imgsrc="profile_photo/".$_SESSION[d_id].".jpg";
                }
                else{
                    $imgsrc="https://cdn-icons-png.flaticon.com/512/149/149071.png";
                }
                ?>
                <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>ORANGA BUSINESS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $imgsrc;?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $d_detail[name];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> My Network <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="level1.php">Left / Right Business View</a></li>
                      
                      <li><a href="network_list.php">Downline List</a></li>
                      <li><a href="tree_binary.php?d_id=<?php echo $_SESSION[d_id];?>">Binary Tree View</a></li>
                      <li><a href="my_direct.php">My Direct</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>
              <div class="menu_section">
                <h3>Profile</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bank"></i>PIN Desk<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="upgrade_id.php">Activate ID</a></li>
                        <li><a href="request_pin.php">Request E-Pin</a></li>
                        <li><a href="pin_ledger.php">2,700/- PIN Ledger View</a></li>
                    
                        
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bank"></i>Wallet Ledger View<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="hold_wallet_ledger.php">Hold Wallet Ledger View</a></li>
                        
                        <li><a href="withdraw_wallet2_ledger.php">Withdrawal Wallet Ledger View</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bug"></i>Income<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="business_hundler.php">Silver Income</a></li>
                      <li><a href="#">Total Income</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i> My Profile <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="profile_edit.php">Update Profile</a></li>
                      <li><a href="kyc.php">KYC</a></li>
                      <li><a href="pass_change.php">Change Password</a></li>
                      
                    </ul>
                  </li>
                  
                                
    
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../../login.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>