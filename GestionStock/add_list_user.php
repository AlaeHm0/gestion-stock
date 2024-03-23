<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Registration</h3>
            </div>
            <div class="title_right">
                
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Ajouter Utilisateur</h4>
                    <label for="nom">Nom</label>
                    <input type="text"class="form-control" id="nom">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login">
                    <label for="mp">Motepass</label>
                    <input type="password" id="psw" class="form-control">
                    <label for="role">Role</label>
                    <input type="text" id="role" class="form-control">
                    <button class="btn btn-primary mt-2" onclick="ajouterUser()">Ajouter</button>
                </div>
                <div class="col-sm-8">
                    <h4>Liste des Utilisateurs</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Login</th>
                                    <th>Motpass</th>
                                    <th>Role</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM user");
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['nom'] ?></td>
                                        <td><?php echo $row['login'] ?></td>
                                        <td><?php echo $row['motpass'] ?></td>
                                        <td><?php echo $row['role'] ?></td>
                                        <td><a class="btn btn-warning"><i class="fa fa-pen-to-square"></i></a></td>
                                        <td><a class="btn btn-danger" onclick="supprimerUser(<?php echo $row['id'] ?>)"><i class="fa fa-trash-can"></i></a></td>
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
    function ajouterUser(){
        let nom = $("#nom").val();
        let login = $("#login").val();
        let psw = $("#psw").val();
        let role = $("#role").val();
        if(nom && login && psw && role){
            $.ajax({
                url : 'request/add_user.php',
                method : 'post',
                data : {
                    nom : nom,
                    login : login,
                    psw : psw,
                    role : role
                },
                cach : false,
                success : function(msg){
                    alert(msg)
                    location.reload()
                },
                error : function(){
                    alert("Il ya un error!")
                }
            })
        }else{
            alert("Please entre all the fields!")
        }
    }
    function supprimerUser(id){
        let confirm = window.confirm("Vous etes sure de supprimer ce utilisateur?")
        if(confirm){
            $.ajax({
                url : "request/delete_user.php",
                method : "post",
                data : {
                    id : id
                },
                cach : false,
                success : function(msg){
                    if(msg == "yes"){
                        alert("Utilisateur est supprime avec success!")
                    }
                    location.reload()
                },
                error : function(){
                    alert("Il y'a un error!")
                }
            })
        }
    }
</script>