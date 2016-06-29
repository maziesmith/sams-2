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

                <div class="ms-block">
                    <div class="dropdown">
                        <!-- <a class="btn btn-primary btn-block" href="" data-toggle="dropdown">Messages <i class="caret m-l-5"></i></a> -->
                        <ul class="dropdown-menu dm-icon w-100">
                            <li><a href=""><i class="zmdi zmdi-email"></i> Messages</a></li>
                            <li><a href=""><i class="zmdi zmdi-account"></i> Contacts</a></li>
                            <li><a href=""><i class="zmdi zmdi-format-list-bulleted"> </i>Todo Lists</a></li>
                        </ul>
                    </div>
                </div>

                <div class="listview lv-user m-t-20">

                    <!-- loop -->
                    <div class="lv-item media active">
                        <div class="lv-avatar pull-left">
                            <img src="img/profile-pics/1.jpg" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Davil Parnell</div>
                            <div class="lv-small">Fierent fastidii recteque ad pro</div>
                        </div>
                    </div>
                    <!-- /loop -->

                </div>


            </div>

            <div class="ms-body">
                <div class="listview lv-message">
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
                                <img src="img/profile-pics/1.jpg" alt="">
                            </div>
                            <span class="c-black">David Parbell</span>
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
                        <div class="lv-item media">
                            <div class="lv-avatar pull-left">
                                <img src="img/profile-pics/1.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="ms-item">
                                    Quisque consequat arcu eget odio cursus, ut tempor arcu vestibulum. Etiam ex arcu, porta a urna non, lacinia pellentesque orci. Proin semper sagittis erat, eget condimentum sapien viverra et. Mauris volutpat magna nibh, et condimentum est rutrum a. Nunc sed turpis mi. In eu massa a sem pulvinar lobortis.
                                </div>
                                <small class="ms-date"><i class="zmdi zmdi-access-time"></i> 20/02/2015 at 09:00</small>
                            </div>
                        </div>

                        <div class="lv-item media right">
                            <div class="lv-avatar pull-right">
                                <img src="img/profile-pics/8.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="ms-item">
                                    Mauris volutpat magna nibh, et condimentum est rutrum a. Nunc sed turpis mi. In eu massa a sem pulvinar lobortis.
                                </div>
                                <small class="ms-date"><i class="zmdi zmdi-access-time"></i> 20/02/2015 at 09:30</small>
                            </div>
                        </div>

                        <div class="lv-item media">
                            <div class="lv-avatar pull-left">
                                <img src="img/profile-pics/1.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="ms-item">
                                    Etiam ex arcumentum
                                </div>
                                <small class="ms-date"><i class="zmdi zmdi-access-time"></i> 20/02/2015 at 09:33</small>
                            </div>
                        </div>

                        <div class="lv-item media right">
                            <div class="lv-avatar pull-right">
                                <img src="img/profile-pics/8.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="ms-item">
                                    Etiam nec facilisis lacus. Nulla imperdiet augue ullamcorper dui ullamcorper, eu laoreet sem consectetur. Aenean et ligula risus. Praesent sed posuere sem. Cum sociis natoque penatibus et magnis dis parturient montes,
                                </div>
                                <small class="ms-date"><i class="zmdi zmdi-access-time"></i> 20/02/2015 at 10:10</small>
                            </div>
                        </div>

                        <div class="lv-item media">
                            <div class="lv-avatar pull-left">
                                <img src="img/profile-pics/1.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <div class="ms-item">
                                    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam ac tortor ut elit sodales varius. Mauris id ipsum id mauris malesuada tincidunt. Vestibulum elit massa, pulvinar at sapien sed, luctus vestibulum eros. Etiam finibus tristique ante, vitae rhoncus sapien volutpat eget
                                </div>
                                <small class="ms-date"><i class="zmdi zmdi-access-time"></i> 20/02/2015 at 10:24</small>
                            </div>
                        </div>
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