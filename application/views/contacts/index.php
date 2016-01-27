<section id="content">
    <div class="container">

        <div class="card"><?php

            echo breadcrumbs(); ?>

            <div class="table-responsive">

                <input id="contact-table-command-list" type="hidden" value="<?php echo base_url('contacts/listing') ?>">
                <input id="contact-table-command-edit-button" type="hidden" value="<?php echo base_url('contacts/edit') ?>">
                <input id="contact-table-command-delete-button" type="hidden" value="<?php echo base_url('contacts/delete') ?>">
                <input id="contact-table-command-delete-many-button" type="hidden" value="<?php echo base_url('contacts/delete') ?>">

                <table id="contact-table-command" class="table table-condensed table-vmiddle table-hover">
                    <thead>
                        <tr>
                            <th data-column-id="count_id"           data-order="asc" data-visible="true" data-type="numeric">#</th>
                            <th data-column-id="contacts_id"        data-css-class="contacts_id" data-order="asc" data-visible="false" data-identifier="true">Contact ID</th>
                            <th data-column-id="contacts_name"      data-css-class="contacts_name">Name</th>
                            <th data-column-id="contacts_level"     data-css-class="contacts_level">Level</th>
                            <th data-column-id="contacts_type"      data-css-class="contacts_type">Type</th>
                            <th data-column-id="contacts_group"     data-css-class="contacts_group">Group</th>
                            <th data-column-id="contacts_email"     data-css-class="contacts_email">Email</th>
                            <th data-column-id="contacts_mobile"    data-css-class="contacts_mobile">Mobile</th>
                            <th data-column-id="contacts_telephone" data-css-class="contacts_telephone" data-visible="false">Telephone</th>
                            <th data-column-id="contacts_address"   data-css-class="contacts_address" data-visible="false">Address</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-header-css-class="fixed-width">Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <button id="delete-contact-btn" title="Delete all selected Contacts" class="btn btn-float bgm-red delete-all m-btn"><i class="zmdi zmdi zmdi-delete"></i></button>
    <button id="add-new-contact-btn" title="Add new Contact" class="btn btn-float bgm-green add-new m-btn" data-toggle="modal" href="#add-contact"><i class="zmdi zmdi-plus-square"></i></button>
</section>

<?php
$this->load->view('contacts/add');
$this->load->view('contacts/edit') ?>