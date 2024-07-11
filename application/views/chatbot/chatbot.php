<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="description" content="TechWave">
    <meta name="author" content="Frenify">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title><?= $title; ?> - MCI Telkomsel</title>
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">


    <script>
        if (!localStorage.frenify_skin) {
            localStorage.frenify_skin = 'dark';
        }
        if (!localStorage.frenify_panel) {
            localStorage.frenify_panel = '';
        }
        document.documentElement.setAttribute("data-techwave-skin", localStorage.frenify_skin);
        if (localStorage.frenify_panel !== '') {
            document.documentElement.classList.add(localStorage.frenify_panel);
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- !Google Fonts -->

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('chat/assets') ?>/css/plugins.css?ver=1.0.0" />
    <link type="text/css" rel="stylesheet" href="<?= base_url('chat/assets') ?>/css/style.css?ver=1.0.0" />
    <!--[if lt IE 9]> <script type="text/javascript" src="js/modernizr.custom.js"></script> <![endif]-->
    <!-- !Styles -->

</head>

<body>


    <!-- Moving Submenu -->
    <div class="techwave_fn_fixedsub">
        <ul></ul>
    </div>
    <!-- !Moving Submenu -->

    <!-- Preloader -->
    <div class="techwave_fn_preloader">
        <svg>
            <circle class="first_circle" cx="50%" cy="50%" r="110"></circle>
            <circle class="second_circle" cx="50%" cy="50%" r="110"></circle>
        </svg>
    </div>
    <!-- !Preloader -->


    <!-- MAIN WRAPPER -->
    <div class="techwave_fn_wrapper fn__has_sidebar">
        <div class="techwave_fn_wrap">


            <!-- HEADER -->
            <header class="techwave_fn_header">

                <!-- Header left: token information -->
                <div class="header__left">
                    <div class="fn__token_info">
                        <span class="token_summary">
                            <span class="count">120</span>
                            <span class="text">Tokens<br>Remain</span>
                        </span>

                    </div>
                </div>
                <!-- /Header left: token information -->


                <!-- Header right: navigation bar -->
                <div class="header__right">
                    <div class="fn__nav_bar">

                        <!-- Notification (bar item) -->
                        <div class="bar__item bar__item_notification has_notification">
                            <a href="#" class="item_opener">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                                </svg>
                            </a>
                            <div class="item_popup">
                                <div class="ntfc_header">
                                    <h2 class="ntfc_title">Notifications</h2>
                                </div>
                                <div class="ntfc_list">
                                    <ul>
                                        <?php if (!empty($logs)) : ?>
                                            <?php foreach ($logs as $log) : ?>
                                                <?php $is_read = in_array($log->id, $read_logs); ?>
                                                <li>
                                                    <p>
                                                        <a href="notification-single.html">
                                                            <?php echo $log->username; ?> telah menambah dokumen baru, <b><?php echo $log->document_name; ?></b>
                                                        </a>
                                                    </p>
                                                    <div class="nk-notification-time" data-upload-time="<?php echo $log->upload_time; ?>">
                                                        <!-- Waktu akan diperbarui oleh JavaScript -->
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- !Notification (bar item) -->


                    </div>
                </div>
                <!-- !Header right: navigation bar -->

            </header>
            <!-- !HEADER -->


            <!-- LEFT PANEL -->
            <div class="techwave_fn_leftpanel">

                <div class="mobile_extra_closer"></div>

                <!-- logo (left panel) -->
                <div class="leftpanel_logo">
                    <a href="index.html" class="fn_logo">
                        <span class="full_logo">
                            <div style="display: flex; align-items: center;">
                                <img src="<?= base_url('assets') ?>/images/favicon.png" width="30" alt="" class="desktop_logo" style="vertical-align: middle;">
                                <span style="font-size: 20px; color: #ffffff; font-family: 'Poppins', sans-serif; font-weight: 900; margin-left: 10px;"><strong>MCI Assistant</strong></span>
                            </div>
                        </span>
                        <span class="short_logo">
                            <img src="<?= base_url('assets') ?>/images/favicon.png" width="30" alt="" class="desktop_logo">
                            <img src="img/logo-retina-mini.png" alt="" class="retina_logo">
                        </span>
                    </a>
                    <a href="#" class="fn__closer fn__icon_button desktop_closer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                        </svg>
                    </a>
                    <a href="#" class="fn__closer fn__icon_button mobile_closer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                        </svg>
                    </a>
                </div>
                <!-- !logo (left panel) -->

                <!-- content (left panel) -->
                <div class="leftpanel_content">
                    <!-- #1 navigation group -->
                    <div class="nav_group">
                        <h2 class="group__title">Menu Navigation</h2>
                        <ul class="group__list">
                            <li>
                                <a href="<?= site_url('home') ?>" class="fn__tooltip menu__item" data-position="right" title="Home">
                                    <span class="icon"><img src="<?= base_url('assets/images') ?>/house.svg" alt="" class="fn__svg"></span>
                                    <span class="text">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('assistant') ?>" class="fn__tooltip menu__item" data-position="right" title="AI Assistant">
                                    <span class="icon"><img src="<?= base_url('assets/images') ?>/robot.svg" alt="" class="fn__svg"></span>
                                    <span class="text">AI Assistant</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('log-history') ?>" class="fn__tooltip menu__item" data-position="right" title="Log Tracking">
                                    <span class="icon"><img src="<?= base_url('assets/images') ?>/log.svg" alt="" class="fn__svg"></span>
                                    <span class="text">Log Tracking</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('user-management') ?>" class="fn__tooltip menu__item" data-position="right" title="User Management">
                                    <span class="icon"><img src="<?= base_url('assets/images') ?>/user.svg" alt="" class="fn__svg"></span>
                                    <span class="text">User Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('account-setting') ?>" class="fn__tooltip menu__item" data-position="right" title="Settings">
                                    <span class="icon"><img src="<?= base_url('assets/images') ?>/setting.svg" alt="" class="fn__svg"></span>
                                    <span class="text">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- !#1 navigation group -->

                    <!-- #2 navigation group -->
                    <div class="nav_group">
                        <h2 class="group__title">User Tools</h2>
                        <ul class="group__list">
                            <li>
                                <a href="<?= site_url('chatbot') ?>" class="fn__tooltip menu__item active" data-position="right" title="AI Chat Bot">
                                    <span class="icon"><img src="<?= base_url('assets/images') ?>/chat.svg" alt="" class="fn__svg"></span>
                                    <span class="text">AI Chat Bot</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- !#2 navigation group -->
                </div>
                <!-- !content (left panel) -->

            </div>
            <!-- !LEFT PANEL -->


            <!-- CONTENT -->
            <div class="techwave_fn_content">

                <!-- PAGE (all pages go inside this div) -->
                <div class="techwave_fn_page">

                    <!-- AI Chat Bot Page -->
                    <div class="techwave_fn_aichatbot_page fn__chatbot">

                        <div class="chat__page">

                            <div class="fn__title_holder">
                                <div class="container">
                                    <!-- Active chat title -->
                                    <h1 class="title">New Chat</h1>
                                    <!-- !Active chat title -->
                                </div>
                            </div>

                            <div class="container">
                                <div class="chat__list">

                                    <div id="chat0" class="chat__item"></div>

                                    <div class="chat__item active" id="chat1">

                                    </div>

                                    <div class="chat__item" id="chat2"></div>

                                    <div class="chat__item" id="chat3"></div>

                                    <div class="chat__item" id="chat4"></div>

                                </div>
                            </div>


                            <div class="chat__comment">
                                <div class="container">
                                    <div class="fn__chat_comment">
                                        <div class="new__chat">
                                            <p>Ask it questions, engage in discussions, or simply enjoy a friendly chat.</p>
                                        </div>
                                        <textarea rows="1" class="fn__hidden_textarea" tabindex="-1"></textarea>
                                        <textarea rows="1" placeholder="Send a message..." id="fn__chat_textarea"></textarea>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="chat__sidebar">
                            <div class="sidebar_header">
                                <a href="#chat0" class="fn__new_chat_link">
                                    <span class="icon"></span>
                                    <span class="text">New Chat</span>
                                </a>
                            </div>
                            <div class="sidebar_content">
                                <div class="chat__group new">
                                    <h2 class="group__title">Today</h2>
                                    <ul class="group__list">
                                        <li class="group__item">
                                            <div class="fn__chat_link active" href="#chat1">
                                                <span class="text">New Chat</span>
                                                <input type="text" value="Chat Bot Definition">
                                                <span class="options">
                                                    <button class="trigger"><span></span></button>
                                                    <span class="options__popup">
                                                        <span class="options__list">
                                                            <button class="edit">Edit</button>
                                                            <button class="delete">Delete</button>
                                                        </span>
                                                    </span>
                                                </span>
                                                <span class="save_options">
                                                    <button class="save">
                                                        <img src="svg/check.svg" alt="" class="fn__svg">
                                                    </button>
                                                    <button class="cancel">
                                                        <img src="svg/close.svg" alt="" class="fn__svg">
                                                    </button>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- !AI Chat Bot Page -->

                </div>
                <!-- !PAGE (all pages go inside this div) -->


                <!-- FOOTER (inside the content) -->
                <footer class="techwave_fn_footer">
                    <div class="techwave_fn_footer_content">
                        <div class="copyright">
                            <p>© 2024 MCI Repository Portal</p>
                        </div>
                        <div class="menu_items">
                            <ul>
                                <li><a href="privacy.html">Advance Analytics and Growth Marketing</a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
                <!-- !FOOTER (inside the content) -->

            </div>
            <!-- !CONTENT -->


        </div>
    </div>
    <!-- !MAIN WRAPPER -->



    <!-- Scripts -->
    <script type="text/javascript" src="<?= base_url('chat/assets') ?>/js/jquery.js?ver=1.0.0"></script>
    <script type="text/javascript" src="<?= base_url('chat/assets') ?>/js/plugins.js?ver=1.0.0"></script>
    <!--[if lt IE 10]> <script type="text/javascript" src="js/ie8.js"></script> <![endif]-->
    <script type="text/javascript" src="<?= base_url('chat/assets') ?>/js/init.js?ver=1.0.0"></script>

    <script>
        function timeDifference(current, previous) {
            const msPerMinute = 60 * 1000;
            const msPerHour = msPerMinute * 60;
            const msPerDay = msPerHour * 24;
            const msPerMonth = msPerDay * 30;
            const msPerYear = msPerDay * 365;

            const elapsed = current - previous;

            if (elapsed < msPerMinute) {
                return 'just now';
            } else if (elapsed < msPerHour) {
                return Math.round(elapsed / msPerMinute) + ' mins ago';
            } else if (elapsed < msPerDay) {
                return Math.round(elapsed / msPerHour) + ' hrs ago';
            } else if (elapsed < msPerMonth) {
                return Math.round(elapsed / msPerDay) + ' days ago';
            } else if (elapsed < msPerYear) {
                return Math.round(elapsed / msPerMonth) + ' months ago';
            } else {
                return Math.round(elapsed / msPerYear) + ' years ago';
            }
        }

        function updateNotificationTimes() {
            var elements = document.querySelectorAll('.nk-notification-time');
            var now = new Date();

            elements.forEach(function(element) {
                var uploadTime = new Date(element.getAttribute('data-upload-time'));
                var diffText = timeDifference(now, uploadTime);
                element.textContent = diffText;
            });
        }

        // Mengirim permintaan AJAX untuk menandai notifikasi sebagai sudah dibaca
        function markAsRead(logId) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("home/readnotif"); ?>',
                data: {
                    log_id: logId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Ubah tampilan notifikasi menjadi 'read'
                        var notification = document.querySelector('.nk-notification[data-log-id="' + logId + '"]');
                        notification.classList.remove('unread');
                        notification.classList.add('read');
                    } else {
                        console.error('Failed to mark notification as read.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        }

        // Perbarui waktu setiap 1 menit (60000 ms)
        setInterval(updateNotificationTimes, 60000);

        // Perbarui waktu saat halaman dimuat pertama kali
        updateNotificationTimes();

        // Tambahkan event listener untuk menandai notifikasi sebagai sudah dibaca saat diklik
        document.querySelectorAll('.nk-notification').forEach(function(notification) {
            notification.addEventListener('click', function() {
                var logId = this.getAttribute('data-log-id');
                markAsRead(logId);
            });
        });
    </script>
    <!-- !Scripts -->

</body>

</html>