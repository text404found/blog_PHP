$('#registerForm').on('submit', (e) => {
    e.preventDefault();
    
    $.post('http://localhost/src/auth/registerAuth.php', $('#registerForm').serialize(), function(data) {
      
    });
})