<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de negócio</title>
    <link href = "Estilo.css" rel = "stylesheet" />
   	<script src="http://localhost/form/caixafluxo.js"></script>
  
</head>

<body>
<!-- inicio janela principal -->
<header> Gerenciador de caixa</header>
     
        <div class="tab" onclick="openTab('caixa')">Caixa</div>
        <div class="tab" onclick="openTab('estoque')">Estoque</div>
        <div class="tab" onclick="openTab('historico')">Relatório</div>
		

<!-- inicio aba para caixa -->
<div id="caixa" class="tab-content active"> 
            <h2>caixa</h2>
    <section id = "caixaform" class="entradadedados">        
	    <form method="POST">
        
        <label for="code">Código do Produto:</label>
        <input type="number" id="code" name="code" class="inputestilo1" required>
		<button type="button" onclick="buscar()">Buscar</button><br>	
        <label for="produto">Produto:</label>
        <input type="text" id="produto" name="produto" class="inputestilo1" required><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade"  step="0.01" class="inputestilo1" required><br>

        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor"  step="0.01" class="inputestilo1" required><br>

        <label for="desconto">Desconto:</label>
        <input type="number" id="desconto" name="desconto" value="0"  step="0.01" class="inputestilo1" required><br>
        
        <button type="submit" onclick="funcoescaixa()">Adicionar Produto</button><br>
        <input type="reset" value="Limpar"><br>
        </form>
    </section>
            
    <section id = "tabelacaixa" class="tabelabox">
        <table id="tabelaProdutos" class="tabelas">
            <tr>
                <th>Código do Produto</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Desconto</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </table>
    
        <div id="totalCompra">
            <button id = 'b1' type="button" onclick="finalizarCompra()">Finalizar Compra</button>
    
            <form  method="post">
                <input type="submit" value="Apagar caixa" onclick="apagarCaixa()">
            </form>	
        </div>
    </section>
    
</div>
<!-- fim da aba para caixa -->
		
		
<!-- inicio aba para estoque -->
<div id="estoque" class="tab-content"> 
	<h2>Estoque</h2>
    <section id = "estoqueform" class="entradadedados">
        <form method="post" >
        <legend>Inserir produdo no estoque</legend><br>
        
            <label for="code">Codigo:</label>
            <input type="text" id="codigo" name="codigo" class="inputestilo1" required>       
        
            <label for="produto">Produto:</label>
            <input type="text" id="descricao" name="descricao" class="inputestilo1" required>

            <label for="quantidadeE">Quantidade em Estoque:</label>
            <input type="number" id="quantidadeE" name="quantidadeE"  step="0.01" class="inputestilo1" required>

            <label for="valor">Valor unidade:</label>
            <input type="number" id="preco" name="preco"  step="0.01" class="inputestilo1" required>

            <input type="submit" value="Adicionar ao estoque"/><br>
            <input type="reset" value="Limpar"><br>
            
            </form>

           
              
    </section>
    <section id="tabelaEstoque"  class="tabelabox">
        <table id = "tabelafixo" class="tabelas">
            <tr>
                <th>Code</th>
                <th>Produto</th>
                <th>Em Estoque</th>
                <th>valor</th>
                <th>Valor Total</th>
            </tr>
        
        </table>
        <table id = "entradaestoque" class="tabelas">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        
        </table>
        <button type="button" onclick="adicionarLinha()">mostrar estoque</button><br>
        <div id="apagaestoque">
                <form  method="post">
                    <input type="submit" value="Apagar Estoque" onclick="apagarEstoque()">
                </form>
            </div>
    </section>
</div> 
<!-- fim aba para estoque -->

<!-- inicio aba para historico -->		
<div id="historico" class="tab-content"> 
    <h2>historico</h2>
    <section id="tabelahistorico"  class="tabelabox">
        <table id = "tabhistorico" class="tabelas">
            <tr>
                <th>ação</th>
                <th>usuario</th>
                <th>data e hora</th>
                
            </tr>
        
        </table>
        <div id="apagahistorico">
                <form  method="post">
                    <input type="submit" value="Apagar historico">
                </form>
            </div>
    </section>
</div> 
<!-- fim aba para historico -->
		
		
<button onclick="logout()">Logout</button>
        
<!-- fim janela principal -->
    
<script> //script para salvar os valores do caixa no BD
        const form = document.querySelector("#caixa form");
form.addEventListener("submit", (event)=>{
    event.preventDefault();

    const dados = new FormData(form);

    fetch('caixaDB.php',{
        method: 'POST', body: dados
    })

})
</script>

<script> //apagar tabela de caixa e zerar o ID da tabela 
const form2 = document.querySelector("#totalCompra form");
form2.addEventListener("submit", (event)=>{
    event.preventDefault(); 
    const dados2 = new FormData(form2);
    fetch('zera_id.php',{
        method: 'POST', body: dados2
    })

})
</script>

<script> //salvar os dados da tabela de estoque no BD
const form3 = document.querySelector("#estoque form");
form3.addEventListener("submit", (event)=>{
    event.preventDefault(); 
    const dados3 = new FormData(form3);
    fetch('estoqueDB.php',{
        method: 'POST', body: dados3
    })

})
</script>

<script> //apagar tabela de estoque e zerar o ID da tabela 
const form4 = document.querySelector("#apagaestoque form");
form4.addEventListener("submit", (event)=>{
    event.preventDefault(); 
    const dados4 = new FormData(form4);
    fetch('apagarestoque.php',{
        method: 'POST', body: dados4
    })

})
</script>
	
	
    
</body>
</html>