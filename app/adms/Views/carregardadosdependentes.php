<?php

$parametro =$_POST['parametro'];
$accao = $_POST['accao'];

$conexao = new PDO('mysql:host=localhost;dbname=gepro', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 


if ($accao == 'Buscar Certificados') {
	
	$saida = null;
	$buscarProvincias = $conexao->prepare("SELECT cod_certificado,designacao_certificado FROM tb_certificado WHERE cod_area_certificacao=:cod_area_certificacao ORDER BY designacao_certificado");
	$buscarProvincias->bindValue(':cod_area_certificacao', $parametro);
	$buscarProvincias->execute();
	$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarProvincias->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_certificado."'>".$designacao_certificado." </option>";
	}

	echo json_encode($saida);
}

if ($accao == 'Buscar Provincias') {

	$saida = null;
	$buscarProvincias = $conexao->prepare("SELECT cod_provincia,designacao_provincia FROM tb_provincia WHERE cod_pais=:cod_pais ORDER BY designacao_provincia");
	$buscarProvincias->bindValue(':cod_pais', $parametro);
	$buscarProvincias->execute();
$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarProvincias->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_provincia."'>".$designacao_provincia." </option>";
	}

	echo json_encode($saida);
}

if ($accao == 'Buscar Bloco') {

	$saida = null;
	$buscarBloco = $conexao->prepare("SELECT cod_bloco, designacao_bloco FROM tb_bloco WHERE cod_curso=:cod_curso ORDER BY designacao_bloco");
	$buscarBloco->bindValue(':cod_curso', $parametro);
	$buscarBloco->execute();
$saida="<option value=''>Seleccione o Bloco</option>";
	while ($dados = $buscarBloco->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_bloco."'>".$designacao_bloco." </option>";
	}

	echo json_encode($saida);
}

if ($accao == 'Buscar Patente') {

	
	$saida =null;
	$buscarsaber = $conexao->prepare("SELECT cod_patente, patente,patente_mga FROM tb_patente ORDER BY cod_patente ASC");
	$buscarsaber->execute();
	$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarsaber->fetch(PDO::FETCH_ASSOC)) 
	{
	
		extract($dados);
		if($parametro!=4):
		$saida.="<option value='".$cod_patente."'>".$patente." </option>";
		else:
			$saida.="<option value='".$cod_patente."'>".$patente_mga." </option>";
		endif;
	}

	echo json_encode($saida);
}


if ($accao == 'Buscar Turma') {

	$saida = null;
	$buscarTurma = $conexao->prepare("SELECT cod_turma, designacao_turma FROM tb_turma WHERE cod_curso=:cod_curso ORDER BY designacao_turma");
	$buscarTurma->bindValue(':cod_curso', $parametro);
	$buscarTurma->execute();
    $saida="<option value=''>Seleccione a Turma</option>";
	while ($dados = $buscarTurma->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_turma."'>".$designacao_turma." </option>";
	}

	echo json_encode($saida);
}



if ($accao == 'Buscar Disciplinas') {

	$saida = null;
	$buscarDisciplinas = $conexao->prepare("SELECT cod_disciplina,designacao_disciplina FROM tb_disciplina WHERE cod_bloco=:cod_bloco ORDER BY designacao_disciplina");
	$buscarDisciplinas->bindValue(':cod_bloco', $parametro);
	$buscarDisciplinas->execute();
$saida="<option value=''>Disciplinas do Bloco</option>";
	while ($dados = $buscarDisciplinas->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_disciplina."'>".$designacao_disciplina." </option>";
	}

	echo json_encode($saida);
}
/*
if ($accao == 'Buscar Curso') {

	$saida = null;
	$buscarCurso = $conexao->prepare("SELECT cod_curso, designacao_curso FROM tb_curso WHERE cod_bloco=:cod_bloco ORDER BY designacao_curso");
	$buscarCurso->bindValue(':cod_bloco', $parametro);
	$buscarCurso->execute();
$saida="<option value=''>Selecione uma Opção</option>";
	while ($dados = $buscarCurso->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_curso."'>".utf8_encode($designacao_curso)." </option>";
	}

	echo json_encode($saida);
}
*/

if ($accao == 'Buscar Municipios') {

	$saida = null;
	$buscarMunicipio = $conexao->prepare("SELECT cod_municipio,designacao_municipio FROM tb_municipio WHERE cod_provincia=:cod_provincia ORDER BY designacao_municipio");
	$buscarMunicipio->bindValue(':cod_provincia', $parametro);
	$buscarMunicipio->execute();
$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarMunicipio->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_municipio."'>".$designacao_municipio." </option>";
	}

	echo json_encode($saida);
}

if ($accao == 'Buscar Habilitacao') {

	$saida = null;
	$buscarHabilitacoes = $conexao->prepare("SELECT cod_habilitacao_literaria,designacao_habilitacao_literaria FROM tb_habilitacao_literaria WHERE cod_nivel_academico=:cod_nivel_academico ORDER BY designacao_habilitacao_literaria");
	$buscarHabilitacoes->bindValue(':cod_nivel_academico', $parametro);
	$buscarHabilitacoes->execute();
$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarHabilitacoes->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_habilitacao_literaria."'>".$designacao_habilitacao_literaria." </option>";
	}

	echo json_encode($saida);
}


if ($accao == 'Buscar Curso') {

	$saida = null;
	$buscarCursos = $conexao->prepare("SELECT cod_curso_academico,designacao_curso_academico FROM tb_curso_academico WHERE cod_nivel_academico=:cod_nivel_academico ORDER BY designacao_curso_academico");
	$buscarCursos->bindValue(':cod_nivel_academico', $parametro);
	$buscarCursos->execute();
$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarCursos->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_curso_academico."'>".$designacao_curso_academico." </option>";
	}

	echo json_encode($saida);
}

if ($accao == 'Buscar CursoEspecialidade') {

	$saida = null;
	$buscarCursoEspecialidade = $conexao->prepare("SELECT cod_especialidade_militar,designacao_especialidade_militar FROM tb_especialidade_militar WHERE cod_curso_especializacao_militar=:cod_curso_especializacao_militar ORDER BY designacao_especialidade_militar");
	$buscarCursoEspecialidade->bindValue(':cod_curso_especializacao_militar', $parametro);
	$buscarCursoEspecialidade->execute();
$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarCursoEspecialidade->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_especialidade_militar."'>".$designacao_especialidade_militar." </option>";
	}

	echo json_encode($saida);
}



if ($accao == 'Buscar Regiao') {

	$saida = null;
	$buscarRegiao = $conexao->prepare("SELECT cod_regiao,designacao_regiao FROM tb_regiao WHERE cod_ramo=:cod_ramo ORDER BY designacao_regiao");
	$buscarRegiao->bindValue(':cod_ramo', $parametro);
	$buscarRegiao->execute();
	
	$saida="<option value=''>Selecione uma opção</option>";

	while ($dados = $buscarRegiao->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_regiao."'>".$designacao_regiao." </option>";
	}

	echo json_encode($saida);
}


if ($accao == 'Buscar Unidade') {

	$saida = null;
	$buscarUnidade = $conexao->prepare("SELECT cod_u_e_o,designacao_u_e_o FROM tb_u_e_o WHERE cod_ramo=:cod_ramo ORDER BY designacao_u_e_o");
	$buscarUnidade->bindValue(':cod_ramo', $parametro);
	$buscarUnidade->execute();
$saida="<option value=''>Selecione uma opção</option>";
	while ($dados = $buscarUnidade->fetch(PDO::FETCH_ASSOC)) {

		extract($dados);
		
		$saida.="<option value='".$cod_u_e_o."'>".$designacao_u_e_o." </option>";
	}

	echo json_encode($saida);
}

?>



