<ul class="main-menu">
    <li class="<?php echo check_link(''); ?>">
        <?php echo anchor('', '<i class="zmdi zmdi-home"></i>Dashboard'); ?>
    </li>
    <li class="sub-menu <?php echo check_link(['contacts', 'contacts/import', 'contacts/export']) ?>">
        <a href=""><i class="zmdi zmdi-account-box"></i> Contacts</a>
        <ul>
            <li class="<?php echo check_link('contacts') ?>"><?php echo anchor( base_url('contacts'), 'All Contacts' ); ?></li>
            <li class="<?php echo check_link('contacts/export') ?>"><?php echo anchor( base_url('contacts/export'), 'Export Contacts' ); ?></li>
            <li class="<?php echo check_link('contacts/import') ?>"><?php echo anchor( base_url('contacts/import'), 'Import Contacts' ); ?></li>
        </ul>
    </li>
    <li class="sub-menu <?php echo check_link(['groups', 'groups/import', 'groups/export']) ?>">
        <a href=""><i class="zmdi zmdi-accounts"></i> Groups</a>
        <ul>
            <li class="<?php echo check_link('groups') ?>" ><?php echo anchor( base_url('groups'), 'All Groups' ); ?></li>
            <li class="<?php echo check_link('groups/export') ?>" ><?php echo anchor( base_url('groups/export'), 'Export Groups' ); ?></li>
            <li class="<?php echo check_link('groups/import') ?>" ><?php echo anchor( base_url('groups/import'), 'Import Groups' ); ?></li>
        </ul>
    </li>
</ul>