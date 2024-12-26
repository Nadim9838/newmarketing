<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .sidebar ul li a.active {
        background: transparent;
    }
    #send_sms {
        background-color: #eee;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12"> 
                <h1 class="page-header" style="color:darkcyan"><i class="fa fa-file-invoice fa-fw"></i>SMS Reports<span style="float:right;"></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>

            </div>
        </div>
    </div>
  </div>
</div>

</body>
</html>