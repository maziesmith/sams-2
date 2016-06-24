<section id="content">
    <div class="container">
        <div class="card"><?php

            echo breadcrumbs(); ?>

            <div class="table-responsive">
                <table id="user-table-command" class="table table-condensed table-vmiddle table-hover">
                    <thead>
                        <tr>
                            <th data-column-id="count_id"           data-visible="true" data-type="numeric" data-sortable="false">#</th>
                            <th data-column-id="id"        data-css-class="users_id" data-order="asc" data-visible="false" data-identifier="true">User ID</th>
                            <th data-column-id="username"     data-css-class="username" data-order="asc">Username</th>
                            <th data-column-id="users_fullname" data-css-class="users_firstname" data-order="asc">Name</th>
                            <th data-column-id="email"     data-css-class="users_email" data-order="asc">Email</th>
                            <th data-column-id="role"    data-css-class="users_mobile" data-order="asc">Role</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-header-css-class="fixed-width">Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <button id="delete-user-btn" title="Delete all selected Users" class="btn btn-float bgm-red delete-all m-btn"><i class="zmdi zmdi zmdi-delete"></i></button>
    <button id="add-new-user-btn" title="Add new User" class="btn btn-float bgm-green add-new m-btn" data-toggle="modal" href="#add-user"><i class="zmdi zmdi-plus-square"></i></button>
</section>

<?php
$this->load->view('users/add');
$this->load->view('users/edit') ?>