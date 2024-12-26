<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .sidebar ul li a.active {
        background: transparent;
    }
    #report {
        background-color: #eee;
    }
    label {
        font-size:18px;
    }
    input[type="checkbox"] {
        width: 15px;
        height: 15px;
        accent-color: lightblue;
    }
    .check-label {
        color:green;
        font-weight:400;
        margin-left: 14%;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12"> 
                <h1 class="page-header text-primary"><i class="fa fa-facebook fa-fw"></i>Tasks Report<span style="float:right;"></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>

                <!-- Show facebook task table reports  -->
                <div class="panel panel-default facebook_task">
                    <div class="panel-heading">Facebook Task Reports</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-task">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No.</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Task</th>
                                        <th class="text-center">Content</th>
                                        <th class="text-center">DM Message</th>
                                        <th class="text-center">File Image / Video</th>
                                        <th class="text-center">Wall</th>
                                        <th class="text-center">Story</th>
                                        <th class="text-center">Link</th>
                                        <th class="text-center">Views - Timing Range</th>
                                        <th class="text-center">Like Quantity</th>
                                        <th class="text-center">Share Quantity</th>
                                        <th class="text-center">Comment Quantity</th>
                                        <th class="text-center">Message Sending Quantity</th>
                                        <th class="text-center">Facebook Accounts</th>
                                        <th class="text-center">Facebook Groups</th>
                                        <th class="text-center">Facebook Pages</th>
                                        <th class="text-center">Publish / Schedule</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Work Completion</th>
                                    </tr>
                                    <tr class="filter-row">
                                        <th class="text-center"></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Created At..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Task..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Content..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter DM Message..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter File Image / Video..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Wall..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Story..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Link..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Views - Timing Range..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Like Quantity..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Share Quantity..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Comment Quantity..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Message Quantity..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Facebook Accounts..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Facebook Groups..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Facebook Pages..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Publish / Schedule..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Status..."></th>
                                        <th class="text-center"><input type="text" class="task-filter-input" placeholder="Filter Work Completion..."></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($fbAllTasks as $r) {
                                        $createdAt = date('d/m/Y H:i:s', strtotime($r['date_time']));
                                        echo "<tr>";
										echo "";
										echo "<td>" . ++$i . "</td>";
										echo "<td class='date_time'>" . $createdAt . "</td>";
										echo "<td class='task'>" . $r["task"] ."</td>";
										echo "<td class='content'>" . $r["content"] . "</td>";
										echo "<td class='content'>" . $r["message"] . "</td>";
										echo "<td class='file'><a href='" . base_url('assets/postingFiles/' . $r["file"]) . "' target='_blank' style='color:#428bca;'>" . $r["file"] . "</a></td>";
										echo "<td class='wall'>" . $r["wall"] . "</td>";
										echo "<td class='story'>" . $r["story"] . "</td>";
										echo "<td class='link'><a href='" . $r["link"] . "' target='_blank' style='color:#428bca;'>" . $r["link"] . "</a></td>";
										echo "<td class='view_timing'>" . $r["view_timing"] . "</td>";
										echo "<td class='like_qty'>" . $r["like_qty"] . "</td>";
										echo "<td class='share_qty'>" . $r["share_qty"] . "</td>";
										echo "<td class='comment_qty'>" . $r["comment_qty"] . "</td>";
										echo "<td class='message_qty'>" . $r["message_qty"] . "</td>";
										echo "<td class='accounts'>" . $r["accounts"] . "</td>";
										echo "<td class='groups'>" . $r["groups"] . "</td>";
										echo "<td class='pages'>" . $r["pages"] . "</td>";
										echo "<td class='task_schedule'>" . $r["task_schedule"] . "</td>";
										echo "<td class='status'>Pending</td>";
										echo "<td class='task_schedule'>20%</td>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

// Data table attributes for pages
        $('#dataTables-task').dataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        columnDefs: [{
            width: 'auto',
            targets: 5
        }],
        "ordering": false,
        buttons: true,
        "pageLength": 10,
        "text":['center'],
        "scrollX": true,
        "searching": false
    });

    $(document).ready(function() {
        // Apply filter on facebook tasks
        $(".task-filter-input").on("keyup", function() {
            var filters = [];
            $(".task-filter-input").each(function() {
                filters.push($(this).val().toLowerCase());
            });
            $("#dataTables-task tbody tr").each(function() {
                var isVisible = true;
                $(this).children("td").each(function(index) {
                    if (index > 0) {
                        var filterValue = filters[index - 1];                        
                        if (filterValue && $(this).text().toLowerCase().indexOf(filterValue) === -1) {
                            isVisible = false;
                        }
                    }
                });
                $(this).toggle(isVisible);
            });
        });
    });
</script>