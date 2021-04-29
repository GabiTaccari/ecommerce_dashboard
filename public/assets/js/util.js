const site_url = "http://localhost/admin/index.php/";
$(function(){
    $("#btn_upload_produto_img").change(function()
    {
        uploadImg($(this), $("#produto_img_path"), $("#cover_image"));
    });

    $("#btn2_upload_produto_img").change(function()
    {
        uploadImg($(this), $("#produto_img_path2"), $("#image2"));
    });

    $("#btn3_upload_produto_img").change(function()
    {
        uploadImg($(this), $("#produto_img_path3"), $("#image3"));
    });

    $("#btn4_upload_produto_img").change(function()
    {
        uploadImg($(this), $("#produto_img_path4"), $("#image4"));
    });
});
    
$("#btn_edit_produto").click(function() 
{
    $("#modal_produto").modal("show");
    $("#produto_img_path").attr("src", "");
});

function editarProduto(id)
{
    $.ajax({
        type: 'post',
        dataType:"json",
        url: site_url + "produto/editarProduto",
        data: {
            id: id
        },
        beforeSend() {

        },error: function(erro){
            console.log(erro.statusText);
        },
        success: function(data) {
            if(data.status == true){
                $("#modal_produto").modal("show");
                console.log(data.nome);
                $("#name").val(data.nome);
                $("#description").val(data.descricao);
                $("#price").val(data.preco);
                $("#category_id").val(data.categoria);
                $("#status").val(data.status);
                $("#quantidade").val(data.quantidade);
                $("#necessario_cnpj").val(data.necessario_cnpj);
            }
            else {
                alert("Não logou");
            }
        }
        
    });
}

function editarCategoria(id)
{
    $.ajax({
        type: 'post',
        dataType:"json",
        url: site_url + "categoria/editarCategoria",
        data: {
            id: id
        },
        beforeSend() {

        },error: function(erro){
            console.log(erro.statusText);
        },
        success: function(data) {
            if(data.status == true){
                $("#modal_categoria").modal("show");
                console.log(data.nome);
                $("#name_categoria").val(data.nome);
            }
            else {
                alert("Não logou");
            }
        }
        
    });
}

function uploadImg(input_file, img, input_path){
    src_before = img.attr("src");
    img_file = input_file[0].files[0];
    form_data = new FormData();

    form_data.append("image_file", img_file);

    $.ajax({
        url: site_url + "produto/ajax_import_image",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post",
        before_send: function(){
        },
        success: function(response) {

            if(response["status"]==1) {
                img.attr("src", response["img_path"]);
                input_path.val(response["img_path"]);
            } else {
                img.attr("src", src_before);
                input_path.siblings(".help-block").html(response["error"]);
            }
        }, error: function() {
            img.attr("src", src_before);
        }
    })

}

function salvaProduto() 
{
    $.ajax({
        type: "POST",
        url: site_url + "produto/ajax_save_produto",
        dataType: "JSON",
        data:{
            nome:  $('input[name="name"]').val(),  //$("#btn_upload_produto_img").val(), //pegar pelo name ->ver exemplo no outro código
            descricao: $('#description').val(),
            preco: $('input[name="price"]').val(),
            categoria: $('select[name="category_id"]').val(),
            status: $('select[name="status"]').val(),
            quantidade: $('input[name="quantidade"]').val(),
            necessarioCNPJ: $('select[name="necessario_cnpj"]').val(),
            imagem_principal: $('input[name="cover-image"]').val(),
            imagem2: $('input[name="image2"]').val(),
            imagem3: $('input[name="image3"]').val(),
            imagem4: $('input[name="image4"]').val(),
            id:$('input[name="id"]').val()
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                $("#modal_novo_produto").modal("hide");
                alert("OK");
            } else {
                alert("Erro");
            }
        }

    });
}

function salvaCategoria() 
{
    console.log($('input[name="name_categoria"]').val());
    $.ajax({
        type: "POST",
        url: site_url + "categoria/ajax_save_categoria",
        dataType: "JSON",
        data:{
            nome:  $('input[name="name_categoria"]').val()
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                $("#modal_nova_categoria").modal("hide");
                alert("OK");
            } else {
                alert("Erro");
            }
        }

    });
}


