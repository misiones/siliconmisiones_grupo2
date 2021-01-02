<?php
             <?php
   
             $id_delete = intval($_GET['id']);
             $query = mysqli_query($mysqli, "SELECT * FROM servicios WHERE idservicios='$id_delete'");
             if(mysqli_num_rows($query) == 0){
                 echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
               }else{
               $delete = mysqli_query($mysqli, "DELETE FROM servicios WHERE idservicios='$id_delete'");
               if($delete){
               echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Los datos han sido eliminados correctamente.</div>';
               }else{
               echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
          }
        }
      ?>