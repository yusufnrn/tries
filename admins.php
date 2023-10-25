<?php require_once 'header.php';
require_once 'sidebar.php';
require_once 'netting/class.crud.php';
$crud = Crud::init();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">

        <?php
        if(isset($_GET['adminsInsert'])) {?>
            <div class="box box-primary">
                <div class="content-header">
                    <h1>Yönetici Ekle</h1>
                    <hr>
                </div>
                <div class="box-body">
                    <?php
                    if (isset($_POST['admin_insert'])){
                        $sonuc = Crud::insert("admins",$_POST,[
                                "form_name" =>"admin_insert",
                                "dir" =>"admins",
                                "file_name" =>"admins_file",
                                "pass"=>"admins_pass"]);

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

                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Resim Seç</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="file" name="admins_file" required="" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ad Soyad</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" name="admins_namesurname" required="" class="form-control">
                                </div>
                             </div>
                        </div>

                           <div class="form-group">
                            <label>Kullanıcı Adı</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" name="admins_username" required="" class="form-control">
                                </div>
                             </div>
                        </div>

                          <div class="form-group">
                            <label>Kullanıcı Şifre</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="password" name="admins_pass" required="" class="form-control">
                                </div>
                             </div>
                        </div>

                          <div class="form-group">
                            <label>Kullanıcı Durum</label>
                            <div class="row">
                                <div class="col-xs-12">
                                <select class="form-control" name="admins_status">
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                                </select>
                                </div>
                             </div>
                        </div>

                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success" name="admin_insert">Kaydet</button>
                        </div>


                    </form>
                </div>

            </div>
        <?php } ?>
        <div class="box box-primary">
            <div class="content-header">
                <h3>Yöneticiler</h3>
                <div align="right">
                    <a href="?adminsInsert=true"><button class="btn btn-success">Yeni Ekle</button></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th align="center" width="5"></i>#</th>
                        <th>Kullanıcı Adı</th>
                        <th>Ad Soyad</th>
                        <th>Durum</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = Crud::read("admins");
                    $say=1;

                    while($row=$sql->fetch(PDO::FETCH_ASSOC)){  ?>
                    <tr>
                        <td><?php echo $say++;?></td>
                        <td><?php echo $row['admins_username']?></td>
                        <td><?php echo $row['admins_namesurname']?></td>
                        <td><?php
                            if ($row['admins_status']==0){
                                echo "Pasif";
                            }elseif ($row['admins_status']==1){
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
