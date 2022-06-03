<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Lista Produtos</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Adicionar Produto</a>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Imagem</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th>Categoria</th>
              <th>Marca</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody id="product_list">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Adicionar produto Modal começar -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-product-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Nome Produto</label>
		        		<input type="text" name="product_name" class="form-control" placeholder="Digite o nome do produto"">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Nome Marca</label>
		        		<select class="form-control brand_list" name="brand_id">
		        			<option value="">Selecionar Marca</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Nome Categoria</label>
		        		<select class="form-control category_list" name="category_id">
		        			<option value="">Selecionar Categoria</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Descrição Produto</label>
		        		<textarea class="form-control" name="product_desc" placeholder="Insira a descrição do produto"></textarea>
		        	</div>
        		</div>
            <div class="col-12">
              <div class="form-group">
                <label>Produto Qtd</label>
                <input type="number" name="product_qty" class="form-control" placeholder="Insira a quantidade do produto">
              </div>
            </div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Preço Produto</label>
		        		<input type="number" name="product_price" class="form-control" placeholder="Insira o preço do produto">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Palavras Chaves <small>(ex: calçado, camiseta, blusa, calça)</small></label>
		        		<input type="text" name="product_keywords" class="form-control" placeholder="Insira as palavras-chave do produto">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Imagem Produto <small>(format: jpg, jpeg, png)</small></label>
		        		<input type="file" name="product_image" class="form-control">
		        	</div>
        		</div>
        		<input type="hidden" name="add_product" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-product">Adicionar produto</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Adicionar produto Modal end -->

<!-- Editar produto Modal começar -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-product-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Nome produto</label>
                <input type="text" name="e_product_name" class="form-control" placeholder="Digite o nome do produto">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Nome Marca</label>
                <select class="form-control brand_list" name="e_brand_id">
                  <option value="">Selecionar Marca</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Nome Categoria</label>
                <select class="form-control category_list" name="e_category_id">
                  <option value="">Selecionar Categoria</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Descrição Produto</label>
                <textarea class="form-control" name="e_product_desc" placeholder="Insira a descrição do produto"></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Produto Qtd</label>
                <input type="number" name="e_product_qty" class="form-control" placeholder="Insira a quantidade do produto">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Preço Produto</label>
                <input type="number" name="e_product_price" class="form-control" placeholder="Insira o preço do produto">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Palavras Chaves <small>(ex: tênis, camiseta, moletom, calça)</small></label>
                <input type="text" name="e_product_keywords" class="form-control" placeholder="Insira as palavras-chave do produto">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Imagem Produto <small>(format: jpg, jpeg, png)</small></label>
                <input type="file" name="e_product_image" class="form-control">
                <img src="../product_images/1.0x0.jpg" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-product">Atualizar Produto</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Product Modal end -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/products.js"></script>