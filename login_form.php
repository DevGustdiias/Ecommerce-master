<?php
#esta é a página do formulário de login, se o usuário já estiver logado, não permitiremos que o usuário acesse esta página executando isset($_SESSION["uid"])
#if abaixo da declaração retornar true então enviaremos o usuário para sua página profile.php
if (isset($_SESSION["uid"])) {
	header("location:profile.php");
}
//na página action.php se o usuário clicar no botão "pronto para checkout" dessa vez passaremos os dados em um formulário da página action.php
if (isset($_POST["login_user_with_product"])) {
	//esta é a matriz da lista de produtos
	$product_list = $_POST["product_id"];
	//aqui estamos convertendo array em formato json porque array não pode ser armazenado em cookie
	$json_e = json_encode($product_list);
	//aqui estamos criando um cookie e o nome do cookie é product_list
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);

}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Winter Winner</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Winter Winner</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Produtos</a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
				<!--Alerta do formulário de inscrição-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulário de login do cliente</div>
					<div class="panel-body">
						<!--Formulário de login do usuário-->
						<form onsubmit="return false" id="login">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" id="email" required/>
							<label for="email">Senha</label>
							<input type="password" class="form-control" name="password" id="password" required/>
							<p><br/></p>
							<a href="#" style="color:#333; list-style:none;">Palavra-chave esquecida</a><input type="submit" class="btn btn-success" style="float:right;" Value="Login">
							<!--Se o usuário não tiver uma conta, ele clicará no botão criar conta-->
							<div><a href="customer_registration.php?register=1">Criar uma nova conta?</a></div>						
						</form>
				</div>
				<div class="panel-footer"><div id="e_msg"></div></div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>






















