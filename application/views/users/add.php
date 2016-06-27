<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?php echo form_open("users/add", array('id'=>'add-new-user-form', 'class'=>'m-t-25 card')); ?>
                <div class="card-header bgm-green">
                    <button type="button" class="close c-white" data-dismiss="modal">&times;</button>
                    <h2>New User</h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="c-black f-500 m-b-10 text-uppercase"><strong>Account Details</strong></p>

                                <div class="pad-zero-right">
                                    <div class="form-group fg-float form-group-validation">
                                        <div class="fg-line">
                                            <?php echo form_input('username', set_value('username'), array('class'=>'form-control fg-input')) ?>
                                        </div>
                                        <?php echo form_label('Username', 'username', array('class'=>'fg-label')) ?>
                                    </div>
                                </div>

                                <div class="pad-zero-right">
                                    <div class="form-group fg-float form-group-validation">
                                        <div class="fg-line">
                                            <?php echo form_input('password', set_value('password'), array('class'=>'form-control fg-input')) ?>
                                        </div>
                                        <?php echo form_label('Password', 'password', array('class'=>'fg-label')) ?>
                                    </div>
                                </div>

                                <div class="pad-zero-right">
                                    <div class="form-group fg-float form-group-validation">
                                        <div class="fg-line">
                                            <?php echo form_input('retype_password', set_value('retype_password'), array('class'=>'form-control fg-input')) ?>
                                        </div>
                                        <?php echo form_label('Retype Password', 'retype_password', array('class'=>'fg-label')) ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="c-black f-500 m-b-10 text-uppercase"><strong>Personal Details</strong></p>

                                <div class="pad-zero-right">
                                    <div class="form-group fg-float form-group-validation">
                                        <div class="fg-line">
                                            <?php echo form_input('users_firstname', set_value('users_firstname'), array('class'=>'form-control fg-input')) ?>
                                        </div>
                                        <?php echo form_label('First name', 'users_firstname', array('class'=>'fg-label')) ?>
                                    </div>
                                </div>

                                <div class="pad-zero-right">
                                    <div class="form-group fg-float form-group-validation">
                                        <div class="fg-line">
                                            <?php echo form_input('users_middlename', set_value('users_middlename'), array('class'=>'form-control fg-input')) ?>
                                        </div>
                                        <?php echo form_label('Middle name', 'users_middlename', array('class'=>'fg-label')) ?>
                                    </div>
                                </div>

                                <div class="pad-zero-right">
                                    <div class="form-group fg-float form-group-validation">
                                        <div class="fg-line">
                                            <?php echo form_input('users_lastname', set_value('users_lastname'), array('class'=>'form-control fg-input')) ?>
                                        </div>
                                        <?php echo form_label('Last name', 'users_lastname', array('class'=>'fg-label')) ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <hr class="m-b-10">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="c-black f-500 m-b-10 m-t-25 text-uppercase"><strong>Privileges</strong></p>
                            </div>
                        </div>
                    </div>

                    <hr class="m-b-10">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="c-black f-500 m-b-10 m-t-25 text-uppercase"><strong>Contact Details</strong></p>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_telephone', set_value('users_telephone'), array('class'=>'bfh-phone form-control fg-input', 'data-format'=>'ddd-ddd dddd')) ?>
                                                </div>
                                                <?php echo form_label('Telephone No.', 'users_telephone', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_mobile', set_value('users_mobile'), array('class'=>'bfh-phone form-control fg-input', 'data-format'=>'d(ddd) ddd-dddd')) ?>
                                                </div>
                                                <?php echo form_label('Mobile No.', 'users_mobile', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_email', set_value('users_email'), array('class'=>'form-control fg-input')) ?>
                                                </div>
                                                <?php echo form_label('Email', 'users_email', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <p class="c-black f-500 m-b-10 m-t-25 text-uppercase"><strong>Address Details</strong></p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_blockno', set_value('users_blockno'), array('class'=>'form-control fg-input')) ?>
                                                </div>
                                                <?php echo form_label('Block No.', 'users_blockno', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_street', set_value('users_street'), array('class'=>'form-control fg-input')) ?>
                                                </div>
                                                <?php echo form_label('Street', 'users_street', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_brgy', set_value('users_brgy'), array('class'=>'form-control fg-input')) ?>
                                                </div>
                                                <?php echo form_label('Subdivision / Brgy', 'users_brgy', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_city', set_value('users_city'), array('class'=>'form-control fg-input')) ?>
                                                </div>
                                                <?php echo form_label('Town / City', 'users_city', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="pad-zero-right">
                                            <div class="form-group fg-float form-group-validation">
                                                <div class="fg-line">
                                                    <?php echo form_input('users_zip', set_value('users_zip'), array('class'=>'form-control fg-input')) ?>
                                                </div>
                                                <?php echo form_label('ZIP Code', 'users_zip', array('class'=>'fg-label')) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <?php echo form_button(array('name'=>'users_submit', 'id'=>'users_submit', 'type'=>'submit'), 'Add', 'class="btn btn-link"') ?>
                    <?php echo form_button('users_close', 'Close', 'class="btn btn-link" data-dismiss="modal"') ?>
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>