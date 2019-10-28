<?php
class Shopperz_model extends CI_Model
{
	//Trata os caracteres para utf-8, tanto os de entrada como os de saída de dados.
	function __construct()
	{
		$this->db->query( "SET NAMES 'utf8'" );
	}
	
	#
	#Login
	#
	public function get_user_data($telefone=null,$senha=null){

		
		$stmt = $this->db->prepare("SELECT CODIGO,CODIGO_TIPO_USUARIO,NOME FROM usuario where TELEFONE = :TELEFONE and SENHA = :SENHA");
		
		$stmt->bindValue(':TELEFONE',$telefone, PDO::PARAM_STR);
		$stmt->bindValue(':SENHA',$senha, PDO::PARAM_STR);	
		
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;	
	}

	#
	#Cadastro
	#
	public function get_patrocinador($codigo_patrocinador){

		
		$stmt = $this->db->prepare("SELECT CODIGO,CODIGO_TIPO_USUARIO,NOME FROM usuario where CODIGO = :CODIGO_PATROCINADOR");
		
		$stmt->bindValue(':CODIGO_PATROCINADOR',$codigo_patrocinador, PDO::PARAM_STR);
		
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;	
	}

	public function verify_email($email=null){

		
		$stmt = $this->db->prepare("SELECT CODIGO FROM usuario where email = :EMAIL");
		
		$stmt->bindValue(':EMAIL',$email, PDO::PARAM_STR);
		
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;	
	}

	public function cadastrar_usuario($dados)
	{
		
		$stmt = $this->db->prepare("INSERT INTO usuario (EMAIL,NOME,TELEFONE,SENHA,CODIGO_TIPO_USUARIO,CODIGO_PATROCINADOR,DATA_CADASTRO,CODIGO_STATUS) VALUES (:EMAIL,:NOME,:TELEFONE,:SENHA,:CODIGO_TIPO_USUARIO,:CODIGO_PATROCINADOR,:DATA_CADASTRO,:CODIGO_STATUS)");
		
		$stmt->bindValue(':NOME', element('nome', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':EMAIL', element('email', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':SENHA', element('senha', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':TELEFONE', element('telefone', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_TIPO_USUARIO', element('tipoUsuario', $dados), PDO::PARAM_INT);
		$stmt->bindValue(':CODIGO_PATROCINADOR', element('patrocinador', $dados), PDO::PARAM_INT);
		$stmt->bindValue(':DATA_CADASTRO', date('Y-m-d H:i'), PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_STATUS', element('status', $dados), PDO::PARAM_STR);
		
		if($stmt->execute())
		{
			$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
			if($stmt2->execute()){
				$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);	
				return $resultado['ID'];
			}
			else
			{
				return false;
			}   
		}
	}	

	#
	#Listagem de Produtos
	#

	public function get_listar_produto($loja_id,$nome=null)
	{
		$stmt = $this->db->prepare("SELECT CODIGO as id,IMAGEM as img,PRECO_ATUAL as preco,NOME as nome,STATUS FROM produtos where STATUS = 1 and CODIGO_LOJA = :LOJA_ID and NOME like :NOME order by NOME");
		$nome = '%'.$nome.'%';
		$stmt->bindParam(':NOME',$nome, PDO::PARAM_STR);
		$stmt->bindParam(':LOJA_ID',$loja_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function get_lojas_favoritas($usuario_id=null,$loja_id=null)
	{
		if (!empty($loja_id)) {
			$loja_id = "AND usuario_favorito.loja_id =".$loja_id;
		}else{
			$loja_id="";
		}

		$stmt = $this->db->prepare("SELECT lojas.CODIGO as id,lojas.IMAGEM as img FROM lojas 
		JOIN usuario_favorito on usuario_favorito.loja_id = lojas.CODIGO
		where lojas.STATUS = '1' AND usuario_favorito.usuario_id = :USUARIO_ID  ".$loja_id." ORDER BY lojas.NOME");

		$stmt->bindParam(':USUARIO_ID',$usuario_id, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function get_lojas_populares()
	{

		$stmt = $this->db->prepare("SELECT lojas.CODIGO as id,lojas.IMAGEM as img FROM lojas 
		where lojas.STATUS = '1' ORDER BY lojas.FAVORITA");

		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function usuario_favoritar_loja($loja_id,$usuario_id)
	{
		$stmt = $this->db->prepare("INSERT INTO usuario_favorito(usuario_id,loja_id) VALUES (:USUARIO_ID,:LOJA_ID)");
		
		$stmt->bindParam(':LOJA_ID',$loja_id, PDO::PARAM_INT);
		$stmt->bindParam(':USUARIO_ID',$usuario_id, PDO::PARAM_INT);
		
		if($stmt->execute())
		{
			$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
			if($stmt2->execute()){
				$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);	
				return $resultado['ID'];
			}
			else
			{
				return false;
			}   
		}
		
	}

	public function update_numero_favoritos_loja($loja_id,$valor)
	{
		$stmt = $this->db->prepare("UPDATE lojas SET FAVORITA = FAVORITA+:VALOR WHERE CODIGO =:LOJA_ID");
		
		$stmt->bindParam(':LOJA_ID',$loja_id, PDO::PARAM_INT);
		$stmt->bindParam(':VALOR',$valor, PDO::PARAM_INT);
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}   
		
	}

	public function usuario_desfavoritar_loja($loja_id,$usuario_id)
	{
		$stmt = $this->db->prepare("DELETE FROM usuario_favorito WHERE loja_id = :LOJA_ID and usuario_id = :USUARIO_ID");
		
		$stmt->bindParam(':USUARIO_ID',$usuario_id, PDO::PARAM_INT);
		$stmt->bindParam(':LOJA_ID',$loja_id, PDO::PARAM_INT);
		
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}   

	}

	#
	#Listagem de Lojas
	#

	public function get_listar_lojas($nome=null)
	{
		$stmt = $this->db->prepare("SELECT CODIGO as id,IMAGEM as img FROM lojas where STATUS = '1' and NOME like :NOME order by NOME");
		$nome = '%'.$nome.'%';
		$stmt->bindParam(':NOME',$nome, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function get_listar_lojas_by_tipo($tipo_id=null)
	{
		$stmt = $this->db->prepare("SELECT DISTINCT lojas.CODIGO as id,lojas.IMAGEM as img FROM lojas 
		join produtos on produtos.CODIGO_LOJA = lojas.CODIGO
		where lojas.STATUS = '1' and produtos.CODIGO_CATEGORIA = :TIPO_ID");
		$stmt->bindParam(':TIPO_ID',$tipo_id, PDO::PARAM_INT);
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
		$stmt->bindParam(':PRODUTO_ID',$produto_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	#
	#Empresa
	#
	public function get_codigo_empresa($user_id)
	{
		$stmt = $this->db->prepare("SELECT * FROM usuario_lojas where CODIGO_USUARIO = :USER_ID");
		$stmt->bindParam(':USER_ID',$user_id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $resultado['CODIGO_LOJA'];
	}

	public function cadastrar_produto($dados)
	{
		
		$stmt = $this->db->prepare("INSERT INTO produtos (DATA_POSTAGEM,CODIGO_USUARIO,CODIGO_LOJA,CODIGO_CATEGORIA,NOME,DESCRICAO,PRECO_ATUAL,IMAGEM,TOTAL_ESTOQUE) VALUES (:DATA_POSTAGEM,:CODIGO_USUARIO,:CODIGO_LOJA,:CODIGO_CATEGORIA,:NOME,:DESCRICAO,:PRECO_ATUAL,:IMAGEM,:TOTAL_ESTOQUE)");
		
		$stmt->bindValue(':DATA_POSTAGEM', date('Y-m-d H:i'), PDO::PARAM_STR);
		$stmt->bindValue(':CODIGO_USUARIO', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->bindValue(':CODIGO_LOJA', $_SESSION['codigo_empresa'], PDO::PARAM_INT);
		$stmt->bindValue(':CODIGO_CATEGORIA',element('categoria', $dados) , PDO::PARAM_INT);
		$stmt->bindValue(':NOME', element('nome', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':DESCRICAO', element('descricao', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':PRECO_ATUAL', element('preco', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':IMAGEM', element('imagem', $dados), PDO::PARAM_STR);
		
		$stmt->bindValue(':TOTAL_ESTOQUE', element('estoque', $dados), PDO::PARAM_INT);
	//	$stmt->execute();
		//print_r($stmt->errorInfo());exit;
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}   
	}
	

	
}