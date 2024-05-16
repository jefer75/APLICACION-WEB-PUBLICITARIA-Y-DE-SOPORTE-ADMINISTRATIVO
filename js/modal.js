const openModal = document.querySelector('.añadir');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal__close');

openModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.add('modal--show');
});

closeModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.remove('modal--show');
});

const dialogo = document.querySelector('.modal_actualizar');
const abrir_ = document.querySelectorAll('.abrir_act');
const cerrar_ = document.querySelector('.cerrar_act');

for (const abrir of abrir_) { // Iterar directamente sobre todos los elementos seleccionados
    abrir.addEventListener('click', function(e) {
        e.preventDefault();
        var paquete = this.getAttribute('id_paquete');
        alert("El paquete que elegiste es " + paquete);
        dialogo.showModal();

        document.getElementById("output").innerText = paquete;
    });     
}

cerrar_.addEventListener('click', (e)=>{
    e.preventDefault();
    dialogo.close();
});