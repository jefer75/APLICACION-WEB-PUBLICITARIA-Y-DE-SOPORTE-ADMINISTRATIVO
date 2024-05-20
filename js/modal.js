const openModal = document.getElementById('añadir');
const modal = document.getElementById('añadir_cont');
const closeModal = document.getElementById('añadir_close');

openModal.addEventListener('click', function() {
    modal.showModal();
});

closeModal.addEventListener('click', function(){
    modal.close();
});

