<div class="right_col" role="main">
              <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                          <tr>
                              <th> Code</th>
                              <th>Designation</th>
                              <th>Unite</th>
                              <th>Prix HT</th>
                              <th>Quantite</th>
                              <th>Prix Total HT</th>
                              <th>TVA</th>
                              <th>Prix Total TTC</th>
                              <th>OP</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                
                    <td>
                    <input type="hidden" id="id" value=""/>
                    <select name="" id="code" onchange=(chercher(this.value))>
                        <option value=""></option>
                        <?php 
                            $result = mysqli_query($conn, "SELECT code from article");
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?php echo $row['code'] ?>"><?php echo $row['code'] ?></option>
                                
                                <?php
                            }
                        ?>
                    </select>
                    </td>
                    <td>
                        <input list="browsers" id="design" name="browser">
                        <datalist id="browsers">
                        <?php 
                        $result = mysqli_query($conn, "SELECT article from article");
                        while($row = mysqli_fetch_array($result)){
                            ?> 
                                <option value="<?php echo $row['article'] ?>">
                            <?php 
                        }
                        ?>
                        </datalist>
                    </td>
                    <td id='unite'></td>
                    <td id="prix_ht"></td>
                    <td><input type="number" min="0" id="quantite" onchange="Total(this.value)"></td>
                    <td id='prix_total_ht'></td>
                    <td id='tva'></td>
                    <td id='prix_total_ttc'></td>
                    <td><button class="btn btn-primary" onclick="addArticle()">Ajouter</button></td>
                
                
                            </tr>
                            <?php 
                            $result = mysqli_query($conn, "SELECT * FROM vente_article WHERE statut = 'selection' ");
                            while($row = mysqli_fetch_array($result)){
                                ?> 
                                    <tr>
                                    <td><?php echo $row['code'] ?></td>
                                    <td><?php echo $row['article'] ?></td>
                                    <td><?php echo $row['unite'] ?></td>
                                    <td><?php echo $row['prix_ht'] ?></td>
                                    <td><?php echo $row['quantite'] ?></td>
                                    <td><?php echo $row['prix_ht'] * $row['quantite'] ?></td>
                                    <td><?php echo $row['tva'] ?></td>
                                    <td><?php echo $row['prix_ht'] * $row['quantite'] * $row['tva'] + $row['prix_ht'] * $row['quantite'] ?></td>
                                    <td>
                                        <a title="Editer"  style="cursor : pointer;" onclick="editerArticle('<?php echo $row['id'] ?>')"><i class="fa-regular fa-pen-to-square fa-pull-left"></i></a>
                                        <a title="Supprimer" style="cursor : pointer;" onclick="deleteArticle('<?php echo $row['code'] ?>')"><i class="fa-regular fa-trash-can fa-pull-right"></i></a>
                                    </td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>