<div class="navbar-custom navbar-custom-light">
                        <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li class="dropdown notification-list d-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fe-bell noti-icon"></i>
                                    <span class="badge badge-danger rounded-circle noti-icon-badge">2</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            <span class="float-right">
                                                <a href="" class="text-dark">
                                                    <small>Clear All</small>
                                                </a>
                                            </span>Notification</h5>
                                    </div>

                                    
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src=<?php echo get_branding("branding_logo") ?: "'assets/images/wsp_logo.png'" ;?> alt="user-image" class="rounded-circle">
                                    <small class="pro-user-name ml-1">
                                        <?php
                                        
                                      
                                        echo title_case($username);

                                        ?>
                                    </small>
                                </a>
                                <?php 
                                if($user_role != "visitor"){
                                   ?>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="change_password.php" class="dropdown-item notify-item">
                                        <i class="fe-user"></i>
                                        <span>Change Password</span>
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    <a href="logout.php" class="dropdown-item notify-item">
                                        <i class="fe-log-out"></i>
                                        <span>Logout</span>
                                    </a>

                                </div>
                                <?php
                                }
                                ?>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left disable-btn">
                            <i class="fe-menu"></i>
                        </button>
                        
                    </div>