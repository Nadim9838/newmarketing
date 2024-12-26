<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .sidebar ul li a.active {
        background: transparent;
    }
    #facebook_management {
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
                <h1 class="page-header"><i class="fa fa-facebook fa-fw"></i>Add Facebook Task<span style="float:right;"><button class="btn btn-outline btn-primary" onclick="window.location.href='<?php echo base_url().'home/fb_task_management'?>'">Back</button></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>

                <div>
                  <?php $data = array('role' => 'form');
                    echo form_open_multipart("home/save_facebook_task", $data); ?>
                    <div class="form-group">
                        <label>Select Work<span style="color:#FF0000;"><sup>*</sup></span></label>
                        <select name="work" id="work" class="form-control work" required>
                            <option Selected value="">Select Work</option>
                            <option value="posting">Posting</option>
                            <option value="video_promoting">Video Promoting</option>
                            <option value="reel_promoting">Reel Promoting</option>
                            <option value="post_promoting">Post Promoting</option>
                            <option value="direct_message">DM Message</option>
                        </select>
                    </div>

                    <!-- Fields for Posting -->
                    <div id="posting_fields" class="form-group form-conditional" style="display:none;">
                        <div class="form-group">
                            <label>Content Writing<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <textarea name="content" class="form-control" rows="3" placeholder="Write content here...."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Select Image / Video<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="file" name="posting_file" class="form-control posting_file">
                        </div>

                        <div class="form-group">
                            <label>Publish / Schedule (Date & Time)<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="datetime-local" name="posting_schedule" class="form-control schedule">
                        </div>

                        <label>Select Place<span style="color:#FF0000;"><sup>*</sup></span></label>
                        <div class="form-group form-control">
                            <label class="check-label">
                                <input type="checkbox" name="posting_wall" class="fb_account_list" /> Wall
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="posting_story" class="fb_account_list" /> Story
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="posting_group" value="group" class="fb_group_list" /> Group
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="posting_page" value="page" class="fb_page_list" /> Page
                            </label>
                        </div>
                    </div>

                    <!-- Fields for Video promoting -->
                    <div id="video_promoting" class="form-group form-conditional" style="display:none;">
                        <div class="form-group">
                            <label>Enter Video Link<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="text" name="video_link" class="form-control" placeholder="Enter Video Link...">
                        </div>

                        <div class="form-group">
                            <label>Enter Views Timing Range<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="video_view_timing" class="form-control" placeholder="Enter Views Timing Range...">
                        </div>

                        <div class="form-group">
                            <label>Enter Likes Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="video_like_qty" class="form-control" placeholder="Enter Like Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Enter Share Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="video_share_qty" class="form-control" placeholder="Enter Share Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Enter Comments Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="video_comment_qty" class="form-control" placeholder="Enter Comments Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Publish / Schedule (Date & Time)<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="datetime-local" name="video_schedule" class="form-control schedule">
                        </div>

                        <label>Select Place<span style="color:#FF0000;"><sup>*</sup></span></label>
                        <div class="form-group form-control">
                            <label class="check-label">
                                <input type="checkbox" name="video_profile" value="profile" class="fb_account_list" /> Profile
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="video_group" value="group"class="fb_group_list" /> Group
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="video_page" value="page" class="fb_page_list" /> Page
                            </label>
                        </div>
                    </div>

                    <!-- Fields for Reel promoting -->
                    <div id="reel_promoting" class="form-group form-conditional" style="display:none;">
                        <div class="form-group">
                            <label>Enter Reel Link<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="text" name="reel_link" class="form-control" placeholder="Enter Reel Link...">
                        </div>

                        <div class="form-group">
                            <label>Enter Views Timing Range<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="reel_view_timing" class="form-control" placeholder="Enter Views Timing Range...">
                        </div>

                        <div class="form-group">
                            <label>Enter Likes Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="reel_like_qty" class="form-control" placeholder="Enter Like Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Enter Share Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="reel_share_qty" class="form-control" placeholder="Enter Share Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Enter Comments Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="reel_comment_qty" class="form-control" placeholder="Enter Comments Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Publish / Schedule (Date & Time)<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="datetime-local" name="reel_schedule" class="form-control schedule">
                        </div>

                        <label>Select Place<span style="color:#FF0000;"><sup>*</sup></span></label>
                        <div class="form-group form-control">
                            <label class="check-label">
                                <input type="checkbox" name="reel_profile" value="profile"  class="fb_account_list" /> Profile
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="reel_group" value="group" class="fb_group_list"  /> Group
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="reel_page" value="page"  class="fb_page_list" /> Page
                            </label>
                        </div>
                    </div>

                    <!-- Fields for Post promoting -->
                    <div id="post_promoting" class="form-group form-conditional" style="display:none;">
                        <div class="form-group">
                            <label>Enter Post Link<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="text" name="post_link" class="form-control" placeholder="Enter Post Link...">
                        </div>

                        <div class="form-group">
                            <label>Enter Likes Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="post_like_qty" class="form-control" placeholder="Enter Like Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Enter Share Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="post_share_qty" class="form-control" placeholder="Enter Share Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Enter Comments Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="post_comment_qty" class="form-control" placeholder="Enter Comments Quantity...">
                        </div>

                        <div class="form-group">
                            <label>Publish / Schedule (Date & Time)<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="datetime-local" name="post_schedule" class="form-control schedule">
                        </div>

                        <label>Select Place<span style="color:#FF0000;"><sup>*</sup></span></label>
                        <div class="form-group form-control">
                            <label class="check-label">
                                <input type="checkbox" name="post_profile" value="profile" class="fb_account_list" /> Profile
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="post_group" value="group"class="fb_group_list"  /> Group
                            </label>
                            <label class="check-label">
                                <input type="checkbox" name="post_page" value="page" class="fb_page_list" /> Page
                            </label>
                        </div>
                    </div>

                    <!-- Fields for Posting -->
                    <div id="direct_message" class="form-group form-conditional" style="display:none;">
                        <div class="form-group">
                            <label>Write Message<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Write Message here...."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Enter Sending Message Quantity<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="number" name="message_qty" class="form-control message_qty">
                        </div>

                        <div class="form-group">
                            <label>Publish / Schedule (Date & Time)<span style="color:#FF0000;"><sup>*</sup></span></label>
                            <input type="datetime-local" name="message_schedule" class="form-control schedule">
                        </div>
                    </div>

                    <!-- Show facebook account table list  -->
                    <div class="panel panel-default facebook_accounts" style="display:none;">
                      <div class="panel-heading">All Facebook Account List</div>
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-account">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" class="account_select_all"></th>
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
                                    </tr>
                                    <tr class="filter-row">
                                        <th class="text-center"></th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($fbAllAccounts as $r) {
                                        echo "<tr>";
										echo "";
                                        echo "<td><input type='checkbox' class='account_checkbox' name='accounts[]' value='". $r["id"] ."'></td>";
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
                                    }
                                    ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>

                    <!-- Show facebook group table list  -->
                    <div class="panel panel-default facebook_groups" style="display:none;">
                      <div class="panel-heading">All Facebook Group List</div>
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-group">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" class="group_select_all"></th>
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
                                    foreach ($fbAllGroups as $key => $r) {
                                        $status = ($r["status"] == 1) ? 'Active' : 'Inactive';
                                        echo "<tr>";
										echo "";
                                        echo "<td><input type='checkbox' class='group_checkbox' name='groups[]' value='". $r["id"] ."'></td>";
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

                    <!-- Show facebook page table list  -->
                    <div class="panel panel-default facebook_pages" style="display:none;">
                      <div class="panel-heading">All Facebook Page List</div>
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive text-center" id="dataTables-page">
                                <thead>
                                    <tr>
                                    <th class="text-center"><input type="checkbox" class="page_select_all"></th>
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
                                    foreach ($fbAllPages as $r) {
                                        $status = ($r["status"] == 1) ? 'Active' : 'Inactive';
                                        echo "<tr>";
										echo "";
                                        echo "<td><input type='checkbox' class='page_checkbox' name='pages[]' value='". $r["id"] ."'></td>";
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
                    <div class="form-group text-right">
                        <input type="submit" style="padding:5px; width:100px; margin:20px 0px 10px 10px;" name="submit" class="btn btn-lg btn-primary" />
                    </div>
                  <?php echo form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // Data table attributes for accounts
    $('#dataTables-account').dataTable({
        dom: 'frtip',
        columnDefs: [{
            width: 'auto',
            targets: 12
        }],
        "ordering": false,
        buttons: [],
        "pageLength": 10,
        "text":['center'],
        "scrollX": true,
        "searching": false
    });

    // Data table attributes for groups
    $('#dataTables-group').dataTable({
        dom: 'frtip',
        columnDefs: [{
            width: 'auto',
            targets: 9
        }],
        "ordering": false,
        buttons: [],
        "pageLength": 10,
        "text":['center'],
        "scrollX": true,
        "searching": false
    });

    // Data table attributes for pages
    $('#dataTables-page').dataTable({
        dom: 'frtip',
        columnDefs: [{
            width: 'auto',
            targets: 5
        }],
        "ordering": false,
        buttons: [],
        "pageLength": 10,
        "text":['center'],
        "scrollX": true,
        "searching": false
    });


    $(document).ready(function() {
        // When the work selection changes
        $('#work').click(function() {
            // Hide all facebook account list
            $('.facebook_accounts').hide();
            $('.facebook_pages').hide();
            $('.facebook_groups').hide();
            $('.fb_account_list').prop('checked', false);
            $('.fb_group_list').prop('checked', false);
            $('.fb_page_list').prop('checked', false);
            
            var selectedWork = $(this).val();
            // Hide all conditional fields initially
            $('.form-conditional').hide();

            // Show fields based on selected work
            if (selectedWork === 'posting') {
                $('#posting_fields').show();
            } else if (selectedWork === 'video_promoting') {
                $('#video_promoting').show();
            } else if (selectedWork === 'reel_promoting') {
                $('#reel_promoting').show();
            } else if (selectedWork === 'post_promoting') {
                $('#post_promoting').show();
            } else if (selectedWork === 'direct_message') {
                $('#direct_message').show();
            }
        });

        // Give select all functionality on facebook account table
        $('.account_select_all').click(function() {
            var isChecked = $(this).is(':checked');
            $('.account_checkbox').prop('checked', isChecked);
        });

        // Unselect checkbox when not all selected accounts
        $('.account_checkbox').click(function() {
            if ($('.account_checkbox:checked').length == $('.account_checkbox').length) {
                $('.account_select_all').prop('checked', true);
            } else {
                $('.account_select_all').prop('checked', false);
            }
        });

        // Give select all functionality on facebook group table
        $('.group_select_all').click(function() {
            var isChecked = $(this).is(':checked');
            $('.group_checkbox').prop('checked', isChecked);
        });

        // Unselect checkbox when not all selected groups
        $('.group_checkbox').click(function() {
            if ($('.group_checkbox:checked').length == $('.group_checkbox').length) {
                $('.group_select_all').prop('checked', true);
            } else {
                $('.group_select_all').prop('checked', false);
            }
        });

        // Give select all functionality on facebook page table
        $('.page_select_all').click(function() {
            var isChecked = $(this).is(':checked');
            $('.page_checkbox').prop('checked', isChecked);
        });

        // Unselect checkbox when not all selected pages
        $('.page_checkbox').click(function() {
            if ($('.page_checkbox:checked').length == $('.page_checkbox').length) {
                $('.page_select_all').prop('checked', true);
            } else {
                $('.page_select_all').prop('checked', false);
            }
        });

        // Show facebook account table when checkbox check
        $('.fb_account_list').change(function() { 
            if ($('.fb_account_list:checked').length > 0) {
                $('.facebook_accounts').show();
                $('#dataTables-account').DataTable().columns.adjust().draw();
            } else {
                $('.facebook_accounts').hide();
            }
        });

        // Show facebook group table when checkbox check
        $('.fb_group_list').change(function() { 
            if ($('.fb_group_list:checked').length > 0) {
                $('.facebook_groups').show();
                $('#dataTables-group').DataTable().columns.adjust().draw();
            } else {
                $('.facebook_groups').hide();
            }
        });

        // Show facebook page table when checkbox check
        $('.fb_page_list').change(function() { 
            if ($('.fb_page_list:checked').length > 0) {
                $('.facebook_pages').show();
                $('#dataTables-page').DataTable().columns.adjust().draw();
            } else {
                $('.facebook_pages').hide();
            }
        });

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