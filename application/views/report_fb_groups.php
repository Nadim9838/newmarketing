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
                <h1 class="page-header text-primary"><i class="fa fa-facebook fa-fw"></i>Groups Report<span style="float:right;"></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>
                <!-- Show facebook group table reports  -->
                <div class="panel panel-default facebook_groups">
                    <div class="panel-heading">Facebook Groups list</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-group">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">Registered Date</th>
                                    <th class="text-center">Facebook Id</th>
                                    <th class="text-center">Profile Name</th>
                                    <th class="text-center">Group Code</th>
                                    <th class="text-center">Group Name</th>
                                    <th class="text-center">Group Link</th>
                                    <th class="text-center">Group Category</th>
                                    <th class="text-center">Group Location</th>
                                    <th class="text-center">Group Members</th>
                                    <th class="text-center">Group Permissions</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                <tr class="filter-row">
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Registered Date..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Facebook Id..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Profile Name..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Group Code..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Group Name..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Group Link..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Group Category..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Group Location..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Group Members..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Group Permissions..."></th>
                                    <th class="text-center"><input type="text" class="group-filter-input" placeholder="Filter Status..."></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($fbAllGroups as $key => $r) {
                                    $status = ($r["status"] == 1) ? 'Active' : 'Inactive';
                                    $createdAt = date('d/m/Y H:i:s', strtotime($r['date_time']));
                                    echo "<tr>";
                                    echo "";
                                    echo "<td>" . ++$i . "</td>";
									echo "<td class='date_time'>" . $createdAt . "</td>";
                                    echo "<td class='fb_id'>FB00" . $r["fb_id"] . "</td>";
                                    echo "<td class='profile_name'>" . $r["profile_name"] . "</td>";
                                    echo "<td class='account_id'>FBG00" . $r["id"] ."</td>";
                                    echo "<td class='group_name'>" . $r["group_name"] . "</td>";
                                    echo "<td class='group_link'>" . $r["group_link"] . "</td>";
                                    echo "<td class='group_category'>" . $r["group_category"] . "</td>";
                                    echo "<td class='group_location'>" . $r["group_location"] . "</td>";
                                    echo "<td class='group_members'>" . $r["group_members"] . "</td>";
                                    echo "<td class='group_permissions'>" . $r["group_permissions"] . "</td>";
                                    echo "<td class='status'>" . $status . "</td>";
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

    // Data table attributes for groups
    $('#dataTables-group').dataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        columnDefs: [{
            width: 'auto',
            targets: 9
        }],
        "ordering": false,
        buttons: true,
        "pageLength": 10,
        "text":['center'],
        "scrollX": true,
        "searching": false
    });

    $(document).ready(function() {
        // Apply filter on facebook groups
        $(".group-filter-input").on("keyup", function() {
            var filters = [];
            $(".group-filter-input").each(function() {
                filters.push($(this).val().toLowerCase());
            });
            $("#dataTables-group tbody tr").each(function() {
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