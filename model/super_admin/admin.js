const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

function buscarEnPagina() {
    var input, filtro, elementos, i, txtValue;
    input = document.getElementById("busqueda");
    filtro = input.value.toUpperCase();
    elementos = document.querySelectorAll(".buscarable");

    elementos.forEach(function(elemento) {
        txtValue = elemento.textContent || elemento.innerText;
        if (txtValue.toUpperCase().indexOf(filtro) > -1) {
            elemento.style.display = "";
        } else {
            elemento.style.display = "none";
        }
    });
}