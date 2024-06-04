            
              <!-- Table with stripped rows -->
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th><b>ID</b></th>
                    <th>Nombre</th>
                    <th>Edad minima</th>
                    <th>Edad maxima</th>
                    <th>Valor</th>
                    <th>Actualizar</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php      
                  
                  require_once("../../../db/connection2.php");             
                  $result = mysqli_query($con, "SELECT * FROM paquetes");
                  while ($fila = mysqli_fetch_assoc($result)) :
                  ?>
                  <tr>
                    <td><?php echo $fila ['id_paquetes'] ?></td>
                    <td><?php echo $fila ['nombre_paquete'] ?></td>
                    <td><?php echo $fila ['edad_min'] ?></td>
                    <td><?php echo $fila ['edad_max'] ?></td>
                    <td>$<?php echo $fila ['valor'] ?></td>
                    <td>                                  
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila ['id_paquetes']; ?>">
                        <i class="bi bi-pencil">Actualizar</i>
                      </button>
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#eliminar<?php echo $fila ['id_paquetes']; ?>">
                        <i class="bi bi-trash">Eliminar</i>
                      </button>
                      </td>
                        <?php include "../actualizar/act_paquetes.php";?>
                          <?php endwhile; ?>
                       </tr>
                </tbody>
              </table>