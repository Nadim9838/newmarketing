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
                <h1 class="page-header" style="color:darkcyan"><i class="fa fa-sms fa-fw"></i>Send SMS<span style="float:right;"></h1>
                <div id="flash-message" style="">
                    <?php echo $this->session->flashdata('msg'); ?>  
                </div>
                <form action="" method="post" enctype="multipart">
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="form-group">
                            <label for="sender_id">Select Sender Id<span class="require">*</span></label>
                            <select name="sender_id" class="form-control" id="sender_id">
                                <option value="">Select Sender Id</option>
                                <option value="">SIM SMS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="language_selector">Select Language</label>
                            <select id="language_selector" class="form-control">
                                <option value="ENGLISH">ENGLISH</option>
                                <option value="AMHARIC">AMHARIC</option>
                                <option value="ARABIC">ARABIC</option>
                                <option value="BENGALI">BENGALI</option>
                                <option value="CHINESE">CHINESE</option>
                                <option value="GREEK">GREEK</option>
                                <option value="GUJARATI">GUJARATI</option>
                                <option value="HINDI">HINDI</option>
                                <option value="KANNADA">KANNADA</option>
                                <option value="MALAYALAM">MALAYALAM</option>
                                <option value="MARATHI">MARATHI</option>
                                <option value="NEPALI">NEPALI</option>
                                <option value="ORIYA">ORIYA</option>
                                <option value="PERSIAN">PERSIAN</option>
                                <option value="PUNJABI">PUNJABI</option>
                                <option value="RUSSIAN">RUSSIAN</option>
                                <option value="SANSKRIT">SANSKRIT</option>
                                <option value="SINHALESE">SINHALESE</option>
                                <option value="SERBIAN">SERBIAN</option>
                                <option value="TAMIL">TAMIL</option>
                                <option value="TELUGU">TELUGU</option>
                                <option value="TIGRINYA">TIGRINYA</option>
                                <option value="URDU">URDU</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message_input">Type Your Message</label>
                            <textarea id="message_input" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="form-group" style="background-color: darkcyan; padding: 10px; border-radius: 5px; color: white; display: flex; justify-content: space-between; align-items: center;">
                            <span><strong>Language:</strong> <span id="selected_language">English</span></span>
                            <span><strong>Character Count:</strong> <span id="char_count">0</span></span>
                            <span><strong>Message Count:</strong> <span id="message_count">0</span></span>
                        </div>

                        <a data-toggle="modal" data-target="#myModal" class="sms_template"> Select Templates</a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <h2 for="exelUpload" class="text-center" style="background-color: #1a98a6; color: #fff;">Upload Excel</h2>
                        <div id="dropzone" style="border: 1px solid #191970; text-align: center; padding: 20px; position: relative; cursor: pointer;" ondragover="event.preventDefault();" ondrop="handleFileDrop(event);">
                            <i class="fa fa-upload" style="color: #191970; font-size: 50px;"></i>
                            <h3 style="color: #191970; margin-top: 10px;">Drop Your File Here</h3>
                            <label for="excelupload" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #191970; color: #fff; border-radius: 5px; cursor: pointer;">Choose File</label>
                            <input type="file" name="excelupload" accept=".csv" id="excelupload" class="form-control" onchange="submitthisform('uploadcsvfile');" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {

        // To show date and time in compaign name field
        const now = new Date();
        // Define month names
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", 
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        
        // Format date and time
        const year = now.getFullYear();
        const month = months[now.getMonth()];
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        $('#compaign').val(formattedDateTime);

        // To calculate message pricing
        const unicodeLanguages = [
            'AMHARIC', 'ARABIC', 'BENGALI', 'CHINESE', 'GREEK', 'GUJARATI',
            'HINDI', 'KANNADA', 'MALAYALAM', 'MARATHI', 'NEPALI', 'ORIYA',
            'PERSIAN', 'PUNJABI', 'RUSSIAN', 'SANSKRIT', 'SINHALESE', 'SERBIAN',
            'TAMIL', 'TELUGU', 'TIGRINYA', 'URDU'
        ];

        let firstSegmentLimit = 160; // Default for English
        let subsequentSegmentLimit = 153; // Default for English

        function updateCounts() {
            const message = $('#message_input').val().trim();
            const charCount = message.length;

            let messageCount = 0;

            if (charCount > 0) {
                if (charCount <= firstSegmentLimit) {
                    messageCount = 1;
                } else {
                    const remainingChars = charCount - firstSegmentLimit;
                    messageCount = 1 + Math.ceil(remainingChars / subsequentSegmentLimit);
                }
            }

            $('#char_count').text(charCount);
            $('#message_count').text(messageCount);
        }

        $('#language_selector').change(function () {
            const selectedLang = $(this).val();
            $('#selected_language').text($(this).find('option:selected').text());

            if (unicodeLanguages.includes(selectedLang)) {
                firstSegmentLimit = 70; // Unicode languages
                subsequentSegmentLimit = 67; // Subsequent segments for Unicode
            } else {
                firstSegmentLimit = 160; // English or other GSM languages
                subsequentSegmentLimit = 153; // Subsequent segments for GSM
            }

            updateCounts();
        });

        $('#message_input').on('input', function () {
            updateCounts();
        });

        // Initialize the counts on page load
        updateCounts();
    });
</script>
</body>
</html>