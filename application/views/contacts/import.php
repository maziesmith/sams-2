<section id="content">
    <div class="container">
        <div class="card">
            <?php echo breadcrumbs('', 'Import Contact') ?>
            <div class="card-body card-padding">
                <!-- <div class="listview lv-bordered lv-lg">
                    <div class="lv-body">
                        <div class="lv-item media"  style="padding-left: 0">
                            <div class="media-body">
                                <div class="lv-title">ID, Course Name, Course Desc, Program Name, Course Fee</div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <p class="f-500 c-black">Accepts CSV file</p> -->
                <?php echo form_open_multipart("contacts/import", array('id'=>'dropzone', 'class'=>'dropzone m-t-25')); ?>
                    <div class="fileinput fileinput-new fallback" data-provides="fileinput">
                        <span class="btn btn-primary btn-file m-r-10">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Change</span>
                            <div class="file-preview-other"></div>
                            <?php echo form_upload( 'file', set_value('file'), ['class'=>'file-input-field', 'accept'=>'.csv'] ) ?>
                        </span>
                        <span class="fileinput-filename"></span>
                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                        <button type="submit" class="btn btn-primary hidden">Submit</button>
                    </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</section>