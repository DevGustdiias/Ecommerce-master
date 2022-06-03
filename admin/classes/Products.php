<?php 
session_start();

class Products
{
	
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getProducts(){
		$q = $this->con->query("SELECT p.product_id, p.product_title, p.product_price,p.product_qty, p.product_desc, p.product_image, p.product_keywords, c.cat_title, c.cat_id, b.brand_id, b.brand_title FROM products p JOIN categories c ON c.cat_id = p.product_cat JOIN brands b ON b.brand_id = p.product_brand");
		
		$products = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$products[] = $row;
			}
			$_DATA['products'] = $products;
		}

		$categories = [];
		$q = $this->con->query("SELECT * FROM categories");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$categories[] = $row;
			}
			$_DATA['categories'] = $categories;
		}

		$brands = [];
		$q = $this->con->query("SELECT * FROM brands");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$brands[] = $row;
			}
			$_DATA['brands'] = $brands;
		}


		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function addProduct($product_name,
								$brand_id,
								$category_id,
								$product_desc,
								$product_qty,
								$product_price,
								$product_keywords,
								$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/Ecommerce-master/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("INSERT INTO `products`(`product_cat`, `product_brand`, `product_title`, `product_qty`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES ('$category_id', '$brand_id', '$product_name', '$product_qty', '$product_price', '$product_desc', '$uniqueImageName', '$product_keywords')");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Produto adicionado com sucesso..!'];
					}else{
						return ['status'=> 303, 'message'=> 'Falha ao executar a consulta'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Falha ao carregar a imagem'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Imagem grande, tamanho máximo permitido 2 MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Formato de imagem inválido [Formatos válidos: jpg, jpeg, png]'];
		}

	}


	public function editProductWithImage($pid,
										$product_name,
										$brand_id,
										$category_id,
										$product_desc,
										$product_qty,
										$product_price,
										$product_keywords,
										$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/Ecommerce-master/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("UPDATE `products` SET 
										`product_cat` = '$category_id', 
										`product_brand` = '$brand_id', 
										`product_title` = '$product_name', 
										`product_qty` = '$product_qty', 
										`product_price` = '$product_price', 
										`product_desc` = '$product_desc', 
										`product_image` = '$uniqueImageName', 
										`product_keywords` = '$product_keywords'
										WHERE product_id = '$pid'");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Produto modificado com sucesso..!'];
					}else{
						return ['status'=> 303, 'message'=> 'Falha ao executar a consulta'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Falha ao carregar a imagem'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Imagem grande, tamanho máximo permitido 2 MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Formato de imagem inválido [Formatos válidos: jpg, jpeg, png]'];
		}

	}

	public function editProductWithoutImage($pid,
										$product_name,
										$brand_id,
										$category_id,
										$product_desc,
										$product_qty,
										$product_price,
										$product_keywords){

		if ($pid != null) {
			$q = $this->con->query("UPDATE `products` SET 
										`product_cat` = '$category_id', 
										`product_brand` = '$brand_id', 
										`product_title` = '$product_name', 
										`product_qty` = '$product_qty', 
										`product_price` = '$product_price', 
										`product_desc` = '$product_desc',
										`product_keywords` = '$product_keywords'
										WHERE product_id = '$pid'");

			if ($q) {
				return ['status'=> 202, 'message'=> 'Produto atualizado com sucesso'];
			}else{
				return ['status'=> 303, 'message'=> 'Falha ao executar a consulta'];
			}
			
		}else{
			return ['status'=> 303, 'message'=> 'ID do produto inválido'];
		}
		
	}


	public function getBrands(){
		$q = $this->con->query("SELECT * FROM brands");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function addCategory($name){
		$q = $this->con->query("SELECT * FROM categories WHERE cat_title = '$name' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'A categoria já existe'];
		}else{
			$q = $this->con->query("INSERT INTO categories (cat_title) VALUES ('$name')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Nova categoria adicionada com sucesso'];
			}else{
				return ['status'=> 303, 'message'=> 'Falha ao executar a consulta'];
			}
		}
	}

	public function getCategories(){
		$q = $this->con->query("SELECT * FROM categories");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function deleteProduct($pid = null){
		if ($pid != null) {
			$q = $this->con->query("DELETE FROM products WHERE product_id = '$pid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Produto removido dos estoques'];
			}else{
				return ['status'=> 202, 'message'=> 'Falha ao executar a consulta'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'ID do produto inválido'];
		}

	}

	public function deleteCategory($cid = null){
		if ($cid != null) {
			$q = $this->con->query("DELETE FROM categories WHERE cat_id = '$cid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Categoria removida'];
			}else{
				return ['status'=> 202, 'message'=> 'Falha ao executar a consulta'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'ID de categoria inválido'];
		}

	}
	
	

	public function updateCategory($post = null){
		extract($post);
		if (!empty($cat_id) && !empty($e_cat_title)) {
			$q = $this->con->query("UPDATE categories SET cat_title = '$e_cat_title' WHERE cat_id = '$cat_id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Categoria atualizada'];
			}else{
				return ['status'=> 202, 'message'=> 'Falha ao executar a consulta'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'ID de categoria inválido'];
		}

	}

	public function addBrand($name){
		$q = $this->con->query("SELECT * FROM brands WHERE brand_title = '$name' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'A marca já existe'];
		}else{
			$q = $this->con->query("INSERT INTO brands (brand_title) VALUES ('$name')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Nova marca adicionada com sucesso'];
			}else{
				return ['status'=> 303, 'message'=> 'Falha ao executar a consulta'];
			}
		}
	}

	public function deleteBrand($bid = null){
		if ($bid != null) {
			$q = $this->con->query("DELETE FROM brands WHERE brand_id = '$bid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Marca removida'];
			}else{
				return ['status'=> 202, 'message'=> 'Falha ao executar a consulta'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'ID de marca inválido'];
		}

	}
	
	

	public function updateBrand($post = null){
		extract($post);
		if (!empty($brand_id) && !empty($e_brand_title)) {
			$q = $this->con->query("UPDATE brands SET brand_title = '$e_brand_title' WHERE brand_id = '$brand_id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Marca atualizada'];
			}else{
				return ['status'=> 202, 'message'=> 'Falha ao executar a consulta'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'ID de marca inválido'];
		}

	}

	

}


if (isset($_POST['GET_PRODUCT'])) {
	if (isset($_SESSION['admin_id'])) {
		$p = new Products();
		echo json_encode($p->getProducts());
		exit();
	}
}


if (isset($_POST['add_product'])) {

	extract($_POST);
	if (!empty($product_name) 
	&& !empty($brand_id) 
	&& !empty($category_id)
	&& !empty($product_desc)
	&& !empty($product_qty)
	&& !empty($product_price)
	&& !empty($product_keywords)
	&& !empty($_FILES['product_image']['name'])) {
		

		$p = new Products();
		$result = $p->addProduct($product_name,
								$brand_id,
								$category_id,
								$product_desc,
								$product_qty,
								$product_price,
								$product_keywords,
								$_FILES['product_image']);
		
		header("Content-type: application/json");
		echo json_encode($result);
		http_response_code($result['status']);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Campos vazios']);
		exit();
	}



	
}


if (isset($_POST['edit_product'])) {

	extract($_POST);
	if (!empty($pid)
	&& !empty($e_product_name) 
	&& !empty($e_brand_id) 
	&& !empty($e_category_id)
	&& !empty($e_product_desc)
	&& !empty($e_product_qty)
	&& !empty($e_product_price)
	&& !empty($e_product_keywords) ) {
		
		$p = new Products();

		if (isset($_FILES['e_product_image']['name']) 
			&& !empty($_FILES['e_product_image']['name'])) {
			$result = $p->editProductWithImage($pid,
								$e_product_name,
								$e_brand_id,
								$e_category_id,
								$e_product_desc,
								$e_product_qty,
								$e_product_price,
								$e_product_keywords,
								$_FILES['e_product_image']);
		}else{
			$result = $p->editProductWithoutImage($pid,
								$e_product_name,
								$e_brand_id,
								$e_category_id,
								$e_product_desc,
								$e_product_qty,
								$e_product_price,
								$e_product_keywords);
		}

		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Campos vazios']);
		exit();
	}



	
}

if (isset($_POST['GET_BRAND'])) {
	$p = new Products();
	echo json_encode($p->getBrands());
	exit();
	
}

if (isset($_POST['add_category'])) {
	if (isset($_SESSION['admin_id'])) {
		$cat_title = $_POST['cat_title'];
		if (!empty($cat_title)) {
			$p = new Products();
			echo json_encode($p->addCategory($cat_title));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Campos vazios']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Erro de sessão']);
	}
}

if (isset($_POST['GET_CATEGORIES'])) {
	$p = new Products();
	echo json_encode($p->getCategories());
	exit();
	
}

if (isset($_POST['DELETE_PRODUCT'])) {
	$p = new Products();
	if (isset($_SESSION['admin_id'])) {
		if(!empty($_POST['pid'])){
			$pid = $_POST['pid'];
			echo json_encode($p->deleteProduct($pid));
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'ID do produto inválido']);
			exit();
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Sessão inválida']);
	}


}


if (isset($_POST['DELETE_CATEGORY'])) {
	if (!empty($_POST['cid'])) {
		$p = new Products();
		echo json_encode($p->deleteCategory($_POST['cid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalhes inválidos']);
		exit();
	}
}

if (isset($_POST['edit_category'])) {
	if (!empty($_POST['cat_id'])) {
		$p = new Products();
		echo json_encode($p->updateCategory($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalhes inválidos']);
		exit();
	}
}

if (isset($_POST['add_brand'])) {
	if (isset($_SESSION['admin_id'])) {
		$brand_title = $_POST['brand_title'];
		if (!empty($brand_title)) {
			$p = new Products();
			echo json_encode($p->addBrand($brand_title));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Campos vazios']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Erro de sessão']);
	}
}

if (isset($_POST['DELETE_BRAND'])) {
	if (!empty($_POST['bid'])) {
		$p = new Products();
		echo json_encode($p->deleteBrand($_POST['bid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalhes inválidos']);
		exit();
	}
}

if (isset($_POST['edit_brand'])) {
	if (!empty($_POST['brand_id'])) {
		$p = new Products();
		echo json_encode($p->updateBrand($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalhes inválidos']);
		exit();
	}
}

?>