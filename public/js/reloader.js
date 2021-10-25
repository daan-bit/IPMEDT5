function newTijd(){
  const status = document.getElementById("js--aanwezig");

  const BASE_URL = "/api/aanwezig";

  fetch(BASE_URL) 
    .then(response => response.json())

    .then(data => status.innerHTML = data.aanwezig);
}

  

  
  