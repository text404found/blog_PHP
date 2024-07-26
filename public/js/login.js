$("#loginForm").on("submit", (e) => {
  e.preventDefault();
  $.post(
    "http://localhost/src/auth/loginAuth.php",
    $("#loginForm").serialize(),
    function (data) {
      if (data == "Erro") {
        alert("senha ou email incorreto");
      } else {
        $("#pointerText").text("Voce esta logado");
        location.href = data
      }
    }
    
  );
});
