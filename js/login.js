
document.getElementById("login").addEventListener("submit",function(event) {
    event.preventDefault();


  const User = document.getElementById("usuario").value.trim();
  const password = document.getElementById("senha").value.trim();

  if (User === "MsAdm" && password ==="MS2025@") {

    setTimeout(() => {
        window.location.href ="mercados.html";
    },1000);
  }
})

