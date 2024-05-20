//const modal_actualizar = document.getElementById('modal_actualizar');

//sobre todos los elementos seleccionados
$('.abrir_act').click(function(e) {
        e.preventDefault();
        
        var paquete = this.getAttribute('id_paquete');
        var action = 'identificador';
        
        //window.location="../update/paquetes.php?variable=paquete";
        $.ajax({
              URL: '../update/paquetes.php',
              type: 'POST',
              async: true,
              data: {descripcion:action, codigo_paquete:paquete},
    
              success: function(response){
                  console.log(response)
              },
              error: function(error){
                  console.log(error)
              }
          })
        //document.getElementById("output").innerText = paquete;
        
        $('.modal_actualizar').showModal();
        alert("El paquete que elegiste es " + paquete);
    });     


$('.act_cerrar').click(function(e){
    e.preventDefault();
    $('.modal_actualizar').close();
});