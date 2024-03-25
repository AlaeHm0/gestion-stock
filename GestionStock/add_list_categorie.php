<div class="right_col">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Categorie</h3>
            </div>
            <div class="title_right">
                <h3></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Ajouter Categorie</h4>
                    <input type="hidden" value="" id="id">
                    <label for="categorie">Categorie</label>
                    <input id="categorie" type="text" class="form-control" placeholder="entrer ici un categorie">
                    <button class="btn btn-primary mt-2" onclick="ajouterCategorie()" id="submit">Ajouter</button>
                </div>
                <div class="col-sm-8">
                    <h4>Liste des Categories</h4>
                    <table class="table table-striped table-bordered">
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>Categorie</th>
                                <th>Editer</th>
                                <th>Supprimer</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM categorie");
                            while($row = mysqli_fetch_array($result)){
                                ?> 
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['nom'] ?></td>
                                    <td><a class="btn btn-warning" onclick="editerCategorie(<?php echo $row['id'] ?>)"><i class="fa fa-pen-to-square"></i></a></td>
                                    <td><a class="btn btn-danger" onclick="supprimerCategorie(<?php echo $row['id'] ?>)"><i class="fa fa-trash-can"></i></a></td>
                                    
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
<script>
    function ajouterCategorie(){
        let categorie = $('#categorie').val()
        let id = $("#id").val()
        if(categorie){
            $.ajax({
                url : "request/ajouter_categorie.php",
                method : "POST",
                data : {
                    id : id,
                    nom : categorie
                },
                cach : false,
                success : function(msg){
                    alert(msg)
                    location.reload()
                },
                error : function(xhr, status, error){
                    console.error(status + " : " + error)
                }
            })
        }else{
            alert("Please entre a categorie!")
        }
    }
    function supprimerCategorie(id){
        let confirm = window.confirm("Vous etes sure de supprimer ce categorie?")
        if(confirm){
            $.ajax({
                url : "request/supprimer_categorie.php",
                method : "POST",
                cach : false,
                data : {
                    id : id
                },
                success : function(msg){
                    alert(msg);
                    location.reload();
                },
                error : function(xhr, status, error){
                    console.error(status + " : " + error)
                }

            })
        }
    }
    function editerCategorie(id){
        $.ajax({
            url : 'request/editer_categorie.php',
            method : 'GET',
            data : {
                id : id
            },
            cach : false,
            success : function(reponse){
                let data = JSON.parse(reponse);
                $("#categorie").val(data.nom);
                $("#id").val(data.id)
                $("#submit").text('Modifier')
            },
            error : function(xhr, status, error){
                console.error(status + " : " + error)
            }
        })
    }
</script>