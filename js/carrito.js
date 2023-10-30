const listaCantidades=()=>{
    let total=``;
    for(let i=0;i<carrito.length;i++){
        let cantidad=`${carrito[i].value} `;
        total=total+cantidad;
    }
    return total;
}

let botones = document.getElementsByClassName(`botones`);
let carrito = document.getElementsByClassName(`carrito`);
const actualizar=document.getElementById(`actualizar`);
const comprar=document.getElementById(`comprar`);
const nuevo=document.getElementById(`nuevo`);

actualizar.style.cursor=`not-allowed`;
comprar.style.cursor=`not-allowed`;

for(let i=0;i<botones.length;i++){
    botones[i].addEventListener(`click`,function(){
        actualizar.removeAttribute(`disabled`);
        actualizar.style.cursor=`pointer`;
        comprar.style.pointerEvents=`none`;
        comprar.style.cursor=`not-allowed`;
        nuevo.value=listaCantidades();
    });
}