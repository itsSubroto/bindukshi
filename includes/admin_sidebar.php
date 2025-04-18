<nav id="sidebar">
    <ul>
        <li>
            <span class="logo">Bindukshi Jewellers</span>
            <button onclick="toggleSidebar()" id="toggle-btn">
                <i class="fa-solid fa-angles-left"></i>
            </button>
        </li>
        <!-- admin name display -->
        <li class="active">
            <?php
            if (isset($_SESSION["admin_id"])) {
            ?>
                <h3 style="text-transform: capitalize; color:#22ff44;">_ Hello <?= $_SESSION["admin_name"] ?>!!!! _</h3>

            <?php
            }
            ?>

        </li>

        <li class="active">
            <a href="../admin/admin_dashboard.php">
                <i class="fa-solid fa-table-columns"></i>
                <span>Dashboard</span>

            </a>
        </li>
        <li>
            <button onclick="toggleSubMenu(this)" class="dropdown-btn">
                <i class="fa-solid fa-folder"></i>
                <span>Product</span>
                <i class="fa-solid fa-angle-down"></i>
            </button>

            <ul class="sub-menu">
                <div>
                    <li><a href="../admin/products_list.php">List</a></li>
                    <li><a href="../admin/products_create.php">Create</a></li>

                </div>
            </ul>
        </li>
        <li>
            <button onclick="toggleSubMenu(this)" class="dropdown-btn">
                <i class="fa-solid fa-folder"></i>
                <span>Category</span>
                <i class="fa-solid fa-angle-down"></i>
            </button>

            <ul class="sub-menu">
                <div>
                    <li><a href="../admin/category_create.php">Create</a></li>
                </div>
            </ul>
        </li>
        <li>
            <a href="../admin/received_order.php">
                <i class="fa-solid fa-list"></i>
                <span>Received Orders</span>

            </a>

        </li>
        <li>
            <a href="../admin/user_accounts.php">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Users</span>

            </a>
        </li>
        <li>
            <a href="../admin/admin_accounts.php">
                <i class="fa-solid fa-user"></i>
                <span>Admin Accounts</span>

            </a>
        </li>
        <!-- admin logout -->
        <?php
        // session_start();

        if (isset($_SESSION["admin_id"])) {
        ?>
            <li>
                <a href="../includes/admin_logout.php">
                    <i class="fa-solid fa-skull-crossbones"></i>
                    <span class="btn">Log out</span>

                </a>
            </li>

        <?php
        }
        ?>

    </ul>
</nav>