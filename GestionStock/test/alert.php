<li class="nav-item dropdown open" role="presentation">
                      <a class="dropdown-toggle info-number" id="navbarDropDown1" data-toggle="dropdown">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge bg-red">
                          <?php 
                          $result = mysqli_query($conn, "SELECT COUNT(*) FROM alert WHERE user_destinataire = 1 ");
                          $count = mysqli_fetch_assoc($result);
                          if($count['COUNT(*)'] > 99){
                            echo "99+";
                          }else{
                            echo $count['COUNT(*)'];
                          }
                          ?>
                        </span>
                      </a>
                      <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledly="navbarDropDown1">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM alert JOIN users on alert.user_emiteur = users.id WHERE user_destinataire = 1 LIMIT 3");
                        while($row = mysqli_fetch_array($result)){
                          ?>
                          <li class="nav-item">
                            <a class="dropdown-item">
                              <span class="image">
                                <img src="images/img.jpg" alt="">
                              </span>
                              <span>
                                <span><?php echo $row['nom'] ?></span>
                                <span class="time">
                                <?php 
                                  $curr_time = date('Y-m-d H:i:s');
                                  // Current Time
                                  $time1 = DateTime::createFromFormat('Y-m-d H:i:s', $curr_time);
                                  // Time of The Alert
                                  $time2 = DateTime::createFromFormat('Y-m-d H:i:s', $row['general']);
                              
                                  // Calculate the difference
                                  $interval = date_diff($time2, $time1);
                              
                                  // Display the difference
                                  if($interval->format('%Y')>0){
                                      echo $interval->format('%Yy');
                                  }else if($interval->format('%m')>0){
                                      echo $interval->format('%mmo');
                                  }else if($interval->format('%d')>0){
                                      echo $interval->format('%dd');
                                  }else if($interval->format('%H')>0){
                                      echo $interval->format('%Hh');
                                  }else if($interval->format('%i')>0){
                                      echo $interval->format('%im');
                                  }else{
                                      echo $interval->format('%s seconds');
                                  }  
                                  ?>
                                </span>
                              </span>
                              <span class="message"><?php echo $row['content'] ?></span>
                            </a>
                          </li>
                          <?php
                        }
                        ?>
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