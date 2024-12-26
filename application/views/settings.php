<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .sidebar ul li a.active {
        background: transparent;
    }
    #settings {
        background-color: #eee;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12"> 
                <h1 class="page-header text-primary"><i class="fa fa-gear fa-fw"></i>Settings<span style="float:right;"></span></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>
                <div class="form-group">
                    <label for="validationDefault01">Set Auto Delete Reports <i class="fa fa-clock-o"></i> Time (in Day's)</label>
                    <div class="form-inline">
                        <div class="form-controll">
                            <input type="number" style="width:90% !important;" id="deleteTime" class="form-control" placeholder="Enter auto delete report time in day's" value="<?php if(isset($autoReportDeleteTime)) echo $autoReportDeleteTime;?>">
                        
                            <button type="button" value="Save" onclick='saveAutoReportDelete()' class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="validationDefault01">Set Home Page Scroll <i class="fa fa-clock-o"></i> Time Limit (in Seconds)</label>
                    <div class="form-inline">
                        <div class="form-controll">
                            <input type="number" style="width:90% !important;" id="homeScrollLimit" class="form-control" placeholder="Enter home scroll time limit in seconds" value="<?php if(isset($homeScrollTime)) echo $homeScrollTime;?>">
                        
                            <button type="button" value="Save" onclick='saveScrollTimeLimit()' class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Save auto delete report time
    function saveAutoReportDelete() {
        var value = $('#deleteTime').val();
        var setting = "auto_delete_report";
        $.ajax({
            url: '<?php echo base_url(). "home/add_update_settings"?>',
            type: 'POST',
            data: { value: value, setting : setting },
            success: function(response) {
                if(response) {
                    alert('Auto delete report setting saved successfully!');
                } else {
                    alert('Can\'t save auto delete report setting!' );
                }
            }
        });
    }

    // Save home screen scroll time limit
    function saveScrollTimeLimit() {
        var value = $('#homeScrollLimit').val();
        var setting = "home_scroll_time_limit";
        $.ajax({
            url: '<?php echo base_url(). "home/add_update_settings"?>',
            type: 'POST',
            data: { value: value, setting : setting },
            success: function(response) {
                if(response) {
                    alert('Home screen scroll time setting saved successfully!');
                } else {
                    alert('Can\'t save home screen scroll time setting!' );
                }
            }
        });
    }
</script>
