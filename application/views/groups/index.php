<section id="content">
    <div class="container">

        <div class="card">

            <?php echo breadcrumbs(); ?>

            <div class="table-responsive">

                <input id="group-table-command-list" type="hidden" value="<?php echo base_url('groups') ?>">
                <input id="group-table-command-edit" type="hidden" value="<?php echo base_url('groups/edit') ?>">
                <input id="group-table-command-delete-button" type="hidden" value="<?php echo base_url('groups') ?>">
                <input id="group-table-command-delete-many-button" type="hidden" value="<?php echo base_url('groups/delete/many') ?>">

                <table id="group-table-command" class="table table-condensed table-hover table-vmiddle">
                    <thead>
                        <tr>
                            <th data-column-id="count_id"           data-order="asc" data-type="numeric">#</th>
                            <th data-column-id="groups_id"          data-css-class="groups_id" data-order="asc" data-visible="false" data-identifier="true">Group ID</th>
                            <th data-column-id="groups_name"        data-css-class="groups_name">Group Name</th>
                            <th data-column-id="groups_description" data-css-class="groups_description" >Description</th>
                            <th data-column-id="groups_code"        data-css-class="groups_code" >Code</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
                        </tr>
                    </thead>
                    <tbody><?php
                        foreach ($groups as $group) { ?>
                            <tr>
                                <td><?php echo $group->groups_id ?></td>
                                <td><?php echo $group->groups_name ?></td>
                                <td><?php echo $group->groups_description ?></td>
                                <td><?php echo $group->groups_code ?></td>
                            </tr><?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button id="delete-group-btn" type="button" title="Delete all selected Groups" class="btn btn-float bgm-red delete-all m-btn"><i class="zmdi zmdi zmdi-delete"></i></button>
    <button id="add-new-group-btn" type="button" title="Add new Group" class="btn btn-float bgm-green m-btn" data-toggle="modal" href="#add-group"><i class="zmdi zmdi-accounts-add"></i></button>

</section>

<?php $this->load->view('groups/add') ?>
<?php $this->load->view('groups/edit') ?>