<section id="content">
    <div class="container">
        <div class="block-header">
            <h2>Messages</h2>
        </div>

        <div class="card m-b-0" id="messages-main">

            <div class="ms-menu">
                <div class="ms-block">
                    <div class="ms-user">
                        <img src="//placeimg.com/80/80/people" alt="">
                        <div>Signed in as <br/> <?php echo get_fullname(); ?></div>
                    </div>
                </div>

                <!-- <div class="ms-block">
                    <div class="dropdown">
                        <a class="btn btn-primary btn-block" href="" data-toggle="dropdown">Messages <i class="caret m-l-5"></i></a>
                        <ul class="dropdown-menu dm-icon w-100">
                            <li><a href=""><i class="zmdi zmdi-email"></i> Messages</a></li>
                            <li><a href=""><i class="zmdi zmdi-account"></i> Contacts</a></li>
                            <li><a href=""><i class="zmdi zmdi-format-list-bulleted"> </i>Todo Lists</a></li>
                        </ul>
                    </div>
                </div>
 -->
                <div class="listview lv-user m-t-20">

                    <!-- loop -->
                    <?php
                    foreach ($inbox as $member) { ?>
                        <a href="<?php echo $member->msisdn; ?>" class="lv-item media active">
                            <div class="lv-avatar pull-left">
                                <div class="lv-avatar-inner">
                                    <?php echo acronymify(array($member->firstname, $member->lastname)); ?>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="lv-title"><?php echo arraytostring([$member->firstname, $member->lastname], ' '); ?></div>
                                <!-- <div class="lv-small">L</div> -->
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
                            <div class="lv-item media">
                                <div class="lv-avatar pull-<?php echo ($i%2==0) ? 'left' : 'right'; ?>">
                                    <div class="lv-avatar-inner">
                                        <?php echo acronymify(array($member->firstname, $member->lastname)); ?>
                                    </div>
                                </div>
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