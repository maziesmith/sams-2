<ul class="main-menu">
    <li class="<?php echo check_link(''); ?>">
        <?php echo anchor('', '<i class="zmdi zmdi-home"></i>Dashboard'); ?>
    </li>
    <li><hr></li>
    <li class="sub-menu <?php echo check_link(['contacts', 'contacts/trash', 'contacts/import', 'contacts/export']) ?>">
        <a role="button"><i class="zmdi zmdi-account-box"></i> Contacts</a>
        <ul>
            <li class="<?php echo check_link('contacts') ?>"><?php echo anchor( base_url('contacts'), 'All Contacts' ); ?></li>
            <li class="<?php echo check_link('contacts/export') ?>"><?php echo anchor( base_url('contacts/export'), 'Export Contacts' ); ?></li>
            <li class="<?php echo check_link('contacts/import') ?>"><?php echo anchor( base_url('contacts/import'), 'Import Contacts' ); ?></li>
            <li class="<?php echo check_link('contacts/trash') ?>"><?php echo anchor( base_url('contacts/trash'), 'Trashed Contacts' ); ?></li>
        </ul>
    </li>
    <li class="sub-menu <?php echo check_link(['groups', 'groups/import', 'groups/export']) ?>">
        <a role="button"><i class="zmdi zmdi-accounts"></i> Groups</a>
        <ul>
            <li class="<?php echo check_link('groups') ?>" ><?php echo anchor( base_url('groups'), 'All Groups' ); ?></li>
            <li class="<?php echo check_link('groups/export') ?>" ><?php echo anchor( base_url('groups/export'), 'Export Groups' ); ?></li>
            <li class="<?php echo check_link('groups/import') ?>" ><?php echo anchor( base_url('groups/import'), 'Import Groups' ); ?></li>
        </ul>
    </li>
    <li class="sub-menu <?php echo check_link(['levels', 'levels/import', 'levels/export']) ?>">
        <a role="button"><i class="fa fa-signal"></i> Levels</a>
        <ul>
            <li class="<?php echo check_link('levels') ?>" ><?php echo anchor( base_url('levels'), 'All Levels' ); ?></li>
            <li class="<?php echo check_link('levels/export') ?>" ><?php echo anchor( base_url('levels/export'), 'Export Levels' ); ?></li>
            <li class="<?php echo check_link('levels/import') ?>" ><?php echo anchor( base_url('levels/import'), 'Import Levels' ); ?></li>
        </ul>
    </li>
    <li class="sub-menu <?php echo check_link(['types', 'types/import', 'types/export']) ?>">
        <a role="button"><i class="zmdi zmdi-view-list"></i> Types</a>
        <ul>
            <li class="<?php echo check_link('types') ?>" ><?php echo anchor( base_url('types'), 'All Types' ); ?></li>
            <li class="<?php echo check_link('types/export') ?>" ><?php echo anchor( base_url('types/export'), 'Export Types' ); ?></li>
            <li class="<?php echo check_link('types/import') ?>" ><?php echo anchor( base_url('types/import'), 'Import Types' ); ?></li>
        </ul>
    </li>
    <li><hr></li>
    <li class="sub-menu <?php echo check_link(['messaging/inbox', 'messaging/outbox', 'messaging/tracking', 'messaging/templates']) ?>">
        <a role="button"><i class="zmdi zmdi-email"></i> Messaging</a>
        <ul>
            <li class="<?php echo check_link('messaging/inbox') ?>" ><?php echo anchor( base_url('messaging/inbox'), 'Inbox' ); ?></li>
            <li class="<?php echo check_link('messaging/outbox') ?>" ><?php echo anchor( base_url('messaging/outbox'), 'Outbox' ); ?></li>
            <li class="<?php echo check_link('messaging/tracking') ?>" ><?php echo anchor( base_url('messaging/tracking'), 'Tracking' ); ?></li>
            <li class="<?php echo check_link('messaging/templates') ?>" ><?php echo anchor( base_url('messaging/templates'), 'Templates' ); ?></li>
            <!-- <li class="<?php echo check_link('messaging/export') ?>" ><?php echo anchor( base_url('messaging/export'), 'Export Types' ); ?></li>
            <li class="<?php echo check_link('messaging/import') ?>" ><?php echo anchor( base_url('messaging/import'), 'Import Types' ); ?></li> -->
        </ul>
    </li>
    <li><hr></li>
    <li class="sub-menu <?php echo check_link(['users', 'users/privileges', 'users/modules', 'users/import', 'users/export']) ?>">
        <a role="button"><i class="zmdi zmdi-account"></i> Users</a>
        <ul>
            <li class="<?php echo check_link('users') ?>" ><?php echo anchor( base_url('users'), 'All Users' ); ?></li>
            <li class="<?php echo check_link('users/privileges') ?>" ><?php echo anchor( base_url('users/privileges'), 'Privileges' ); ?></li>
            <li class="<?php echo check_link('users/modules') ?>" ><?php echo anchor( base_url('users/modules'), 'Modules' ); ?></li>
            <li class="<?php echo check_link('users/export') ?>" ><?php echo anchor( base_url('users/export'), 'Export Users' ); ?></li>
            <li class="<?php echo check_link('users/import') ?>" ><?php echo anchor( base_url('users/import'), 'Import Users' ); ?></li>
        </ul>
    </li>
</ul>