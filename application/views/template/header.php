<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <title><?= $title; ?> - MCI Telkomsel </title>
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/dashlite.css?ver=3.0.0">
    <link id="skin-default" rel="stylesheet" href="<?= base_url('assets') ?>/css/theme.css?ver=3.0.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
    .document-details {
        margin-bottom: 10px;
        /* Jarak antar elemen */
    }

    .document-details p {
        margin-top: 5px;
        /* Atur margin atas untuk paragraf summary */
        line-height: 1.5;
        /* Atur jarak antar baris */
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .card-text {
        line-height: 1.5;
    }

    /* Gaya tambahan untuk deskripsi dan summary dalam tabel */
    .table td .card {
        width: 100%;
        /* Menjadikan kartu penuh lebar */
        border: 1px solid #ccc;
        /* Garis tepi */
        border-radius: 5px;
        /* Sudut bulat */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Bayangan halus */
        padding: 10px;
        /* Ruang bantal di sekitar kartu */
    }

    .table td .card p {
        margin-bottom: 8px;
        /* Ruang bawah antar paragraf */
    }

    .table td .card hr {
        margin-top: 8px;
        margin-bottom: 8px;
        border: 0;
        border-top: 1px solid #ccc;
    }


    .data-value {
        padding: 0px;
        margin-bottom: 0px;
        font-family: Arial, sans-serif;
        max-width: 400px;
        /* Sesuaikan dengan kebutuhan */
        white-space: pre-wrap;
        /* Memastikan bahwa whitespace dihormati */
        text-align: justify;
        /* Justifikasi teks untuk rapi */
    }

    /* Untuk membuat tabel penuh lebar */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }

    /* Warna latar belakang header tabel */
    .table thead th {
        background-color: #f8f9fa;
    }

    /* Warna latar belakang baris ganjil */
    .table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    /* Warna latar belakang baris genap */
    .table tbody tr:nth-child(even) {
        background-color: #e9ecef;
    }

    /* Warna teks pada header dan sel tabel */
    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    /* Warna latar belakang saat cursor berada di atas baris */
    .table tbody tr:hover {
        background-color: #d1e7dd;
    }

    /* Specific styles for the numbering column */
    .table th:first-child,
    .table td:first-child {
        width: 50px;
        /* Set the width of the numbering column */
        text-align: left;
        /* Align text to the left */
        padding-left: 0.5rem;
        /* Reduce left padding */
        padding-right: 0.5rem;
        /* Reduce right padding */
    }


    /* Stil tombol "Hide Table" */
    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    /* Margin top untuk tombol */
    .mt-3 {
        margin-top: 1rem;
    }

    .nk-notification.unread {
        background-color: #f5f5f5;
        transition: background-color 0.3s ease;
    }

    .nk-notification.read {
        background-color: white;
    }

    hr {
        border-width: 2px;
    }

    .status-success {
        color: green;
    }

    .status-fail {
        color: red;
    }
</style>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="<?= site_url('home') ?>" class="logo-link nk-sidebar-logo" style="display: flex; align-items: center;">
                            <img class="logo-dark logo-img" src="<?= base_url('assets') ?>/images/favicon.png" alt="logo-dark" style="margin-right: 10px;">
                            <span style="font-size: 20px; color: #ff0000; font-family: 'Poppins', sans-serif; font-weight: 900; text-shadow: 1px 1px 2px black;"><strong>MCI Repository</strong></span>
                        </a>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Menu Navigation</h6>
                                </li>

                                <li class="nk-menu-item">
                                    <a href="<?= site_url('home') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                                        <span class="nk-menu-text">Home</span>
                                    </a>
                                </li>

                                <li class="nk-menu-item">
                                    <a href="<?= site_url('assistant') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-airbnb"></em></span>
                                        <span class="nk-menu-text">AI Asisstant</span>
                                    </a>
                                </li>

                                <?php if ($this->session->userdata('role') == 1) : ?>
                                    <li class="nk-menu-item">
                                        <a href="<?= site_url('log-history') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-history"></em></span>
                                            <span class="nk-menu-text">Log Tracking</span>
                                        </a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="<?= site_url('user-management') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                            <span class="nk-menu-text">User Management</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li class="nk-menu-item">
                                    <a href="<?= site_url('under-development') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                        <span class="nk-menu-text">Settings</span>
                                    </a>
                                </li>
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="" class="logo-link nk-sidebar-logo" style="display: flex; align-items: center;">
                                    <img class="logo-dark logo-img" src="assets/images/icon.webp" alt="logo-dark" style="margin-right: 10px;">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-search ms-3 ms-xl-0">
                                <em class="icon ni ni-search"></em>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown notification-dropdown">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <?php if (!empty($logs)) : ?>
                                                <div class="icon-status icon-status-warning">
                                                    <em class="icon ni ni-bell text-danger"></em>
                                                </div>
                                            <?php else : ?>
                                                <!-- Jika tidak ada notifikasi, maka tidak ada ikon yang ditampilkan -->
                                                <div>
                                                    <em class="icon ni ni-bell text-danger"></em>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                            </div>

                                            <div class="dropdown-body" id="notification-container" style="overflow-y: auto; max-height: 200px;">
                                                <?php if (!empty($logs)) : ?>
                                                    <?php foreach ($logs as $log) : ?>
                                                        <?php $is_read = in_array($log->id, $read_logs); ?>
                                                        <div class="nk-notification <?php echo $is_read ? 'read' : 'unread'; ?>" data-log-id="<?php echo $log->id; ?>">
                                                            <div class="nk-notification-item dropdown-inner">
                                                                <div class="nk-notification-content">
                                                                    <div class="nk-notification-text">
                                                                        <?php echo $log->username; ?> <span><?php echo $log->message; ?> </span> <br>
                                                                        <b><?php echo $log->document_name; ?></b>
                                                                    </div>
                                                                    <div class="nk-notification-time" data-upload-time="<?php echo $log->upload_time; ?>">
                                                                        <!-- Waktu akan diperbarui oleh JavaScript -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="dropdown-foot center">
                                                <a href="<?= site_url('under-development') ?>">View All</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm bg-white">
                                                    <em class="icon ni ni-user-alt text-dark" style="font-size: 24px;"></em>
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                    <div class="user-name dropdown-indicator"> <?= $this->session->userdata('username') ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">

                                                    <div class="user-info">
                                                        <span class="lead-text"><?= $this->session->userdata('username') ?></span>
                                                        <span class="sub-text"><?= $this->session->userdata('email') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?= site_url('under-development') ?>"><em class="icon ni ni-user-alt"></em><span>My Profile</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?= site_url('login/logout') ?>"><em class="icon ni ni-signout"></em><span>Logout</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->