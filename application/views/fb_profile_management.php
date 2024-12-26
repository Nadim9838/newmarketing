<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .sidebar ul li a.active {
        background: transparent;
    }
    #facebook_management {
        background-color: #eee;
    }
    
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: lightblue;
    }
    p {
        font-size: 14px;
    }

</style>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12"> 
                <h1 class="page-header text-primary"><i class="fa fa-facebook fa-fw"></i>Profile Management<span style="float:right;"></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>
                <!-- Show table list  -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Facebook Profile List
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No.</th>
                                        <th class="text-center">Account Code</th>
                                        <th class="text-center">Account Id</th>
                                        <th class="text-center">Account Name</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">Religion</th>
                                        <th class="text-center">Cast</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">City</th>
                                        <th class="text-center">State</th>
                                        <th class="text-center">B'day Wish</th>
                                        <th class="text-center">Notification</th>
                                        <th class="text-center">Reel</th>
                                        <th class="text-center">Video</th>
                                        <th class="text-center">Event</th>
                                        <th class="text-center">Home Time Limit <br>with Likes & Comment</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    <tr class="filter-row">
                                        <th class="text-center"></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Account Code..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Account ID..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Account Name..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Gender..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Religion..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Cast..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Location..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter City..."></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter State..."></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"><input type="text" class="profile-filter-input" placeholder="Filter Status..."></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($result as $r) {
                                        echo "<tr>";
										echo "";
										echo "<td>" . ++$i . "</td>";
										echo "<td class='fb_id'> FB00" . $r["id"] . "</td>";
										echo "<td class='account_id'>" . $r["account_id"] . "</td>";
										echo "<td class='name'>" . $r["name"] ."</td>";
										echo "<td class='gender'>" . $r["gender"] . "</td>";
										echo "<td class='religion'>" . $r["religion"] . "</td>";
										echo "<td class='religion'>" . $r["cast"] . "</td>";
										echo "<td class='location'>" . $r["location"] . "</td>";
										echo "<td class='location'>" . $r["city"] . "</td>";
										echo "<td class='state'>" . $r["state"] . "</td>";

										echo "<td class='birthday_wish'>
                                            <input type='checkbox' class='birthday_wish_checkbox'" . 
                                            ($r["birthday_wish"] == 1 ? 'checked' : '') . ">";
                                            if (!empty($r['last_time_birthday_wish'])) {
                                                echo "<p><b> Last Time Perform: <br>" . date('d-m-Y H:i:s', strtotime($r['last_time_birthday_wish'])) . "</b></p></td>";
                                            } 
										echo "<td class='notification'>
                                            <input type='checkbox' class='notification_checkbox'" . 
                                            ($r["notification"] == 1 ? 'checked' : '') . ">";
                                            if (!empty($r['last_time_notification'])) {
                                                echo "<p><b> Last Time Perform: <br>" . date('d-m-Y H:i:s', strtotime($r['last_time_notification'])) . "</b></p></td>";
                                            }

										echo "<td class='reel'>
                                            <input type='checkbox' class='reel_checkbox'" . 
                                            ($r["reel"] == 1 ? 'checked' : '') . ">";
                                            if (!empty($r['last_time_reel'])) {
                                                echo "<p><b> Last Time Perform: <br>" . date('d-m-Y H:i:s', strtotime($r['last_time_reel'])) . "</b></p></td>";
                                            }

										echo "<td class='video'>
                                            <input type='checkbox' class='video_checkbox'" . 
                                            ($r["video"] == 1 ? 'checked' : '') . ">";
                                            if (!empty($r['last_time_video'])) {
                                                echo "<p><b> Last Time Perform: <br>" . date('d-m-Y H:i:s', strtotime($r['last_time_video'])) . "</b></p></td>";
                                            }

										echo "<td class='event'>
                                            <input type='checkbox' class='event_checkbox'" . 
                                            ($r["event"] == 1 ? 'checked' : '') . ">";
                                            if (!empty($r['last_time_event'])) {
                                                echo "<p><b> Last Time Perform: <br>" . date('d-m-Y H:i:s', strtotime($r['last_time_event'])) . "</b></p></td>";
                                            }
                                        
										echo "<td class='home_time_limit'>
                                            <input type='checkbox' class='home_time_limit_checkbox'" . 
                                            ($r["home_time_limit"] == 1 ? 'checked' : '') . ">";
                                            if (!empty($r['last_time_home_time_limit'])) {
                                                echo "<p><b> Last Time Perform: <br>" . date('d-m-Y H:i:s', strtotime($r['last_time_home_time_limit'])) . "</b></p></td>";
                                            }

                                        echo "<td class='status'>Running</td>";
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

    $(document).ready(function(){
        // Save birthday wish details.
        $(document).on('change', '.birthday_wish_checkbox', function() {
            var $row = $(this).closest('tr');
            var fbId = $row.find('.fb_id').text().trim();
            var accountId = $row.find('.account_id').text().trim();
            var field = 'birthday_wish';
            var dateField = 'last_time_birthday_wish';
            var value = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '<?php echo base_url(). "home/add_update_fb_profile_details" ?>',
                type: 'POST',
                data: { fb_id: fbId, account_id: accountId, field: field, date_field: dateField, value: value },
                success: function(response) {
                    console.log('Birthday wish details saved successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });

        });

        // Save notification details.
        $(document).on('change', '.notification_checkbox', function() {
            var $row = $(this).closest('tr');
            var fbId = $row.find('.fb_id').text().trim();
            var accountId = $row.find('.account_id').text().trim();
            var field = 'notification';
            var dateField = 'last_time_notification';
            var value = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '<?php echo base_url(). "home/add_update_fb_profile_details" ?>',
                type: 'POST',
                data: { fb_id: fbId, account_id: accountId, field: field, date_field: dateField, value: value },
                success: function(response) {
                    console.log('Notification details saved successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        });

        // Save reel details.
        $(document).on('change', '.reel_checkbox', function() {
            var $row = $(this).closest('tr');
            var fbId = $row.find('.fb_id').text().trim();
            var accountId = $row.find('.account_id').text().trim();
            var field = 'reel';
            var dateField = 'last_time_reel';
            var value = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '<?php echo base_url(). "home/add_update_fb_profile_details" ?>',
                type: 'POST',
                data: { fb_id: fbId, account_id: accountId, field: field, date_field: dateField, value: value },
                success: function(response) {
                    console.log('Reel details saved successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        });

        // Save video details.
        $(document).on('change', '.video_checkbox', function() {
            var $row = $(this).closest('tr');
            var fbId = $row.find('.fb_id').text().trim();
            var accountId = $row.find('.account_id').text().trim();
            var field = 'video';
            var dateField = 'last_time_video';
            var value = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '<?php echo base_url(). "home/add_update_fb_profile_details" ?>',
                type: 'POST',
                data: { fb_id: fbId, account_id: accountId, field: field, date_field: dateField, value: value },
                success: function(response) {
                    console.log('Video detail saved successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        });

        // Save event details.
        $(document).on('change', '.event_checkbox', function() {
            var $row = $(this).closest('tr');
            var fbId = $row.find('.fb_id').text().trim();
            var accountId = $row.find('.account_id').text().trim();
            var field = 'event';
            var dateField = 'last_time_event';
            var value = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '<?php echo base_url(). "home/add_update_fb_profile_details" ?>',
                type: 'POST',
                data: { fb_id: fbId, account_id: accountId, field: field, date_field: dateField, value: value },
                success: function(response) {
                    console.log('Event detail saved successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        });

        // Save home_time_limit details.
        $(document).on('change', '.home_time_limit_checkbox', function() {
            var $row = $(this).closest('tr');
            var fbId = $row.find('.fb_id').text().trim();
            var accountId = $row.find('.account_id').text().trim();
            var field = 'home_time_limit';
            var dateField = 'last_time_home_time_limit';
            var value = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '<?php echo base_url(). "home/add_update_fb_profile_details" ?>',
                type: 'POST',
                data: { fb_id: fbId, account_id: accountId, field: field, date_field: dateField, value: value },
                success: function(response) {
                    console.log('Home Time Limit detail saved successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        });
        
        // Apply filter on facebook profiles
        $(".profile-filter-input").on("keyup", function() {
            var filters = [];
            $(".profile-filter-input").each(function() {
                filters.push($(this).val().toLowerCase());
            });
            $("#dataTables-example tbody tr").each(function() {
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

</body>
</html>