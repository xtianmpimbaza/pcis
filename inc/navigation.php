<!--</style>-->
<!-- Main Sidebar Container -->
<div class="main-sidebar sidebar-dark-red elevation-4 sidebar-no-expand bg-dark-red">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link bg-transparent text-sm border-info shadow-sm bg-red">
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo"
             class="brand-image img-circle elevation-3 bg-black"
             style="width: 1.8rem;height: 1.8rem;max-height: unset;object-fit:scale-down;object-position:center center">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="clearfix"></div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-4">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child"
                            data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item dropdown">
                                <a href="./" class="nav-link nav-home">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>?page=patients" class="nav-link nav-patients">
                                    <i class="nav-icon fas fa-user-injured"></i>
                                    <p>
                                        Mothers
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>?page=doctors" class="nav-link nav-doctors">
                                    <i class="nav-icon fas fa-user-nurse"></i>
                                    <p>
                                        Doctor
                                    </p>
                                </a>
                            </li>
                            <?php if ($_settings->userdata('type') == 1): ?>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>?page=room_types" class="nav-link nav-room_types">
                                        <i class="nav-icon fas fa-th-list"></i>
                                        <p>
                                            Room Types
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>?page=rooms" class="nav-link nav-rooms">
                                        <i class="nav-icon fas fa-door-open"></i>
                                        <p>
                                            Rooms
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="<?php echo base_url ?>?page=user/list" class="nav-link nav-user_list">
                                        <i class="nav-icon fas fa-users-cog"></i>
                                        <p>
                                            Users
                                        </p>
                                    </a>
                                </li>
<!--                                <li class="nav-item dropdown">-->
<!--                                    <a href="--><?php //echo base_url ?><!--?page=system_info" class="nav-link nav-system_info">-->
<!--                                        <i class="nav-icon fas fa-cogs"></i>-->
<!--                                        <p>-->
<!--                                            Settings-->
<!--                                        </p>-->
<!--                                    </a>-->
<!--                                </li>-->
                            <?php endif; ?>
                            <li class="nav-item dropdown">
                                <a href="<?php echo base_url ?>?page=reminders" class="nav-link nav-reminders">
                                    <i class="nav-icon fas fa-bell"></i>
                                    <p>
                                        Reminders
                                    </p>
                                </a>
                            </li>
<!--                            <li class="nav-item dropdown">-->
<!--                                <a href="--><?php //echo base_url ?><!--?page=reports" class="nav-link nav-reminders">-->
<!--                                    <i class="nav-icon fas fa-bell"></i>-->
<!--                                    <p>-->
<!--                                        Reports-->
<!--                                    </p>-->
<!--                                </a>-->
<!--                            </li>-->
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</div>
<script>
    var page;
    $(document).ready(function () {
        page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
        page = page.replace(/\//gi, '_');

        if ($('.nav-link.nav-' + page).length > 0) {
            $('.nav-link.nav-' + page).addClass('active')
            if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
                $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
                $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
            }
            if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
                $('.nav-link.nav-' + page).parent().addClass('menu-open')
            }
        }

        $('#receive-nav').click(function () {
            $('#uni_modal').on('shown.bs.modal', function () {
                $('#find-transaction [name="tracking_code"]').focus();
            })
            uni_modal("Enter Tracking Number", "transaction/find_transaction.php");
        })
    })
</script>