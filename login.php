<?php
include "db.php";

session_start();

#O script de login começa aqui
#Se a credencial fornecida pelo usuário corresponder com sucesso com os dados disponíveis no banco de dados, faremos eco da string login_success
#A string #login_success retornará à função anônima chamada $("#login").click()

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	//se o registro do usuário estiver disponível no banco de dados, $count será igual a 1
	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["user_id"];
		$_SESSION["name"] = $row["first_name"];
		$ip_add = getenv("REMOTE_ADDR");
		//criamos um cookie na página login_form.php, portanto, se esse cookie estiver disponível, significa que o usuário não está logado
			if (isset($_COOKIE["product_list"])) {
				$p_list = stripcslashes($_COOKIE["product_list"]);
				//aqui estamos decodificando o cookie de lista de produtos json armazenado para matriz normal
				$product_list = json_decode($p_list,true);
				for ($i=0; $i < count($product_list); $i++) { 
					//Depois de obter o ID do usuário do banco de dados, estamos verificando o item do carrinho do usuário se já existe um produto listado ou não
					$verify_cart = "SELECT id FROM cart WHERE user_id = $_SESSION[uid] AND p_id = ".$product_list[$i];
					$result  = mysqli_query($con,$verify_cart);
					if(mysqli_num_rows($result) < 1){
						//se o usuário estiver adicionando o produto pela primeira vez ao carrinho, atualizaremos user_id na tabela de banco de dados com id válido
						$update_cart = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND user_id = -1";
						mysqli_query($con,$update_cart);
					}else{
						//se esse produto já estiver disponível na tabela do banco de dados, excluiremos esse registro
						$delete_existing_product = "DELETE FROM cart WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = ".$product_list[$i];
						mysqli_query($con,$delete_existing_product);
					}
				}
				//aqui estamos destruindo o cookie do usuário
				setcookie("product_list","",strtotime("-1 day"),"/");
				//if user is logging from after cart page we will send cart_login
				echo "cart_login";
				exit();
				
			}
			//se o usuário fizer login da página, enviaremos login_success
			echo "login_success";
			exit();
		}else{
			echo "<span style='color:red;'>Por favor, registre-se antes de entrar..!</span>";
			exit();
		}
	
}

?>