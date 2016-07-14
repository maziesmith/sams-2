<section id="content">
    <div class="container">
        <div class="block-header">
            <h2>Create New Message</h2>
        </div>
        <?php echo form_open("messaging/send", array('id'=>'add-new-member-form', 'class'=>'card wall-posting')); ?>
            <div class="card-body card-padding">
                <div class="pad-zero-right">
                    <div class="form-group">
                        <label for="msisdn-input">Mobile Phone</label>
                        <select id="msisdn-input" class="input-selectize" name="msisdn" multiple>
                            <option value="1">General Inquiry</option>
                            <option value="2">Advertising</option>
                            <option value="3">Press</option>
                            <option value="5">Account Problems</option>
                            <option value="4">Content Submission</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body card-padding">

                <textarea class="wp-text auto-size" name="body" data-auto-size placeholder="Write SMS..."></textarea>
            </div>

            <ul class="list-unstyled clearfix wpb-actions">
                <li class="pull-rsight">
                    <?php echo form_button(array('name'=>'submit', 'id'=>'submit', 'type'=>'submit'), 'Send', 'class="btn btn-primary btn-sm"') ?>
                    <?php echo form_button('close', 'Send Later...', 'class="btn btn-default btn-sm" data-dismiss="modal"') ?>
                </li>
            </ul>
        <?php echo form_close(); ?>
    </div>
</section>