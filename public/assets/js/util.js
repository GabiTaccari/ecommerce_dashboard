const site_url = "http://localhost/admin/";
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

    $("#btn_upload_editar_produto_img").change(function()
    {
        editar_uploadImg($(this), $("#editar_produto_img_path"), $("#editar_cover_image"));
    });

    $("#btn2_upload_editar_produto_img").change(function()
    {
        editar_uploadImg($(this), $("#editar_produto_img_path2"), $("#image2"));
    });

    $("#btn3_upload_editar_produto_img").change(function()
    {
        editar_uploadImg($(this), $("#editar_produto_img_path3"), $("#image3"));
    });

    $("#btn4_upload_editar_produto_img").change(function()
    {
        editar_uploadImg($(this), $("#editar_produto_img_path4"), $("#image4"));
    });

});
    
$("#btn_edit_produto").click(function() 
{
    $("#modal_produto").modal("show");
    $("#produto_img_path").attr("src", "");
    $("#produto_img_path2").attr("src", "");
    $("#produto_img_path3").attr("src", "");
    $("#produto_img_path4").attr("src", "");
    $("#editar_produto_img_path").attr("src", "");
    $("#editar_produto_img_path2").attr("src", "");
    $("#editar_produto_img_path3").attr("src", "");
    $("#editar_produto_img_path4").attr("src", "");
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
                $("#editar_produto_id").val(id);
                $("#editar_produto_name").val(data.nome);
                $("#editar_produto_description").val(data.descricao);
                $("#editar_produto_price").val(data.preco);
                $("#editar_produto_price_cnpj").val(data.preco_cnpj);
                $("#editar_produto_category_id").val(data.categoria);
                $("#editar_produto_status").val(data.status);
                $("#editar_produto_quantidade").val(data.quantidade);
                $("#editar_produto_necessario_cnpj").val(data.necessario_cnpj);
                var caminhoimg = site_url + data.imagem1;
                $("#editar_produto_img_path").attr("src", caminhoimg);
                $("#editar_cover_image").val(caminhoimg);
                if(data.imgs[0]) {
                    $("#editar_produto_img_path2").attr("src", caminhoimg);
                }
                if(data.imgs[1]) {
                    $("#editar_produto_img_path3").attr("src", caminhoimg);
                }
                if(data.imgs[2]) {
                    $("#editar_produto_img_path4").attr("src", caminhoimg);
                }
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
            console.log('erro');
        },
        success: function(data) {
            if(data.status == true){
                $("#modal_categoria").modal("show");
                console.log(data.nome);
                $("#id_editar_categoria").val(data.id);
                $("#name_editar_categoria").val(data.nome);
            }
            else {
                alert("Não logou");
            }
        }
        
    });
}

function uploadImg(input_file, img, input_path)
{
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

function editar_uploadImg(input_file, img, input_path)
{
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
            preco_cnpj: $('input[name="price_cnpj"]').val(),
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

function salvaEditarProduto()
{
    img = ($('input[name="editar_produto_cover-image"]').val());
    $.ajax({
        type: "POST",
        url: site_url + "produto/ajax_edit_produto",
        dataType: "JSON",
        data:{
            id:  $('input[name="editar_produto_id"]').val(),
            nome:  $('input[name="editar_produto_name"]').val(),  //$("#btn_upload_produto_img").val(), //pegar pelo name ->ver exemplo no outro código
            descricao: $('#editar_produto_description').val(),
            preco: $('input[name="editar_produto_price"]').val(),
            preco_cnpj: $('input[name="editar_produto_price_cnpj"]').val(),
            categoria: $('select[name="editar_produto_category_id"]').val(),
            status: $('select[name="editar_produto_status"]').val(),
            quantidade: $('input[name="editar_produto_quantidade"]').val(),
            necessarioCNPJ: $('select[name="editar_produto_necessario_cnpj"]').val(),
            imagem_principal: img,
            imagem2: $('input[name="editar_produto_image2"]').val(),
            imagem3: $('input[name="editar_produto_image3"]').val(),
            imagem4: $('input[name="editar_produto_image4"]').val()
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

function excluirProduto(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "produto/excluirProduto",
        dataType: "JSON",
        data:{
            id:  id
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                alert("Registro excluido");
                window.location.href = site_url + "produto/";
            } else {
                alert("Erro");
            }
        }

    });
}

function excluirCategoria(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "categoria/excluirCategoria",
        dataType: "JSON",
        data:{
            id:  id
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                alert("Registro excluido");
                window.location.href = site_url + "categoria/";
            } else {
                alert("Erro");
            }
        }

    });
}

function atualizaCategoria()
{
    $.ajax({
        type: "POST",
        url: site_url + "categoria/atualizarCategoria",
        dataType: "JSON",
        data:{
            id: $('input[name="id_editar_categoria"]').val(),
            nome: $('input[name="name_editar_categoria"]').val(),
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                alert("Registro atualizado com sucesso");
                window.location.href = site_url + "categoria/";
            } else {
                alert("Erro");
            }
        }

    });
}

function liberarUsuario(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "usuario/liberarUsuario",
        dataType: "JSON",
        data:{
            id: id
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                alert("Registro atualizado com sucesso");
                window.location.href = site_url + "usuario/";
            } else {
                alert("Erro");
            }
        }

    });
}

function liberarUsuario(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "usuario/liberarUsuario",
        dataType: "JSON",
        data:{
            id: id
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                alert("Registro atualizado com sucesso");
                window.location.href = site_url + "usuario/";
            } else {
                alert("Erro");
            }
        }

    });
}

function bloquearUsuario(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "usuario/bloquearUsuario",
        dataType: "JSON",
        data:{
            id: id
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                alert("Registro atualizado com sucesso");
                window.location.href = site_url + "usuario/";
            } else {
                alert("Erro");
            }
        }

    });
}

function editarUsuario(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "usuario/carregarEditaUsuario",
        dataType: "JSON",
        data:{
            id: id
        },
        
        before_send: function()
        {
        },
        success: function(data) 
        {
            if(data.status==true) {
                $("#id_editar_usuario").val(id);
                $("#name_editar_usuario").val(data.nome);
                $("#doc_editar_usuario").val(data.doc);
                $("#tel_editar_usuario").val(data.phone);
                $("#email_editar_usuario").val(data.email);
                $("#senha_editar_usuario").val(data.password);
                $("#permissao_editar_usuario").val(data.roles);

                $("#modal_editar_usuario").modal("show");
            } else {
                alert("Erro");
            }
        }, error: function() {
            console.log(cu);
        }

    });
}

function excluirUsuario(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "usuario/excluirUsuario",
        dataType: "JSON",
        data:{
            id:  id
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                alert("Registro excluido");
                window.location.href = site_url + "usuario/";
            } else {
                alert("Erro");
            }
        }

    });
}

function salvaCodigoRastreamento(id)
{
    $.ajax({
        type: "POST",
        url: site_url + "venda/salvaRastreamento",
        dataType: "JSON",
        data:{
            id:  id,
            codigo: $("#codigo_rastreio").val()
        },
        
        before_send: function()
        {
        },
        success: function(response) 
        {
            if(response.status==true) {
                window.location.href = site_url + "venda/listar?venda="+id;
            } else {
                alert("Erro");
            }
        }

    });
}

