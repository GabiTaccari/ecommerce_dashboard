<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

    public function index()
    {
		$this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("products_model", "produtos");
        $this->load->model("categories_model", "categorias");

        $dados['produtos'] = $this->produtos->get_all_products();
        $dados['categorias'] =$this->categorias->get_all_categories();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_produtos", $dados);
    }

    public function editarProduto()
    {
        $id = $_POST['id'];
        $this->load->model("products_model", "produtos");
		$this->load->model("products_images_model", "imagens");
		$img = $this->imagens->get_all_product_image($id);
        $r = $this->produtos->get_one_product($id);
        echo json_encode(array("status"=>true, "imagem1"=>$r[0]->cover_image, "imgs"=>$img, "nome"=>$r[0]->name, "descricao"=>$r[0]->description, "preco"=>$r[0]->price, "preco_cnpj"=>$r[0]->price_cnpj, "categoria"=>$r[0]->categories_id, "status_produto"=>$r[0]->status, "quantidade"=>$r[0]->quantidade, "necessario_cnpj"=>$r[0]->necessario_cnpj));
        exit();
    }

    public function ajax_import_image()
    {

        if(!$this->input->is_ajax_request()){
            exit("Nenhum acesso de script direto permitido");
        }

		$config["upload_path"] = "./public/produtos/";
		$config["allowed_types"] = "gif|png|jpg";
		$config["overwrite"] = TRUE;

		$this->load->library("upload", $config);

        $json = array();
        $json["status"]=0;

		if(!$this->upload->do_upload("image_file")) {
			$json["status"]=0;
			$json["error"]=$this->upload->display_errors("", "");
		} else {
			if($this->upload->data()["file_size"] <=1024) {
				$file_name = $this->upload->data()["file_name"];
				$json["img_path"] = base_url() . "public/produtos/" . $file_name;
				$json["status"]=1;
			} else {
				$json["status"]=0;
				$json["error"]= "Tamanho máximo suportado: 1MB";
			}
		}

		echo json_encode($json);
	}


	public function ajax_save_produto()
    {

		$this->load->model("products_model", "produtos");
		$this->load->model("products_images_model", "imagens");
		$data["nome"] = $_POST["nome"];
		$data["descricao"] = $_POST["descricao"];
		$data["preco"] = $_POST["preco"];
		$data["preco_cnpj"] = $_POST["preco_cnpj"];
		$data["categoria"] = $_POST["categoria"];
		$data["status"] = $_POST["status"];
		$data["quantidade"] = $_POST["quantidade"];
		$data["necessario_cnpj"] = $_POST["necessarioCNPJ"];
		$data["img"] = $_POST["imagem_principal"];
		$data["img2"] = $_POST["imagem2"];
        $data["img3"] = $_POST["imagem3"];
        $data["img4"] = $_POST["imagem4"];

		$data["img"] = str_replace("http://localhost/admin/",  "", $data["img"]);
		$data["img"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["img"]);
		$data["img"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["img"]);


		$data["img2"] = str_replace("http://localhost/admin/",  "", $data["img2"]);
		$data["img2"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["img2"]);
		$data["img2"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["img2"]);

		$data["img3"] = str_replace("http://localhost/admin/",  "", $data["img3"]);
		$data["img3"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["img3"]);
		$data["img3"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["img3"]);

		$data["img4"] = str_replace("http://localhost/admin/",  "", $data["img4"]);
		$data["img4"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["img4"]);
		$data["img4"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["img4"]);

		if(empty($data["nome"])) {
			echo json_encode(array("status" => false, "msg"=>"O campo nome é obrigatório"));
			exit();
		} else {
			/*if($this->produtos->is_duplicated("name", $data["nome"], $_POST["id"])) {
				echo json_encode(array("status" => false, "msg"=>"Produto ja cadastrado na base de dados"));
				exit();
			}*/
		}

		if(!empty($data["cover_image"])){
			$file_name = basename($data["cover_img"]);
			$old_path = getcwd() . "/public/produtos/".$file_name;
			$new_path = getcwd() . "/public/images/produtos/".$file_name;
			rename($old_path, $new_path);

			$data["cover_img"] = "/public/images/produtos/".$file_name;
		}

		if(empty($_POST["id"])) {
			//insert
			$produto_id = $_POST["id"];
			unset($_POST["id"]);
			$id = $this->produtos->insert($data);

			if(!empty($data["img2"])){
                $dados['produto'] = $id;
				$dados['path']=$data["img2"];
				$this->imagens->insert($dados);
            }

            if(!empty($data["img3"])){
                $dados['produto'] = $id;
                $dados['path']=$data["img3"];
                $this->imagens->insert($dados);
            }

            if(!empty($data["img4"])){
                $dados['produto'] = $id;
                $dados['path']=$data["img4"];
                $this->imagens->insert($dados);
            }


		} else {
			$produto_id = $_POST["id"];
			unset($_POST["id"]);
			$this->produtos->update($produto_id, $data);
		}

		echo json_encode(array("status" => true));

	}

	public function ajax_edit_produto()
	{
		$this->load->model("products_model", "produtos");
		$this->load->model("products_images_model", "imagens");
		$id = $_POST["id"];
		$data["name"] = $_POST["nome"];
		$data["description"] = $_POST["descricao"];
		$data["price"] = $_POST["preco"];
		$data["price_cnpj"] = $_POST["preco_cnpj"];
		$data["categories_id"] = $_POST["categoria"];
		$data["status"] = $_POST["status"];
		$data["quantidade"] = $_POST["quantidade"];
		$data["necessario_cnpj"] = $_POST["necessarioCNPJ"];
		$data["cover_image"] = $_POST["imagem_principal"];

		// $img["img2"] = $_POST["imagem2"];
        // $img["img3"] = $_POST["imagem3"];
        // $img["img4"] = $_POST["imagem4"];

		$data["cover_image"] = str_replace("http://localhost/admin/",  "", $data["cover_image"]);
		$data["cover_image"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["cover_image"]);
		$data["cover_image"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["cover_image"]);


		// $img["img2"] = str_replace("http://localhost/admin/",  "", $data["img2"]);
		// $img["img2"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["img2"]);
		// $img["img2"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["img2"]);

		// $img["img3"] = str_replace("http://localhost/admin/",  "", $data["img3"]);
		// $data["img3"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["img3"]);
		// $data["img3"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["img3"]);

		// $img["img4"] = str_replace("http://localhost/admin/",  "", $data["img4"]);
		// $img["img4"] = str_replace("http://admin.famcosmeticos.com.br/",  "", $data["img4"]);
		// $img["img4"] = str_replace("https://admin.famcosmeticos.com.br/",  "", $data["img4"]);

		

		// if(!empty($data["cover_image"])){
		// 	$file_name = basename($data["cover_image"]);
		// 	$old_path = getcwd() . "/public/produtos/".$file_name;
		// 	$new_path = getcwd() . "/public/images/produtos/".$file_name;
		// 	rename($old_path, $new_path);

		// 	$data["cover_image"] = "/public/produtos/".$file_name;
		// }


		
		$produto_id = $id;
		$this->produtos->update_one_product($produto_id, $data);

		

		echo json_encode(array("status" => true));
	}

	public function excluirProduto()
	{
		$id = $_POST['id'];
		$this->load->model("products_model", "produto");
		if($this->produto->delete_one_product($id)) {
			echo json_encode(array("status" => true));
		}
	}

}