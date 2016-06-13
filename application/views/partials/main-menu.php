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
    <li class="sub-menu <?php echo check_link(['levels', 'levels/import', 'levels/export']) ?>">
        <a href=""><i class="fa fa-signal"></i> Levels</a>
        <ul>
            <li class="<?php echo check_link('levels') ?>" ><?php echo anchor( base_url('levels'), 'All Levels' ); ?></li>
            <li class="<?php echo check_link('levels/export') ?>" ><?php echo anchor( base_url('levels/export'), 'Export Levels' ); ?></li>
            <li class="<?php echo check_link('levels/import') ?>" ><?php echo anchor( base_url('levels/import'), 'Import Levels' ); ?></li>
        </ul>
    </li>
    <li class="sub-menu <?php echo check_link(['types', 'types/import', 'types/export']) ?>">
        <a href=""><i class="zmdi zmdi-view-list"></i> Types</a>
        <ul>
            <li class="<?php echo check_link('types') ?>" ><?php echo anchor( base_url('types'), 'All Types' ); ?></li>
            <li class="<?php echo check_link('types/export') ?>" ><?php echo anchor( base_url('types/export'), 'Export Types' ); ?></li>
            <li class="<?php echo check_link('types/import') ?>" ><?php echo anchor( base_url('types/import'), 'Import Types' ); ?></li>
        </ul>
    </li>
</ul>