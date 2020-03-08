<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //Define que o arquivo n?o tem acesso direto via navegador

class Gupy extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); //Carrega o helper de url(link)
		$this->load->helper('form'); //Carrega o helper de formul?rio
		$this->load->helper('array'); //Carrega o helper array
		$this->load->helper('encode');
		$this->load->library('table'); // Carrega a bibioteca de tabela

		$this->load->library('form_validation'); //Carrega a biblioteca de valida??o de formul?rio
		$this->load->model('gupy_model'); //Carrega o model		
		//Limpa o cache, não permitindo ao usuário visualizar nenhuma página logo depois de ter feito logout do sistema
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		session_start();
	}
	public function index()
	{
		$this->load->view('index.html');
	}

	#
	#Login
	#
	public function main()
	{
		if (empty($_SESSION['user_tipo'])) {
			redirect("/..");
		} else if ($_SESSION['user_tipo'] == 1) {
			$dados['tipos_produtos'] = $this->gupy_model->get_tipos_produtos();
			$this->load->view('lojas_ativas.php', $dados);
		} else {
			$this->load->view('empresa_overview.php');
		}
	}

	public function ajax_get_user_data()
	{
		$telefone = $this->input->get('telefone');
		$senha = $this->input->get('senha');
		$registros = $this->gupy_model->get_user_data($telefone, $senha);

		if (!empty($registros)) {
			$_SESSION['user_id'] = $registros['CODIGO'];
			$_SESSION['user_tipo'] = $registros['CODIGO_TIPO_USUARIO'];
			$_SESSION['user_name'] = $registros['NOME'];
			if ($_SESSION['user_tipo'] == 2) {
				$_SESSION['codigo_empresa'] = $this->gupy_model->get_codigo_empresa($_SESSION['user_id']);
			}
		}

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_api_login()
	{
		$nome = $this->input->get('nome');
		$email = $this->input->get('email');
		$api = $this->input->get('api');

		$registros = $this->gupy_model->get_user_data_by_api($email);

		if (!empty($registros)) {
			$_SESSION['user_id'] = $registros['CODIGO'];
			$_SESSION['user_tipo'] = $registros['CODIGO_TIPO_USUARIO'];
			$_SESSION['user_name'] = $registros['NOME'];
			if ($_SESSION['user_tipo'] == 2) {
				$_SESSION['codigo_empresa'] = $this->gupy_model->get_codigo_empresa($_SESSION['user_id']);
			}
		}
		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function recuperarSenha()
    {
        $this->load->view('recuperar_senha');
    }

    public function ajax_recuperar_senha()
    {
        $email = $this->input->post('email');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){

            $result = $this->gupy_model->verify_email($email);

           echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }

        //        if (filter_var($email, FILTER_VALIDATE_EMAIL))
//        {
//
//            $mensagem = 'Recebemos um pedido para redefinir sua senha';
//
//            $mensagem += 'Use o link abaixo para cadastrar uma nova senha para sua conta.';
//
//            $mensagem +=  base_url().'gupy/alterarSenha/'.base64_encode($email) ;
//
//            $mensagem += " Se você não solicitou a troca da senha, ignore este email e o link irá expirar por ele mesmo.";
//
//            $mensagem += "Este email foi enviado para ";
//
//            $mensagem += $email;
//
//            $mensagem += "TROCAR SENHA";
//
//            print_r($mensagem);exit;
//            $assunto = "Recuperação de Senha";
//
//            $headers = 'From: danielvictormiquiles@gmail.com';
//
//            mail($email, $assunto, $mensagem, $headers);
//        }
    }

    public function alterarSenha($id)
    {
        $dados['id'] = $id;
	    $this->load->view('alterar_senha', $dados);
    }

    public function ajax_alterar_senha ()
    {
        $nova_senha = $this->input->post('nova_senha');
        $user = $this->input->post('user');

        $result = $this->gupy_model->ajax_alterar_senha($user,$nova_senha);

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

	#
	#Cadastro
	#
	public function cadastro($codigo_patrocinador = null)
	{

		if ($codigo_patrocinador) {
			$codigo_patrocinador = voucher_base64_decode($codigo_patrocinador);
			$dados['patrocinador'] = $this->gupy_model->get_patrocinador($codigo_patrocinador);
		} else {
			$dados['patrocinador']['CODIGO'] = 0;
		}

		$this->load->view('cadastro_view', $dados);
	}

	public function ajax_cadastro()
	{
		$dados_usuario = $this->input->get();

		$cadastrado = $this->gupy_model->verify_email($dados_usuario['email']);

		if (empty($cadastrado)) {
			$dados_usuario['status'] = $dados_usuario['tipoUsuario'] == 1 ? 1 : 2;
			$usuario = $this->gupy_model->cadastrar_usuario($dados_usuario);
			if ($usuario) {
				$_SESSION['user_id'] = $usuario;
				$_SESSION['user_tipo'] = 1;
				$_SESSION['user_name'] = $dados_usuario['nome'];
			}
		}
		if ($dados_usuario['tipoUsuario'] == 2 || empty($usuario)) {
			$usuario = false;
		}

		echo json_encode(array('cadastrado' => $cadastrado, 'usuario' => $usuario), JSON_UNESCAPED_UNICODE);
	}
	#
	#############Usuários
	#
	public function manage_vouchers()
	{
		if (empty($_SESSION['user_tipo'])) {
			redirect("/..");
		}
		// $dados['vouchers'] = $this->gupy_model->get_user_vouchers();
		$this->load->view('gerenciar_vouchers_user');
	}

	public function ajax_get_user_transactions()
	{
		$status = $this->input->get('status');
		$registros = $this->gupy_model->get_user_vouchers($status);
		
		
		foreach ($registros as $key => $value) {
			$registros[$key]['id_voucher_cript'] = voucher_base64_encode($registros[$key]['id_voucher']);
		}
		//print_r($registros);exit;
		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_dados_transacao_user()
	{
		$voucher_id = $this->input->get('voucher_id');
		$status = $this->input->get('status');

		$registros = $this->gupy_model->get_user_vouchers($status,$voucher_id);
		$registros = current($registros);
		$registros['voucher_code'] = voucher_base64_encode($registros['id_voucher']);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}
	
	public function ajax_get_user_transacao_by_nome_loja()
	{
		$status = $this->input->get('status');
		$nome = $this->input->get('nome');

		$registros = $this->gupy_model->get_user_vouchers_by_company_name($status,$nome);
		//$registros = current($registros);
		foreach ($registros as $key => $value) {
			$registros[$key]['id_voucher_cript'] = voucher_base64_encode($registros[$key]['id_voucher']);
		}

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}
	
	#
	#Código
	#
	public function codigo()
	{
		if (empty($_SESSION['user_tipo'])) {
			redirect("/..");
		}
		$dados['codigo'] = voucher_base64_encode($_SESSION['user_id']);
		$this->load->view('codigo_view', $dados);
	}
	#
	#Listagem de Produtos
	#
	public function ajax_get_listar_produtos()
	{
		$loja_id = $this->input->get('loja_id');
		$registros['produtos'] = $this->gupy_model->get_listar_produto($loja_id);

		$registros['favorita'] = $this->gupy_model->get_lojas_favoritas($_SESSION['user_id'], $loja_id);
		if (!$registros['favorita']) {
			$registros['favorita'] = false;
		}
		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_produto_by_nome()
	{
		$nome = $this->input->get('nome');
		$loja_id = $this->input->get('loja_id');
		$registros = $this->gupy_model->get_listar_produto($loja_id, $nome);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_usuario_favoritar_loja()
	{
		$usuario_id = $this->input->get('usuario_id');
		$loja_id = $this->input->get('loja_id');
		$registros = $this->gupy_model->usuario_favoritar_loja($loja_id, $usuario_id);
		if ($registros) {
			$this->gupy_model->update_numero_favoritos_loja($loja_id, 1);
		}
		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_usuario_desfavoritar_loja()
	{
		$usuario_id = $this->input->get('usuario_id');
		$loja_id = $this->input->get('loja_id');
		$registros = $this->gupy_model->usuario_desfavoritar_loja($loja_id, $usuario_id);

		if ($registros) {
			$this->gupy_model->update_numero_favoritos_loja($loja_id, -1);
		}

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function listar_produtos($loja_id)
	{
		if (empty($_SESSION['user_tipo'])) {
			redirect("/..");
		}
		$dados['loja_id'] = $loja_id;
		$this->load->view('listagem_produtos', $dados);
	}
	#
	#Listagem de Lojas
	#
	public function ajax_get_listar_lojas_ativas()
	{

		$registros = $this->gupy_model->get_listar_lojas();

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_lojas_favoritas_usuario()
	{

		$registros = $this->gupy_model->get_lojas_favoritas($_SESSION['user_id']);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_lojas_populares()
	{

		$registros = $this->gupy_model->get_lojas_populares();

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_loja_by_nome()
	{
		$nome = $this->input->get('nome');

		$registros = $this->gupy_model->get_listar_lojas($nome);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_loja_by_tipo()
	{
		$tipo_id = $this->input->get('tipo_id');

		$registros = $this->gupy_model->get_listar_lojas_by_tipo($tipo_id);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	/*public function ajax_get_produtos_descontos(){

		$registros=$this->gupy_model->get_listar_lojas_by_desconto();
		
		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}*/

	#
	#Tela de Produto
	#
	public function produto_view($produto_id, $loja_id)
	{
		if (empty($_SESSION['user_tipo'])) {
			redirect("/..");
		}
		$dados['produto_id'] = $produto_id;
		$dados['loja_id'] = $loja_id;
		$this->load->view('produto_view', $dados);
	}

	public function ajax_get_produto()
	{
		$produto_id = $this->input->get('produto_id');
		$registros = $this->gupy_model->get_produto($produto_id);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_gerar_voucher()
	{
		$produto_id = $this->input->get('produto_id');
		$valor_produto = $this->input->get('valor_produto');
		$loja_id = $this->input->get('loja_id');
		$usuario_id = $this->input->get('usuario_id');
		$registros = $this->gupy_model->gerar_voucher($valor_produto, $produto_id, $loja_id, $usuario_id);


		$this->gupy_model->inserir_voucher_venda($registros);
		$registros = voucher_base64_encode($registros);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	#
	#Empresa
	#

	public function ajax_get_produtos_ativos_editar()
	{


		$registros = $this->gupy_model->get_listar_produto($_SESSION['codigo_empresa']);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_desabilitar_itens()
	{
		$id_item = $this->input->get('id_item');

		$registros = $this->gupy_model->desabilitar_itens($id_item);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_habilitar_itens()
	{
		$id_item = $this->input->get('id_item');

		$registros = $this->gupy_model->habilitar_itens($id_item);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_produtos_inativos_editar()
	{

		$registros = $this->gupy_model->get_listar_produto($_SESSION['codigo_empresa'], '', 2);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function cadastarProduto()
	{
		if (empty($_SESSION['user_tipo'])) {
			redirect("/..");
		} else if ($_SESSION['user_tipo'] != 2) {
			redirect("/..");
		}
		$dados['categoria_produto'] = $this->gupy_model->get_categorias_produtos();
		$this->load->view('cadastar_produto', $dados);
	}

	public function ajax_cadastrar_produto()
	{
		$dados_produto = $this->input->get();

		$registros = $this->gupy_model->cadastrar_produto($dados_produto);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function upload_imagem()
	{

		$filename = basename($_FILES["imagem_produto"]["name"]);

		$targetPath = './imagens/' . $_FILES['imagem_produto']['name'];
		move_uploaded_file($_FILES["imagem_produto"]["tmp_name"], $targetPath);

		$this->gupy_model->set_img_path($filename);
		$this->load->view('empresa_overview.php');
	}

	###gerenciamento de loja###

	public function gerenciarVendas()
	{

		if (empty($_SESSION['user_tipo'])) {
			redirect("/..");
		} else if ($_SESSION['user_tipo'] != 2) {
			redirect("/..");
		}

		$this->load->view('gerenciar_vendas');
	}

	public function ajax_get_transacoes()
	{
		$status = $this->input->get('status');
		$registros = $this->gupy_model->get_transacoes($status);
		foreach ($registros as $key => $value) {
			$registros[$key]['id_voucher_cript'] = voucher_base64_encode($registros[$key]['id_voucher']);
		}

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_fechar_transacao()
	{
		$voucher_id = $this->input->get('voucher_id');
		$status = $this->input->get('status');
		$registros = $this->gupy_model->fechar_transacao($voucher_id, $status);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_dados_transacao()
	{
		$voucher_id = $this->input->get('voucher_id');

		$registros = $this->gupy_model->get_dados_transacao($voucher_id);
		$registros['voucher_code'] = voucher_base64_encode($registros['id_voucher']);

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_transacao_by_nome()
	{
		$nome = $this->input->get('nome');
		$status = $this->input->get('status');

		$registros = $this->gupy_model->get_transacoes($status, $nome);
		foreach ($registros as $key => $value) {
			$registros[$key]['id_voucher_cript'] = voucher_base64_encode($registros[$key]['id_voucher']);
		}

		echo json_encode($registros, JSON_UNESCAPED_UNICODE);
	}
}
