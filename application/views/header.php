<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Marketing Tools</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/header/css/bootstrap.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url(); ?>assets/header/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/header/css/plugins/dataTables.tableTools.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/header/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/header/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/header/css/daterangepicker-bs3.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/header/css/blueimp-gallery.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/header/js/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/header/js/daterangepicker.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/header/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/header/js/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/header/js/daterangepicker.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/metisMenu/metisMenu.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/plugins/dataTables/buttons.html5.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/header/js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/jquery.confirm.js"></script>
    <script src="<?php echo base_url(); ?>assets/header/js/sb-admin-2.js"></script>

</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background:#1a98a6">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:white;" href="<?php echo base_url(); ?>home/dashboard">New Marketing Tools</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-bell fa-fw icon-animated-bell"></i>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts" style="width:360px;">
                        <li id="appDetails"><h5 class="text-center"><i class="fa fa-bell"></i> No Notifications...</h5></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php base_url(); ?>logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn" type="button" style="margin-top: 0; margin-left: 8px; width:50px; height: 35px; padding: 0 0 3px 0;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                        <?php 
                            $userPermissions = $this->session->userdata('permissions');
                            if (has_permission($userPermissions, 'dashboard', 'view')) { 
                        ?>
                            <li>
                                <a class="active" href="<?php echo base_url(); ?>home/dashboard" id="dashboard"><i class="fa fa-tachometer fa-fw"></i>&nbsp;Dashboard</a>
                            </li>
                        <?php } else {
                            redirect(base_url() . 'home/no_user_permissions', 'refresh');
                        } if (has_permission($userPermissions, 'facebook_management', 'view')) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>home/send_sms" id="send_sms"><i class="fa fa-message fa-fw"></i>&nbsp; SMS Panel <span class="fa arrow"></span></a>
                                <ul id="facebookSubmenu" class="nav nav-second-level collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>home/send_sms"><i class="fa fa-sms fa-fw"></i>&nbsp;Send SMS</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>home/sms_reports"><i class="fa fa-file-invoice fa-fw"></i>&nbsp;SMS Reports</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>home/sms_settings"><i class="fa fa-gear fa-fw"></i>&nbsp;SMS Settings</a>
                                    </li>
                                </ul>
                            </li>
                        <?php  } if (has_permission($userPermissions, 'user_management', 'view')) { ?>
                            <!-- <li>
                                <a href="<?php echo base_url(); ?>home/user_management" id="user_management"><i class="fa fa-user fa-fw"></i>&nbsp; User Management</a>
                            </li> -->
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- User profile modal -->
        <div class="modal fade" id="user_profile" tabindex="-1" role="dialog" aria-labelledby="user_profile_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-user fa-fw"></i>&nbsp;User Profile</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger alert-dismissable error1" style="display:none;"></div>
                        
                        <!-- Table to display user profile data -->
                        <table class="table table-bordered">
                            <?php $user = $this->session->userdata('admin');?>
                            <tr>
                                <th>Name</th>
                                <td><?=$user['name'];?></td>
                            </tr>
                            <tr>
                                <th>Roll</th>
                                <td><?=$user['role'];?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?=$user['email'];?></td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td><?=$user['contact'];?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>Active</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>**********</td>
                            </tr>
                        </table>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- User profile modal end -->