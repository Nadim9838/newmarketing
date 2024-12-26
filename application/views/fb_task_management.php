<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .sidebar ul li a.active {
        background: transparent;
    }
    #facebook_management {
        background-color: #eee;
    }
    .year-filter-container {
        text-align: right;
        margin-bottom: 10px;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12"> 
                <h1 class="page-header text-primary"><i class="fa fa-facebook fa-fw"></i>Task Management<span style="float:right;"><button class="btn btn-outline btn-primary" onclick="addFbTask();">Add Facebook Task</button></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>

                <!-- Show table list  -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Facebook Task List
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <!-- Year wise table data filtering -->
                            <div class="year-filter-container">
                                <label for="yearFilter">Filter by Year:</label>
                                <select id="yearFilter">
                                    <option value="">All</option>
                                    <?php 
                                        $years = []; 
                                        foreach ($result as $r) {
                                            $year = substr($r["date_time"], 0, 4);
                                            $years[] = $year;
                                        }
                                        $uniqueYears = array_unique($years);
                                        foreach($uniqueYears as $year) {
                                            echo '<option value="'.$year.'">'.$year.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-example">
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
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($result as $r) {
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
										echo "<td><a class=\"fa fa-trash-o fa-fw delcap\" href='#' title='Delete task' id='{$r['id']}'></a></td></tr>";
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
</div>

<script>
    // Data table attributes
    $('#dataTables-example').dataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        columnDefs: [{
            width: 'auto',
            targets: 12
        }],
        "ordering": true,
        buttons: true,
        "pageLength": 15,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "text":['center'],
        "scrollX": true
    });

    function addFbTask() {
        window.location.href = '<?php echo base_url()."home/add_facebook_task"?>';
    }
    
    $(document).ready(function(){
        // Outside the modal not clickable 
        $('#myModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
        });

        // Delete the facebook accounts
        $(".delcap").on('click', function() {
            var uid = $(this).attr('id');
            $.confirm({
                text: "Are you sure you want to delete this facebook task?",
                confirm: function(button) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . "home/delete_fb_task/"; ?>" + uid,
                        success: function(data) {
                            if (data == '1') {
                                document.location.href = '<?php echo base_url() . "home/fb_task_management"; ?>';
                            } else {
                                document.location.href = '<?php echo base_url() . "home/fb_task_management"; ?>';
                            }
                        }
                    });
                },
                cancel: function(button) {
                    return false;
                }
            });
        });

        // Year wise filtering
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var selectedYear = $('#yearFilter').val(); 
                var dateTime = data[1];
                if (!dateTime) return false;
                
                var year = dateTime.substring(6, 10);
                // Compare the extracted year with the selected year
                if (selectedYear === "" || year === selectedYear) {
                    return true;
                }
                return false;
            }
        );
        var table = $('#dataTables-example').DataTable();
        // Event listener to the year filter dropdown
        $('#yearFilter').on('change', function() {
            table.draw();
        });
    });
</script>

</body>
</html>