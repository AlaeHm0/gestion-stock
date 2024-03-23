<div class="right_col">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Emplacement</h3>
            </div>
            <div class="title_right">
                <h3></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Ajouter Emplacement</h4>
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom">
                    <label for="capacity_max">Capacity Maximal</label>
                    <input type="number" class="form-control" min="0" id="capacity_max">
                    <button class="btn btn-primary mt-2" onclick="ajouterEmplacement()">Ajouter</button>
                </div>
                <div class="col-sm-8">
                    <h4>Liste des Emplacements</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr>
                                    <th>Nom</th>
                                    <th>Capacity Maximal</th>
                                    <th>Capacity Disponible</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $result = mysqli_query($conn, "SELECT * FROM emplacement");
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['nom'] ?></td>
                                        <td><?php echo $row['capacity_max'] ?></td>
                                        <td><?php echo $row['capacity_actuelle'] ?></td>
                                        <td><a class="btn btn-warning" ><i class="fa fa-pen-to-square"></i></a></td>
                                        <td><a class="btn btn-danger" onclick="supprimerEmplacement(<?php echo $row['id'] ?>)"><i class="fa fa-trash-can"></i></a></td>
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
<script>
    function ajouterEmplacement(){
        let nom = $("#nom").val();
        let cap_max = $("#capacity_max").val();
        if(nom && cap_max){
            $.ajax({
                url : "request/ajouter_emplacement.php",
                method : 'post',
                data : {
                    nom : nom,
                    capacity_max : cap_max
                },
                cach : false,
                success : function(msg){
                    alert(msg);
                    location.reload();
                },
                error : function(){
                    console.error("Il ya un error")
                }
            })
        }else{
            alert("Please entre all the fields!")
        }
    }
    function supprimerEmplacement(id){
        let confirm = window.confirm("Vous etes sure de supprimer ce emplacement?")
        if(confirm){
            $.ajax({
                url : "request/supprimer_emplacement.php",
                method : 'post',
                data : {
                    id : id
                },
                cach : false,
                success : function(msg){
                    alert(msg)
                    location.reload()
                },
                error : function(){
                    console.error("Il ya un error")
                }
            })
            .fail(function(msg){
                console.error(msg)
            })
        }
    }
</script>