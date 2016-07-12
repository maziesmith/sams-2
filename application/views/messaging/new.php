<section id="content">
    <div class="container">
        <div class="block-header">
            <h2>Create New Message</h2>
        </div>
        <?php echo form_open("messaging/send", array('id'=>'add-new-member-form', 'class'=>'card wall-posting')); ?>
            <div class="card-body card-padding bg-success">
                <div class="pad-zero-right">
                    <div class="fg-float form-group-validation">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-smartphone-iphone"></i></span>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="Mobile phone number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <hr> -->
            <div class="card-body card-padding">
                <textarea class="wp-text" data-auto-size placeholder="Write SMS..."></textarea>
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