// let loaction = 'http://localhost:8000/vakken';
window.onload = function () {
  const modal = document.getElementById("myModal");
  const popup = document.getElementById("popup");
  const refres = document.getElementById("refresh");
  

refres.onclick = function() {
    location.reload();
}
 
popup.onclick = function() { 
    
    modal.style.display = "flex";
}

btn2.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
if (event.target == modal) {
  modal.style.display = "none";
}}
}
// refresh()

// function sleep(ms) {
//     return new Promise(resolve => setTimeout(resolve, ms));
//   }

// while (true){
//     await sleep(10000);
//     location.reload()
// }
  