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
                <h1 class="page-header text-primary"><i class="fa fa-facebook fa-fw"></i>Pages Report<span style="float:right;"></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>
                <!-- Show facebook page table reports  -->
                <div class="panel panel-default facebook_pages">
                    <div class="panel-heading">Facebook Page Reports</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-page">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">Registered Date</th>
                                    <th class="text-center">Facebook Id</th>
                                    <th class="text-center">Profile Name</th>
                                    <th class="text-center">Page Code</th>
                                    <th class="text-center">Page Name</th>
                                    <th class="text-center">Page Link</th>
                                    <th class="text-center">Page Category</th>
                                    <th class="text-center">Page Location</th>
                                    <th class="text-center">Page Followers</th>
                                    <th class="text-center">Page Permissions</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                <tr class="filter-row">
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Registered Date..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Facebook Id..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Profile Name..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Page Code..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Page Name..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Page Link..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Page Category..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Page Location..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Page Followers..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Page Permissions..."></th>
                                    <th class="text-center"><input type="text" class="page-filter-input" placeholder="Filter Status..."></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($fbAllPages as $r) {
                                    $status = ($r["status"] == 1) ? 'Active' : 'Inactive';
                                    $createdAt = date('d/m/Y H:i:s', strtotime($r['date_time']));
                                    echo "<tr>";
                                    echo "";
                                    echo "<td>" . ++$i . "</td>";
									echo "<td class='date_time'>" . $createdAt . "</td>";
                                    echo "<td class='fb_id'>FB00" . $r["fb_id"] . "</td>";
                                    echo "<td class='profile_name'>" . $r["profile_name"] . "</td>";
                                    echo "<td class='account_id'>FBP00" . $r["id"] ."</td>";
                                    echo "<td class='page_name'>" . $r["page_name"] . "</td>";
                                    echo "<td class='page_link'>" . $r["page_link"] . "</td>";
                                    echo "<td class='page_category'>" . $r["page_category"] . "</td>";
                                    echo "<td class='page_location'>" . $r["page_location"] . "</td>";
                                    echo "<td class='page_followers'>" . $r["page_followers"] . "</td>";
                                    echo "<td class='page_permissions'>" . $r["page_permissions"] . "</td>";
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

    // Data table attributes for pages
    $('#dataTables-page').dataTable({
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
        // Apply filter on facebook pages
        $(".page-filter-input").on("keyup", function() {
            var filters = [];
            $(".page-filter-input").each(function() {
                filters.push($(this).val().toLowerCase());
            });
            $("#dataTables-page tbody tr").each(function() {
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