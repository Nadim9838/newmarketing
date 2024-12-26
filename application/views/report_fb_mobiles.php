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
                <h1 class="page-header text-primary"><i class="fa fa-mobile fa-fw"></i>Mobiles Report<span style="float:right;"></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>

                <!-- Show Mobiles report  -->
                <div class="panel panel-default mobiles">
                    <div class="panel-heading">Mobiles list</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-mobile">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No.</th>
                                        <th class="text-center">Registered Date</th>
                                        <th class="text-center">Mobile Id</th>
                                        <th class="text-center">Company & Model</th>
                                        <th class="text-center">Android Version</th>
                                        <th class="text-center">IMEI Number</th>
                                        <th class="text-center">Facebook</th>
                                        <th class="text-center">Instagram</th>
                                        <th class="text-center">Twitter</th>
                                        <th class="text-center">YouTube</th>
                                        <th class="text-center">TikTok</th>
                                        <th class="text-center">WhatsApp</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    <tr class="filter-row">
                                        <th class="text-center"></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Registered Date..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Mobile Id..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Company & Model..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Android Version..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter IMEI Number..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Facebook..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Instagram..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Twitter..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter YouTube..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter TikTok..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter WhatsApp..."></th>
                                        <th class="text-center"><input type="text" class="mobile-filter-input" placeholder="Filter Status..."></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($fbAllMobiles as $r) {
                                        $status = ($r["status"] == 1) ? 'Active' : 'Inactive';
                                        $createdAt = date('d/m/Y H:i:s', strtotime($r['date_time']));
                                        echo "<tr>";
										echo "";
										echo "<td>" . ++$i . "</td>";
										echo "<td class='date_time'>" . $createdAt . "</td>";
										echo "<td class='id'>Mob" . $r["id"] ."</td>";
										echo "<td class='company_model'>" . $r["company_model"] . "</td>";
										echo "<td class='android_version'>" . $r["android_version"] . "</td>";
										echo "<td class='imei_number'>" . $r["imei_number"] . "</td>";
                                        echo "<td class='facebook'>0</td>";
                                        echo "<td class='instagram'>0</td>";
                                        echo "<td class='twitter'>0</td>";
                                        echo "<td class='youtube'>0</td>";
                                        echo "<td class='tiktok'>0</td>";
                                        echo "<td class='whatsapp'>0</td>";
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

    // Data table attributes for mobiles
    $('#dataTables-mobile').dataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        columnDefs: [{
            width: 'auto',
            targets: 12
        }],
        "ordering": false,
        buttons: true,
        "pageLength": 10,
        "text":['center'],
        "scrollX": true,
        "searching": false
    });

    $(document).ready(function() {
        // Apply filter on mobile report
        $(".mobile-filter-input").on("keyup", function() {
            var filters = [];
            $(".mobile-filter-input").each(function() {
                filters.push($(this).val().toLowerCase());
            });
            $("#dataTables-mobile tbody tr").each(function() {
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