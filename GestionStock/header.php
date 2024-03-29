
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><i class="fa fa-university"></i> <span>ENAR-ERP</span></a>
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
                      <a href="rapport.php"><i class="fa fa-chart-column"></i>Rapport</a>
                    </li>
                  </ul>
                </div>
                
            </div>

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="profile" href="profile.php">
                <span class="fa fa-user" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="paramettre" href="paramettre.php">
                <span class="fa fa-sliders" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="aide" href="aide.php">
                <span class="fa fa-circle-question" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="fa fa-sign-out" aria-hidden="true"></span>
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
                        <a href="profile.php" class="dropdown-item"><i class="fa-regular fa-user fa-pull-right"></i> Profile</a>
                        <a href="paramettre.php" class="dropdown-item">
                          <i class="fa fa-sliders fa-pull-right"></i> Paramettre
                        </a>
                        <a href="aide.php" class="dropdown-item"><i class="fa-regular fa-circle-question fa-pull-right"></i> Aide</a>
                        <a href="logout.php" class="dropdown-item">
                          
                          <i class="fa fa-sign-out fa-pull-right"></i>Deconnecter
                        </a>

                      </div>
                    </li>
                    <li class="nav-item dropdown open" role="presentation">
                      <a class="dropdown-toggle info-number" id="navbarDropDown1" data-toggle="dropdown">
                        <i class="fa-regular fa-bell"></i>
                          <?php 
                          $result = mysqli_query($conn, "SELECT COUNT(*) as nbr_produits FROM stock WHERE quantite < 10");
                          $row = mysqli_fetch_assoc($result);
                          if($row['nbr_produits'] > 0){
                            echo "<span class='badge bg-red'>". $row['nbr_produits'] ."</span>";
                          }
                          ?>
                        
                      </a>
                      <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledly="navbarDropDown1">
                        <?php
                        $result = mysqli_query($conn, "SELECT COUNT(*) as nbr_produits FROM stock WHERE quantite < 10");
                        $row = mysqli_fetch_assoc($result);
                        if($row['nbr_produits'] > 0){
                          ?>
                          <li class="nav-item">
                            <div class="dropdown-item">
                              <?= $row['nbr_produits'] ?> produit dans le stock de quantite inferieur a 10
                            </div>
                          </li>
                        <li class="nav-item">
                          <div class="text-center">
                            <a href="stock.php" class="dropdown-item">
                              <strong>Afficher tout les produits</strong>
                              <i class="fa fa-angle-right"></i>
                            </a>
                          </div>
                        </li>
                          <?php
                        }
                        ?>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>