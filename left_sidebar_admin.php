                        <ul class="metismenu" id="side-menu">

                            
                            <li>
                            <a href="<?php echo $redirection_array[$user_role] ?: $redirection_array["all"]; ?>">
                                <i class="fe-arrow-right-circle"></i>
                                    <!-- <span class="badge badge-success float-right">00</span> -->
                                    <span> Dashboard </span>
                                </a>
                            </li>
                          

                            <li>
                                <a href="desk.php">
                                    <i class="fe-arrow-right-circle"></i>                                  
                                    <span>Desk</span>
                                </a>
                            </li>
                            <li>
                                <a href="booking.php">
                                    <i class="fe-arrow-right-circle"></i>                                  
                                    <span>Booking</span>
                                </a>
                            </li>


                           <li>
                                <a href="javascript: void(0);">
                                <i class="fe-arrow-right-circle"></i>
                                    <span> Users </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="add_user.php">Add User</a>
                                    </li>
                                    
                                    <li>
                                        <a href="manage_users.php">Manage Users</a>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                <i class="fe-arrow-right-circle"></i>
                                    <span> Setting </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                   
                            <li>
                                <a href="setting.php">
                                    <span> Setting </span>
                                </a>
                            </li>
                            <li>
                                <a href="edit_branding.php?branding_id=2">
                                    <span> Branding & Colors </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <span> Email </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-third-level" aria-expanded="false">
                                <li>
                                <a href="email.php">
                                    <span>Email Logs</span>
                                </a>
                            </li>
                            <li>
                                <a href="template.php">
                                    <span>Templates</span>
                                </a>
                            </li>

                                   

                                </ul>
                            </li>
                          

                            <li>
                                <a href="error_log.php">
                                    <span> Error Logs </span>
                                </a>
                            </li>

                                </ul>
                            </li>
                            
                            <li>
                                <a href="#">
                                <i class="fe-arrow-right-circle"></i>
                                    <!-- <span class="badge badge-success float-right">00</span> -->
                                    <span class="backup_now">Backup DB</span>
                                </a>
                            </li>
                           
                           

                            
                        </ul>

                