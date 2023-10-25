<?php require_once 'header.php';
require_once 'sidebar.php';
require_once 'netting/class.crud.php';
$crud = Crud::init();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">

        <?php
        if(isset($_GET['usersInsert'])) {?>
            <div class="box box-primary">
                <div class="content-header">
                    <h1>Kullanıcı Ekle</h1>
                    <hr>
                </div>
                <div class="box-body">
                    <?php
                    if (isset($_POST['users_insert'])){
                        $sonuc = Crud::insert("users",$_POST,["form_name" =>"users_insert",
                            "pass" =>"users_pass"]);

                        if ($sonuc['status']){ ?>
                            <div class="alert alert-success">
                            Kayıt Başarılı
                            </div>
                      <?php }
                        else{ ?>
                            <div class="alert alert-danger">
                            Kayıt Başarısız
                            </div>
                     <?php   }
                    }
                    ?>






                    <form method="POST">

                        <div class="form-group">
                            <label>Ad Soyad</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" name="users_namesurname" required="" class="form-control">
                                </div>
                             </div>
                        </div>

                           <div class="form-group">
                            <label>Kullanıcı Mail</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="email" name="users_mail" required="" class="form-control">
                                </div>
                             </div>
                        </div>

                          <div class="form-group">
                            <label>Kullanıcı Şifre</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="password" name="users_pass" required="" class="form-control">
                                </div>
                             </div>
                        </div>

                          <div class="form-group">
                            <label>Kullanıcı Durum</label>
                            <div class="row">
                                <div class="col-xs-12">
                                <select class="form-control" name="users_status">
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                                </select>
                                </div>
                             </div>
                        </div>

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success" name="users_insert">Kaydet</button>
                        </div>


                    </form>
                </div>

            </div>
        <?php } ?>
        <div class="box box-primary">
            <div class="content-header">
                <h3>Kullanıcılar</h3>
                <div align="right">
                    <a href="?usersInsert=true"><button class="btn btn-success">Yeni Ekle</button></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th align="center" width="5"></i>#</th>
                        <th>Ad Soyad</th>
                        <th>Mail Adresi</th>
                        <th>Durum</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = Crud::read("users");
                    $say=1;

                    while($row=$sql->fetch(PDO::FETCH_ASSOC)){  ?>
                    <tr>
                        <td><?php echo $say++;?></td>
                        <td><?php echo $row['users_namesurname']?></td>
                        <td><?php echo $row['users_mail']?></td>
                        <td><?php
                            if ($row['users_status']==0){
                                echo "Pasif";
                            }elseif ($row['users_status']==1){
                                echo "Aktif";
                            }

                            ?></td>
                        <td align="center" width="5"><i class="fa fa-pencil-square"></i></td>
                        <td align="center" width="5"><i class="fa fa-trash-o"></i></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
</div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once 'footer.php'; ?>
