<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= ADMIN_URL ?>dashboard.php">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= ADMIN_URL ?>dashboard.php">
            </a>
        </div>

        <ul class="sidebar-menu">

            <li class="<?php if ($cur_page == "dashboard.php")
                echo "active" ?>">
                    <a class="nav-link" href="<?= ADMIN_URL ?>dashboard.php">
                    <span class="material-symbols-outlined me-2">dashboard</span>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Dropdown
                        Items</span></a>
                <ul class="dropdown-menu">
                    <li class="active"><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 1</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 2</a></li>
                </ul>
            </li> -->

            <li class="<?php if ($cur_page == "setting.php")
                echo "active" ?>">
                    <a class="nav-link" href="setting.php">
                        <span class="material-symbols-outlined me-2">settings</span>
                        <span>Setting</span>
                    </a>
                </li>

                <li class="<?php if ($cur_page == "form.php")
                echo "active" ?>"><a class="nav-link" href="form.php">

                        <span class="material-symbols-outlined me-2">forms_add_on</span>
                        <span>Form</span></a></li>

                <li class="<?php if ($cur_page == "table.php")
                echo "active" ?>"><a class="nav-link" href="table.php">
                        <span class="material-symbols-outlined me-2">table</span>

                        <span>Table</span></a></li>

                <li class="<?php if ($cur_page == "invoice.php")
                echo "active" ?>"><a class="nav-link" href="invoice.php">
                        <span class="material-symbols-outlined me-2">receipt</span>

                        <span>Invoice</span></a></li>

            </ul>
        </aside>
    </div>