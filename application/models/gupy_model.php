<?php
class Gupy_model extends CI_Model
{
	//Trata os caracteres para utf-8, tanto os de entrada como os de saída de dados.
	function __construct()
	{
		$this->db->query("SET NAMES 'utf8'");
	}

	#
	#Login
	#
	public function get_user_data($telefone = null, $senha = null)
	{


		$stmt = $this->db->prepare("SELECT CODIGO,CODIGO_TIPO_USUARIO,NOME FROM usuario where TELEFONE = :TELEFONE and SENHA = :SENHA");

		$stmt->bindValue(':TELEFONE', $telefone, PDO::PARAM_STR);
		$stmt->bindValue(':SENHA', $senha, PDO::PARAM_STR);

		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}

	#
	public function get_user_data_by_api($email = null)
	{


		$stmt = $this->db->prepare("SELECT CODIGO,CODIGO_TIPO_USUARIO,NOME,TELEFONE FROM usuario where EMAIL = :EMAIL");

		$stmt->bindValue(':EMAIL', $email, PDO::PARAM_STR);

		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}



	#
	#Cadastro
	#
	public function get_patrocinador($codigo_patrocinador)
	{


		$stmt = $this->db->prepare("SELECT CODIGO,CODIGO_TIPO_USUARIO,NOME FROM usuario where CODIGO = :CODIGO_PATROCINADOR");

		$stmt->bindValue(':CODIGO_PATROCINADOR', $codigo_patrocinador, PDO::PARAM_STR);

		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function ajax_alterar_senha($user, $senha)
	{
		$stmt = $this->db->prepare("UPDATE usuario SET SENHA = :SENHA WHERE CODIGO = :ID");

		$stmt->bindValue(':ID', $user, PDO::PARAM_INT);
		$stmt->bindValue(':SENHA', $senha, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function verify_email($email = null)
	{


		$stmt = $this->db->prepare("SELECT CODIGO FROM usuario where email = :EMAIL");

		$stmt->bindValue(':EMAIL', $email, PDO::PARAM_STR);

		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function cadastrar_usuario($dados)
	{

		$stmt = $this->db->prepare("INSERT INTO usuario (EMAIL,NOME,TELEFONE,ENDERECO,SENHA,CODIGO_TIPO_USUARIO,CODIGO_PATROCINADOR,DATA_CADASTRO,CODIGO_STATUS) VALUES (:EMAIL,:NOME,:TELEFONE,:ENDERECO,:SENHA,:CODIGO_TIPO_USUARIO,:CODIGO_PATROCINADOR,:DATA_CADASTRO,:CODIGO_STATUS)");

		$stmt->bindValue(':NOME', element('nome', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':EMAIL', element('email', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':SENHA', element('senha', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':TELEFONE', element('telefone', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':ENDERECO', element('endereco', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_TIPO_USUARIO', element('tipoUsuario', $dados), PDO::PARAM_INT);
		$stmt->bindValue(':CODIGO_PATROCINADOR', element('patrocinador', $dados), PDO::PARAM_INT);
		$stmt->bindValue(':DATA_CADASTRO', date('Y-m-d H:i'), PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_STATUS', element('status', $dados), PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
			if ($stmt2->execute()) {
				$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);
				return $resultado['ID'];
			} else {
				return false;
			}
		}
	}

	public function sign_up_by_api($nome, $email)
	{

		$stmt = $this->db->prepare("INSERT INTO usuario (EMAIL,NOME,CODIGO_TIPO_USUARIO,DATA_CADASTRO,CODIGO_STATUS) VALUES (:EMAIL,:NOME,:CODIGO_TIPO_USUARIO,:DATA_CADASTRO,:CODIGO_STATUS)");

		$stmt->bindValue(':NOME', $nome, PDO::PARAM_STR);
		$stmt->bindValue(':EMAIL', $email, PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_TIPO_USUARIO', 1, PDO::PARAM_INT);
		$stmt->bindValue(':DATA_CADASTRO', date('Y-m-d H:i'), PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_STATUS', 1, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
			if ($stmt2->execute()) {
				$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);
				return $resultado['ID'];
			} else {
				return false;
			}
		}
	}

	public function add_phone($telefone)
	{

		$stmt = $this->db->prepare("UPDATE usuario SET TELEFONE = :TELEFONE WHERE CODIGO =:ID_ITEM");

		$stmt->bindParam(':TELEFONE', $telefone, PDO::PARAM_STR);
		$stmt->bindParam(':ID_ITEM', $_SESSION['user_id'], PDO::PARAM_INT);


		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserById($id)
	{

		$stmt = $this->db->prepare("SELECT * FROM usuario where CODIGO = :ID");
		$stmt->bindParam(':ID', $id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function update_cadastro($dados)
	{

		$stmt = $this->db->prepare("UPDATE usuario SET NOME = :NOME, EMAIL = :EMAIL, TELEFONE = :TELEFONE WHERE CODIGO =:ID_ITEM");

		$stmt->bindParam(':NOME', $dados['nome'], PDO::PARAM_STR);
		$stmt->bindParam(':EMAIL', $dados['email'], PDO::PARAM_STR);
		$stmt->bindParam(':TELEFONE', $dados['telefone'], PDO::PARAM_STR);
		$stmt->bindParam(':ID_ITEM', $_SESSION['user_id'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	#
	#Listagem de Produtos
	#

	public function get_listar_produto($loja_id, $nome = null, $status = 1)
	{
		$stmt = $this->db->prepare("SELECT CODIGO as id,IMAGEM as img,PRECO_ATUAL as preco,PRECO_ORIGINAL as preco_inicial ,NOME as nome,STATUS FROM produtos where STATUS = :STATUS and CODIGO_LOJA = :LOJA_ID and NOME like :NOME order by NOME");
		$nome = '%' . $nome . '%';
		$stmt->bindParam(':NOME', $nome, PDO::PARAM_STR);
		$stmt->bindParam(':LOJA_ID', $loja_id, PDO::PARAM_INT);
		$stmt->bindParam(':STATUS', $status, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function desabilitar_itens($id_item)
	{
		$stmt = $this->db->prepare("UPDATE produtos SET STATUS =2 WHERE CODIGO =:ID_ITEM");

		$stmt->bindParam(':ID_ITEM', $id_item, PDO::PARAM_INT);


		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function habilitar_itens($id_item)
	{
		$stmt = $this->db->prepare("UPDATE produtos SET STATUS =1 WHERE CODIGO =:ID_ITEM");

		$stmt->bindParam(':ID_ITEM', $id_item, PDO::PARAM_INT);


		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function get_lojas_favoritas($usuario_id = null, $loja_id = null)
	{
		if (!empty($loja_id)) {
			$loja_id = "AND usuario_favorito.loja_id =" . $loja_id;
		} else {
			$loja_id = "";
		}

		$stmt = $this->db->prepare("SELECT lojas.CODIGO as id,lojas.IMAGEM as img FROM lojas 
		JOIN usuario_favorito on usuario_favorito.loja_id = lojas.CODIGO
		where lojas.STATUS = '1' AND usuario_favorito.usuario_id = :USUARIO_ID  " . $loja_id . " ORDER BY lojas.NOME");

		$stmt->bindParam(':USUARIO_ID', $usuario_id, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function get_lojas_populares()
	{

		$stmt = $this->db->prepare("SELECT lojas.CODIGO as id,lojas.IMAGEM as img  FROM lojas
		left join produtos on produtos.CODIGO_LOJA = lojas.CODIGO
		where lojas.STATUS = '1' GROUP by lojas.CODIGO ORDER BY lojas.FAVORITA desc");

		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function usuario_favoritar_loja($loja_id, $usuario_id)
	{
		$stmt = $this->db->prepare("INSERT INTO usuario_favorito(usuario_id,loja_id) VALUES (:USUARIO_ID,:LOJA_ID)");

		$stmt->bindParam(':LOJA_ID', $loja_id, PDO::PARAM_INT);
		$stmt->bindParam(':USUARIO_ID', $usuario_id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
			if ($stmt2->execute()) {
				$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);
				return $resultado['ID'];
			} else {
				return false;
			}
		}
	}

	public function update_numero_favoritos_loja($loja_id, $valor)
	{
		$stmt = $this->db->prepare("UPDATE lojas SET FAVORITA = FAVORITA+:VALOR WHERE CODIGO =:LOJA_ID");

		$stmt->bindParam(':LOJA_ID', $loja_id, PDO::PARAM_INT);
		$stmt->bindParam(':VALOR', $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function usuario_desfavoritar_loja($loja_id, $usuario_id)
	{
		$stmt = $this->db->prepare("DELETE FROM usuario_favorito WHERE loja_id = :LOJA_ID and usuario_id = :USUARIO_ID");

		$stmt->bindParam(':USUARIO_ID', $usuario_id, PDO::PARAM_INT);
		$stmt->bindParam(':LOJA_ID', $loja_id, PDO::PARAM_INT);


		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	#
	#Listagem de Lojas
	#

	public function get_listar_lojas($nome = null)
	{
		//$stmt = $this->db->prepare("SELECT CODIGO as id,IMAGEM as img FROM lojas where STATUS = '1' and NOME like :NOME order by NOME");
		$stmt = $this->db->prepare("SELECT lojas.CODIGO as id,lojas.IMAGEM as img FROM lojas 
		left join produtos on produtos.CODIGO_LOJA = lojas.CODIGO
		where lojas.STATUS = '1' and lojas.NOME like :NOME and produtos.STATUS = 1 GROUP by id order by lojas.NOME");
		$nome = '%' . $nome . '%';
		$stmt->bindParam(':NOME', $nome, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function get_listar_lojas_by_tipo($tipo_id = null)
	{
		$stmt = $this->db->prepare("SELECT DISTINCT lojas.CODIGO as id,lojas.IMAGEM as img FROM lojas 
		join produtos on produtos.CODIGO_LOJA = lojas.CODIGO
		where lojas.STATUS = '1' and produtos.STATUS = 1 and produtos.CODIGO_CATEGORIA = :TIPO_ID");
		$stmt->bindParam(':TIPO_ID', $tipo_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	/*public function get_listar_lojas_by_desconto()
	{
		$stmt = $this->db->prepare("SELECT DISTINCT lojas.CODIGO as id,lojas.IMAGEM as img FROM lojas 
		join produtos on produtos.CODIGO_LOJA = lojas.CODIGO
		where lojas.STATUS = '1' and produtos.CODIGO_CATEGORIA = :TIPO_ID ORDER BY lojas.NOME");
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}*/

	public function get_tipos_produtos()
	{
		$stmt = $this->db->prepare("SELECT id,descricao FROM categoria_produto order by descricao");
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}



	#
	#Tela de Produto
	#

	public function get_produto($produto_id)
	{
		$stmt = $this->db->prepare("SELECT * FROM produtos where STATUS = 1 and CODIGO = :PRODUTO_ID order by NOME");
		$stmt->bindParam(':PRODUTO_ID', $produto_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function gerar_voucher($valor, $loja_id, $usuario_id)
	{
		$stmt = $this->db->prepare("INSERT INTO historico_transacoes_usuario(CODIGO_USUARIO,CODIGO_LOJA,VALOR) VALUES (:USUARIO_ID,:LOJA_ID,:VALOR)");
		$stmt->bindParam(':LOJA_ID', $loja_id, PDO::PARAM_INT);
		$stmt->bindParam(':USUARIO_ID', $usuario_id, PDO::PARAM_INT);
		$stmt->bindParam(':VALOR', $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
			if ($stmt2->execute()) {
				$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);
				return $resultado['ID'];
			} else {
				return false;
			}
		}
	}

	public function produtos_transacao($transacao_id, $produto_id, $quantidade, $valor_produto)
	{
		$stmt = $this->db->prepare("INSERT INTO produtos_transacao(historico_transacao_usuario_id,produto_id,quantidade,valor_produto) VALUES (:TRANSACAO_ID,:PRODUTO_ID,:QUANTIDADE,:VALOR_PRODUTO)");
		$stmt->bindParam(':TRANSACAO_ID', $transacao_id, PDO::PARAM_INT);
		$stmt->bindParam(':PRODUTO_ID', $produto_id, PDO::PARAM_INT);
		$stmt->bindParam(':QUANTIDADE', $quantidade, PDO::PARAM_INT);
		$stmt->bindParam(':VALOR_PRODUTO', $valor_produto, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function inserir_voucher_venda($id_transacao)
	{
		$voucher = voucher_base64_encode($id_transacao);
		$stmt = $this->db->prepare("UPDATE historico_transacoes_usuario SET VOUCHER = :VOUCHER WHERE CODIGO =:PRODUTO_ID");

		$stmt->bindParam(':PRODUTO_ID', $id_transacao, PDO::PARAM_INT);
		$stmt->bindParam(':VOUCHER', $voucher, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	#
	#Empresa
	#
	public function get_codigo_empresa($user_id)
	{
		$stmt = $this->db->prepare("SELECT * FROM usuario_lojas where CODIGO_USUARIO = :USER_ID");
		$stmt->bindParam(':USER_ID', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado['CODIGO_LOJA'];
	}

	public function get_categorias_produtos()
	{
		$stmt = $this->db->prepare("SELECT * FROM categoria_produto order by descricao");

		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function cadastrar_produto($dados)
	{

		$stmt = $this->db->prepare("INSERT INTO produtos (DATA_POSTAGEM,CODIGO_USUARIO,CODIGO_LOJA,CODIGO_CATEGORIA,NOME,DESCRICAO,PRECO_ATUAL,IMAGEM,TOTAL_ESTOQUE,PRECO_ORIGINAL) VALUES (:DATA_POSTAGEM,:CODIGO_USUARIO,:CODIGO_LOJA,:CODIGO_CATEGORIA,:NOME,:DESCRICAO,:PRECO_ATUAL,:IMAGEM,:TOTAL_ESTOQUE,:PRECO_ORIGINAL)");

		$stmt->bindValue(':DATA_POSTAGEM', date('Y-m-d H:i'), PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_USUARIO', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->bindValue(':CODIGO_LOJA', $_SESSION['codigo_empresa'], PDO::PARAM_INT);
		$stmt->bindValue(':CODIGO_CATEGORIA', element('categoria', $dados), PDO::PARAM_INT);
		$stmt->bindValue(':NOME', element('nome', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':DESCRICAO', element('descricao', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':PRECO_ATUAL', element('preco', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':PRECO_ORIGINAL', element('preco_inicial', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':IMAGEM', element('imagem', $dados), PDO::PARAM_STR);

		$stmt->bindValue(':TOTAL_ESTOQUE', element('estoque', $dados), PDO::PARAM_INT);
		//	$stmt->execute();
		//print_r($stmt->errorInfo());exit;
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function set_img_path($img_path)
	{

		$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
		if ($stmt2->execute()) {
			$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);
		}
		$stmt = $this->db->prepare("UPDATE produtos SET IMAGEM=:IMAGEM where CODIGO = :ID");

		$stmt->bindValue(':IMAGEM', $img_path, PDO::PARAM_STR);
		$stmt->bindValue(':ID', $resultado['ID'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function get_product_info($produto_id)
	{

		$stmt = $this->db->prepare("SELECT * FROM `produtos` WHERE produtos.CODIGO = :PRODUTO_ID");
		$stmt->bindParam(':PRODUTO_ID', $produto_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function editar_produto($dados)
	{
		$stmt = $this->db->prepare("UPDATE produtos SET NOME=:NOME,CODIGO_CATEGORIA=:CODIGO_CATEGORIA,DESCRICAO=:DESCRICAO,PRECO_ATUAL=:PRECO_ATUAL,TOTAL_ESTOQUE=:TOTAL_ESTOQUE,PRECO_ORIGINAL=:PRECO_ORIGINAL where CODIGO = :ID");

		$stmt->bindValue(':CODIGO_CATEGORIA', element('categoria', $dados), PDO::PARAM_INT);
		$stmt->bindValue(':NOME', element('nome', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':DESCRICAO', element('descricao', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':PRECO_ATUAL', element('preco', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':PRECO_ORIGINAL', element('preco_inicial', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':TOTAL_ESTOQUE', element('estoque', $dados), PDO::PARAM_INT);
		$stmt->bindValue(':ID', element('id', $dados), PDO::PARAM_INT);
		//	$stmt->execute();
		//print_r($stmt->errorInfo());exit;
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	###gerenciamento de transações###
	public function get_transacoes($status, $nome = null)
	{
		$stmt = $this->db->prepare("SELECT historico_transacoes_usuario.CODIGO AS id_voucher, usuario.NOME as nome, historico_transacoes_usuario.DATA_TRANSACAO as data_compra ,historico_transacoes_usuario.STATUS as status_voucher from historico_transacoes_usuario
		join usuario on usuario.CODIGO = historico_transacoes_usuario.CODIGO_USUARIO
			where historico_transacoes_usuario.STATUS = :STATUS and historico_transacoes_usuario.CODIGO_LOJA = :USER_ID AND (usuario.NOME like :NOME or historico_transacoes_usuario.VOUCHER like :NOME)  order by historico_transacoes_usuario.CODIGO");
		$nome = '%' . $nome . '%';
		$stmt->bindParam(':USER_ID', $_SESSION['codigo_empresa'], PDO::PARAM_INT);
		$stmt->bindParam(':STATUS', $status, PDO::PARAM_INT);
		$stmt->bindParam(':NOME', $nome, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function fechar_transacao($voucher_id, $status)
	{
		$stmt = $this->db->prepare("UPDATE historico_transacoes_usuario SET STATUS = :STATUS, DATA_CONCLUSAO = CURRENT_TIME() WHERE CODIGO =:VOUCHER_ID");

		$stmt->bindParam(':VOUCHER_ID', $voucher_id, PDO::PARAM_INT);
		$stmt->bindParam(':STATUS', $status, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function get_dados_transacao($voucher_id)
	{
		$stmt = $this->db->prepare("SELECT historico_transacoes_usuario.CODIGO AS id_voucher, historico_transacoes_usuario.STATUS as status_voucher, usuario.endereco,usuario.NOME, usuario.TELEFONE from historico_transacoes_usuario
			-- join produtos on produtos.CODIGO = historico_transacoes_usuario.CODIGO_PRODUTO
            join usuario on historico_transacoes_usuario.CODIGO_USUARIO = usuario.CODIGO
			where historico_transacoes_usuario.CODIGO = :VOUCHER_ID ");
		//$stmt->bindParam(':USER_ID', $_SESSION['codigo_empresa'], PDO::PARAM_INT);
		$stmt->bindParam(':VOUCHER_ID', $voucher_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}
	
	public function get_itens_transacao($voucher_id)
	{
		$stmt = $this->db->prepare("select produtos.NOME as nome_produto, produtos_transacao.valor_produto as valor_unidade, produtos_transacao.quantidade from produtos_transacao
		JOIN produtos on produtos.CODIGO = produtos_transacao.produto_id
		JOIN historico_transacoes_usuario on historico_transacoes_usuario.CODIGO = produtos_transacao.historico_transacao_usuario_id
			where historico_transacoes_usuario.CODIGO = :VOUCHER_ID ");
		//$stmt->bindParam(':USER_ID', $_SESSION['codigo_empresa'], PDO::PARAM_INT);
		$stmt->bindParam(':VOUCHER_ID', $voucher_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);

		return $resultado;
	}

	#
	###Usuários
	#

	public function get_user_vouchers($status, $voucher_id = '')
	{

		if ($voucher_id) {
			$voucher = "and historico_transacoes_usuario.CODIGO = " . $voucher_id;
		} else {
			$voucher = '';
		}

		$stmt = $this->db->prepare("SELECT historico_transacoes_usuario.CODIGO AS id_voucher,historico_transacoes_usuario.DATA_TRANSACAO as data_compra , historico_transacoes_usuario.STATUS, lojas.NOME as nome_loja from historico_transacoes_usuario
        join usuario on usuario.CODIGO = historico_transacoes_usuario.CODIGO_USUARIO
        join lojas on lojas.CODIGO = historico_transacoes_usuario.CODIGO_LOJA
		where historico_transacoes_usuario.STATUS = :STATUS and usuario.CODIGO = :USER_ID " . $voucher);
		$stmt->bindParam(':USER_ID', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->bindParam(':STATUS', $status, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function get_dados_produto($id)
	{

		$stmt = $this->db->prepare("SELECT * from produtos
			where CODIGO = :PRODUTO_ID");
		$stmt->bindParam(':PRODUTO_ID', $id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function update_qtd_estoque($id)
	{
		$stmt = $this->db->prepare("UPDATE produtos set TOTAL_ESTOQUE = (TOTAL_ESTOQUE - 1)
			where CODIGO = :PRODUTO_ID");
		$stmt->bindParam(':PRODUTO_ID', $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function update_status($id)
	{
		$stmt = $this->db->prepare("UPDATE produtos set STATUS = 0
			where CODIGO = :PRODUTO_ID");
		$stmt->bindParam(':PRODUTO_ID', $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function get_user_vouchers_by_company_name($status, $nome)
	{

		$stmt = $this->db->prepare("SELECT historico_transacoes_usuario.CODIGO AS id_voucher,historico_transacoes_usuario.DATA_TRANSACAO as data_compra , historico_transacoes_usuario.STATUS, lojas.NOME as nome_loja from historico_transacoes_usuario
        join usuario on usuario.CODIGO = historico_transacoes_usuario.CODIGO_USUARIO
        join lojas on lojas.CODIGO = historico_transacoes_usuario.CODIGO_LOJA
		where historico_transacoes_usuario.STATUS = :STATUS and usuario.CODIGO = :USER_ID and lojas.NOME like :NOME order by lojas.NOME");
		$nome = '%' . $nome . '%';
		$stmt->bindParam(':USER_ID', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->bindParam(':STATUS', $status, PDO::PARAM_INT);
		$stmt->bindParam(':NOME', $nome, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $resultado;
	}
}
