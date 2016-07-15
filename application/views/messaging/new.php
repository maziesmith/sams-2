<section id="content">
    <div class="container">
        <div class="block-header">
            <h2>Create New Message</h2>
        </div>
        <?php echo form_open("messaging/bulk-send", array('id'=>'send-new-message-form', 'class'=>'card wall-posting')); ?>
            <div class="card-body card-padding">
                <div class="pad-zero-right">
                    <div id="phone-field-container" class="form-group form-group-validation">
                        <label for="msisdn-input">Mobile Phone</label>
                        <select id="msisdn-input" class="input-selectize" name="msisdn[]" multiple>
                            <?php foreach ($form['contacts'] as $contact) {
                                echo "<option value='$contact->id'><strong class='name'>$contact->msisdn</strong><div>$contact->fullname</div></option>";
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body card-padding">
                <div class="form-group-validation">
                    <textarea class="wp-text auto-size" name="body" data-auto-size placeholder="Write SMS..."></textarea>
                </div>
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