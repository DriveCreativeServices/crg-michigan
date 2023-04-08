<header>
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="left-content d-flex align-items-center">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                            
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">              
                                        <li><a href="index.php">Home</a></li>
                                        <!-- <li><a href="listing.html">Listing <i class="fas fa-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="listing.html">Listing</a></li>
                                                <li><a href="details.html">Listing Details</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="industries.php">Directory</a></li>
                                        <li><a href="community.php">Community</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <!-- <li><a href="#">Blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog_details.html">Blog Details</a></li>
                                                <li><a href="elements.html">Element</a></li>
                                            </ul>
                                        </li> -->
                                        <!-- <li><a href="contact.php">Contact</a></li> -->
                                        <?php 
                                            if($username == "admin" || $username == "staff"){
                                                echo '<li><a href="admin.php">Admin Portal</a></li>';   
                                            }
                                            if($username != ''){
                                                echo '<li><form method="post"><button type="submit" name="logout" class="logout-btn">Logout</button></form></li>';
                                            }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div> 
                        <!-- Search Box -->
                        <form method="post" action="includes/search.php" class="form-box">
                                <input type="text" name="searchTerm" placeholder="Search business, city or article...">
                                <button type="submit" name="search" style="background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                                <div class="search-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                </button>
                        </form>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>