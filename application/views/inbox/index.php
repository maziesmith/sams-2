<section id="content">
    <div class="container">
        <div class="block-header">
            <h2>Messages</h2>
        </div>

        <div class="card m-b-0" id="messages-main">

            <div class="ms-menu">
                <div class="ms-block">
                    <div class="ms-user">
                        <!-- <img src="//placeimg.com/80/80/people" alt=""> -->
                        <div>Signed in as <br/> <?php echo get_fullname(); ?></div>
                    </div>
                </div>

                <div class="ms-block">
                    <div>
                        <a href="#" class="btn btn-link active">Contacts</a>
                        <a href="#" class="btn btn-link ">Groups</a>
                    </div>
                </div>
                <div class="listview lv-user m-t-20">

                    <!-- loop -->
                    <?php
                    foreach ($contacts as $i => $contact) { ?>
                        <a class="lv-item media active" href="#" data-href="<?php echo $contact->msisdn; ?>" >
                            <div class="lv-avatar pull-left">
                                <div class="lv-avatar-inner">
                                    <?php echo acronymify(array($contact->firstname, $contact->lastname)); ?>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="lv-title"><?php echo arraytostring([$contact->firstname, $contact->lastname], ' '); ?></div>
                                <div class="lv-small"><?php echo $contact->msisdn; ?></div>
                            </div>
                        </a>
                    <?php } ?>
                    <!-- /loop -->

                </div>


            </div>

            <div class="ms-body">
                <div id="inbox-message-viewer" class="listview lv-message">
                    <div class="lv-header-alt clearfix">
                        <div id="ms-menu-trigger">
                            <div class="line-wrap">
                                <div class="line top"></div>
                                <div class="line center"></div>
                                <div class="line bottom"></div>
                            </div>
                        </div>

                        <div class="lvh-label hidden-xs">
                            <div class="lv-avatar pull-left">
                                <div class="lv-avatar-inner acronym">
                                    <!-- s -->s
                                </div>
                            </div>
                            <span class="c-black fullname">NM-HR</span>
                        </div>

                        <ul class="lv-actions actions">
                            <li>
                                <a href="">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="zmdi zmdi-check"></i>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="zmdi zmdi-time"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                    <i class="zmdi zmdi-sort"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Latest</a>
                                    </li>
                                    <li>
                                        <a href="">Oldest</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh</a>
                                    </li>
                                    <li>
                                        <a href="">Message Settings</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="lv-body">
                        <?php foreach ($inbox as $i => $message) { ?>
                            <div class="lv-item media <?php echo ("outbox" == $message->table_name) ? 'right' : ''; ?>">
                                <div class="media-body">
                                    <div class="ms-item">
                                        <?php echo $message->body; ?>
                                    </div>
                                    <small class="ms-date">
                                        <i class="zmdi zmdi-time">&nbsp;</i><?php echo date('m/d/Y \a\t h:i', strtotime($message->created_at)); ?>
                                    </small>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="lv-footer ms-reply">
                        <textarea placeholder="What's on your mind..."></textarea>
                        <button><i class="zmdi zmdi-mail-send"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>