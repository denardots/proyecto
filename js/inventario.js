let botones = document.getElementsByClassName(`botones`);
const mensaje=document.getElementById(`mensaje`);
const datos=document.getElementById(`datos`);
const confirmar=document.getElementById(`confirmar`);

for(let i=0;i<botones.length;i++){
    botones[i].addEventListener(`click`,function(){
        mensaje.style.display=`flex`;
        datos.textContent=(`¿Está seguro que desea eliminar ${this.value}?`);
        confirmar.href=`php/eliminarProducto.php?codigo=${this.name}`;
    });
}