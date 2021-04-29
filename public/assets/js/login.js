function realizaLogin()
{
    var user = $("#login").val();
    var pass = $("#senha").val();


    $.ajax({
        type: 'post',
        dataType:"json",
        url: site_url + "login/realizaLogin",
        data: {
            usuario: user,
            senha: pass
        },
        beforeSend() {

        },
        success: function(data) {
            if(data.status == true){
                alert("Logou");
                console.log(site_url);
                window.location.href = site_url;
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