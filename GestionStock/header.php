
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-university"></i> <span>ENAR-ERP</span></a>
            </div>
            <div class="clearfix"></div>
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenue,</span>
                <h2><?php echo $_SESSION['nom'] ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <div id="sidebar-menu" class="main_menu_side hidden_print main_menu">
                <div class="menu_section">
                  <ul class="nav side-menu">
                    <li>
                      <a href="dashboard.php"><i class="fa fa-gauge-high"></i>Dashboard</a>
                    </li>
                    <li>
                      <a href="categories.php"><i class="fa fa-table-list"></i>Categorie</a>
                    </li>
                    <li>
                      <a href="users.php"><i class="fa fa-circle-user"></i>Utilisateurs</a>
                    </li>
                    <li>
                      <a href="emplacements.php"><i class="fa fa-building"></i>Emplacements</a>
                    </li>
                    <li>
                      <a><i class="fa fa-product-hunt"></i>Produits <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="list_produits.php"><i class="fa fa-list"></i>Liste des Produits</a></li>
                        <li><a href="add_produit.php"><i class="fa fa-plus"></i>Ajouter Produit</a></li>
                      </ul>
                    </li>
                    <li>
                      <a><i class="fa fa-users"></i>Clients <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="list_client.php"><i class="fa fa-list"></i>Liste des Clients</a></li>
                        <li><a href="add_client.php"><i class="fa fa-plus"></i>Ajouter Client</a></li>
                      </ul>
                    </li>
                    <li>
                      <a><i class="fa fa-user-tie"></i>Fornisseurs <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="list_fornisseur"><i class="fa fa-list"></i>Liste des Fornisseurs</a></li>
                        <li><a href="add_fornisseur"><i class="fa fa-plus"></i>Ajouter Fornisseur</a></li>
                      </ul>
                    </li>
                    <li>
                      <a><i class="fa fa-cart-shopping"></i>Receptions <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="list_receptions.php"><i class="fa fa-list"></i>List des Receptions</a></li>
                        <li><a href="add_reception.php"><i class="fa fa-plus"></i>Ajouter BR</a></li>
                        <li><a href="detail_reception.php"><i class="fa fa-rectangle-list"></i>Detail Reception</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="stock.php"><i class="fa fa-boxes-stacked"></i>Etat de Stock</a>
                    </li>
                    <li>
                      <a><i class="fa fa-file-invoice"></i>Expeditions <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="list_expeditions.php"><i class="fa fa-list"></i>Liste des Expeditions</a></li>
                        <li><a href="add_expedition.php"><i class="fa fa-plus"></i>Ajouter BL</a></li>
                        <li><a href="detail_expedition.php"><i class="fa fa-rectangle-list"></i>Detail Expedition</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-landmark"></i>Societe</a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-chart-column"></i>Rapport</a>
                    </li>
                  </ul>
                </div>
                
            </div>

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="profile">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="message">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="paramettre">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
            </div>
            </div>
            
            <!-- top navigation  -->
            <div class="top_nav">
              <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                  <ul class="navbar-right">
                    <li class="nav-item dropdown open">
                      <a href="#" class="user-profile dropdown-toggle" id="navbarDropDown" data-toggle="dropdown">
                        <img src="images/img.jpg" alt=""><?php echo $_SESSION['login'] ?>
                      </a>
                      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropDown">
                        <a href="#" class="dropdown-item"><i class="fa-regular fa-user fa-pull-right"></i> Profile</a>
                        <a href="#" class="dropdown-item">
                          <i class="fa fa-sliders fa-pull-right"></i> Paramettre
                        </a>
                        <a href="#" class="dropdown-item"><i class="fa-regular fa-circle-question fa-pull-right"></i> Aide</a>
                        <a href="logout.php" class="dropdown-item">
                          
                          <i class="fa fa-sign-out fa-pull-right"></i>Deconnecter
                        </a>

                      </div>
                    </li>
                    <li class="nav-item dropdown open" role="presentation">
                      <a class="dropdown-toggle info-number" id="navbarDropDown1" data-toggle="dropdown">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge bg-red">
                          2
                        </span>
                      </a>
                      <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledly="navbarDropDown1">
                        
                          <li class="nav-item">
                            <a class="dropdown-item">
                              <span class="image">
                                <img src="images/img.jpg" alt="">
                              </span>
                              <span>
                                <span>User</span>
                                <span class="time">
                                  10min
                                </span>
                              </span>
                              <span class="message">un Stock est infussant!</span>
                            </a>
                          </li>
                        <li class="nav-item">
                          <div class="text-center">
                            <a href="#" class="dropdown-item">
                              <strong>Afficher tout les alerts</strong>
                              <i class="fa fa-angle-right"></i>
                            </a>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>