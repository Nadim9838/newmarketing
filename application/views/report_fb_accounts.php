<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .sidebar ul li a.active {
        background: transparent;
    }
    #report {
        background-color: #eee;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12"> 
                <h1 class="page-header text-primary"><i class="fa fa-facebook fa-fw"></i>Accounts Report<span style="float:right;"></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>
                <!-- Show facebook account table reports  -->
                <div class="panel panel-default facebook_accounts">
                    <div class="panel-heading">Facebook Accounts list</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-account">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">Registered Date</th>
                                    <th class="text-center">Account Code</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Profile Link</th>
                                    <th class="text-center">Account ID</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Mobile No.</th>
                                    <th class="text-center">Email ID</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Religion</th>
                                    <th class="text-center">Cast</th>
                                    <th class="text-center">DOB</th>
                                    <th class="text-center">Age</th>
                                    <th class="text-center">Location</th>
                                    <th class="text-center">City</th>
                                    <th class="text-center">State</th>
                                    <th class="text-center">Friends</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                <tr class="filter-row">
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Registered Date..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Account Code..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Name..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Profile Link..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Account ID..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Password..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Mobile No..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Email ID..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Gender..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Religion..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Cast..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter DOB..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Age..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Location..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter City..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter State..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Friends..."></th>
                                    <th class="text-center"><input type="text" class="account-filter-input" placeholder="Filter Status..."></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($fbAllAccounts as $r) {
                                    $status = ($r["status"] == 1) ? 'Active' : 'Inactive';
                                    $createdAt = date('d/m/Y H:i:s', strtotime($r['date_time']));
                                    echo "<tr>";
                                    echo "";
                                    echo "<td>" . ++$i . "</td>";
                                    echo "<td class='date_time'>" . $createdAt . "</td>";
                                    echo "<td class='id'>FB00" . $r["id"] ."</td>";
                                    echo "<td class='name'>" . $r["name"] . "</td>";
                                    echo "<td class='profile_link'>" . $r["profile_link"] . "</td>";
                                    echo "<td class='account_id'>" . $r["account_id"] . "</td>";
                                    echo "<td class='password'>" . $r["password"] . "</td>";
                                    echo "<td class='mobile'>" . $r["mobile"] . "</td>";
                                    echo "<td class='email'>" . $r["email"] . "</td>";
                                    echo "<td class='gender'>" . $r["gender"] . "</td>";
                                    echo "<td class='religion'>" . $r["religion"] . "</td>";
                                    echo "<td class='cast'>" . $r["cast"] . "</td>";
                                    echo "<td class='dob'>" . $r["dob"] . "</td>";
                                    echo "<td class='age'>" . $r["age"] . "</td>";
                                    echo "<td class='location'>" . $r["location"] . "</td>";
                                    echo "<td class='city'>" . $r["city"] . "</td>";
                                    echo "<td class='state'>" . $r["state"] . "</td>";
                                    echo "<td class='friends'>" . $r["friends"] . "</td>";
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

    // Data table attributes for accounts
    $('#dataTables-account').dataTable({
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
        // Apply filter on facebook accounts
        $(".account-filter-input").on("keyup", function() {
            var filters = [];
            $(".account-filter-input").each(function() {
                filters.push($(this).val().toLowerCase());
            });
            $("#dataTables-account tbody tr").each(function() {
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