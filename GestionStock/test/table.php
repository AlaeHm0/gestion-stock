

<div class="right_col" style="height : 100%;" role="main">
            <div>
                <div class="page-title">
                    <div class="title_left">
                        <h3>Ajouter Categorie</h3>
                    </div>
                    <div class="title_right"></div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Code</th>
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
                    <td><button onclick="addArticle()">Ajouter</button></td>
                
                
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
                        <a title="Editer" style="cursor : pointer;" onclick="editerArticle('<?php echo $row['id'] ?>')"><i class="fa-regular fa-pen-to-square fa-pull-left"></i></a>
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
         </div>

         <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.2/datatables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
  });
    function chercher(val){
        $.ajax({
            url : 'data.php',
            method : "POST",
            data : {
                code : val
            },
            cach : false,
            success : function(data){
                var data = JSON.parse(data);
                $("#design").val(data.article);
                $('#unite').text(data.unite);
                $('#prix_ht').text(data.prix_ht);
                $('#tva').text(data.tva);
                $('#quantite').val(0); // reset the value of the quantite
                Total(0); // reset the values of Prix_Total_HT and Prix_Total_TTC
            },
            error : function(xhr, status, error){
                console.error(status + " : " + error)
            }
        })
    }
    

    // function to auto calculate the Prix Total HT and Prix Total TTC
    function Total(qte){
        $('#prix_total_ht').text(eval(qte) * eval($('#prix_ht').text()));
        $('#prix_total_ttc').text(eval($('#prix_total_ht').text()) * eval($('#tva').text()) + eval($('#prix_total_ht').text()));
    }

    // function for delete an article
    function deleteArticle(code){
        const alert = window.confirm("Are You sure?");
        if(alert){
            $.ajax({
                url : "delete_article.php",
                method : "POST",
                data : {
                    code : code
                },
                cach : false,
                success : function(reponse){
                    location.reload();
                },
                error : function(xhr, status, error){
                    console.error(status + " : " + error)
                }
            })
        }
    }

    // function for adding a Article in Vente_article table
    function addArticle(){
        let id = $('#id').val()
        let code = $('#code').val()
        let design = $('#design').val()
        let prix_ht = $('#prix_ht').text()
        let unite = $('#unite').text()
        let quantite = $('#quantite').val()
        let tva = $('#tva').text()
        // check if all the inputs are filled
        if(code && design && prix_ht && unite && quantite && tva){
            $.ajax({
                url : "add_article.php",
                method : "POST",
                cach : false,
                data : {
                    id : id,
                    code : code,
                    article : design,
                    unite : unite,
                    prix_ht : prix_ht,
                    quantite : quantite,
                    tva : tva
                },
                success : function(data){
                    alert(data);
                    location.reload();
                },
                error : function(xhr, status, error){
                    alert(status + " : " + error);
                }
            })
        }else{
            alert("Please entre all the fields!");
        }
    }
    // function for editing a article
    function editerArticle(id){
        $.ajax({
            url : "editer_article.php",
            method : "POST",
            cash : false,
            data : {
                id : id
            },
            success : function(reponse){
                let data = JSON.parse(reponse)
                $('#id').val(data.id)
                $('#code').val(data.code)
                $('#design').val(data.article)
                $('#unite').text(data.unite)
                $('#prix_ht').text(data.prix_ht)
                $('#quantite').val(data.quantite)
                $('#tva').text(data.tva)
                Total(data.quantite) // for calculate the Prix Total HT and TTC
                
            },
            error : function(xhr, status, error){
                console.error(status + " : " + error)
            }
        })
    }
</script>