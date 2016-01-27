<div class="modal fade" id="add-group" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <input type="hidden" id="group-add-table-command-list" value="<?php echo base_url('contacts/listing') ?>">

            <?php echo form_open("groups/add", array('id'=>'add-new-group-form', 'class'=>'m-t-25 card')); ?>
                <div class="card-header">
                    <h2>New Group</h2>
                </div>
                <div class="modal-body">
                    <p class="c-black f-500 m-b-10 text-uppercase"><strong>Group Details</strong></p>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="pad-zero-left">
                                        <div class="form-group fg-float form-group-validation">
                                            <div class="fg-line">
                                                <?php echo form_input('groups_name', set_value('groups_name'), array('class'=>'form-control fg-input')) ?>
                                            </div>
                                            <?php echo form_label('Group name', 'groups_name', array('class'=>'fg-label')) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="pad-zero-right">
                                        <div class="form-group fg-float form-group-validation">
                                            <div class="fg-line">
                                                <?php echo form_input('groups_code', set_value('groups_code'), array('class'=>'form-control fg-input')) ?>
                                            </div>
                                            <?php echo form_label('Group code', 'groups_code', array('class'=>'fg-label')) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pad-zero-right">
                                <div class="form-group fg-float form-group-validation">
                                    <div class="fg-line">
                                        <?php echo form_textarea(['name'=>'groups_description', 'rows'=>2], set_value('groups_description'), array('class'=>'form-control auto-size')) ?>
                                    </div>
                                    <?php echo form_label('Group description', 'groups_description', array('class'=>'fg-label')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <p class="c-black f-500 m-b-10 text-uppercase"><strong>Group Contacts</strong></p>
                </div>
                <div class="row">
                    <div class="col-sm-12 m-b-0">
                        <div class="table-responsive">
                            <table id="contacts-table-command-add" class="contacts-table-command table table-condensed table-vmiddle">
                                <thead>
                                    <tr>
                                        <th data-column-id="count_id" data-type="numeric">#</th>
                                        <th data-column-id="contacts_id" data-identifier="true" data-visible="false">Contacts ID</th>
                                        <th data-column-id="contacts_name">Name</th>
                                        <th data-column-id="contacts_level" data-visible="false">Level</th>
                                        <th data-column-id="contacts_group" data-order="asc">Current Group</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php /*<!--/-no-data-available-/-->*/ ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link">Add</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>