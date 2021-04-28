function realizaLogin()
{
    var user = $("#login").val();
    var pass = $("#senha").val();

    console.log(user);

    $.ajax({
        type: 'post',
        dataType:"json",
        url: "http://localhost/admin/index.php/login/realizaLogin",
        data: {
            usuario: user,
            senha: pass
        },
        beforeSend() {

        },
        success: function(data) {
            if(data.status == true){
                alert("Logou");
            }
            else {
                alert("Não logou");
            }
        },
        error: function(erro){
            console.log(erro);
        }
    });
}