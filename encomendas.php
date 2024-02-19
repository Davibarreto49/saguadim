<?php
include("conectadb.php");
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
   
    # Gerar chave aleatória
    $key = rand(100000, 999999);
 
    # Inserir instruções no banco
    $sql = "INSERT INTO encomendas (enc_produto, enc_quantidade, enc_preco, enc_chave)
            VALUES ('$produto', '$quantidade', '$preco', '$key')";
 
    # Gravar log
    $sql = '"' . $sql . '"';
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
               VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
 
    echo "<script>window.alert('ENCOMENDA REGISTRADA COM SUCESSO');</script>";
    echo "<script>window.location.href='encomendas.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="encomendas.css">
    <title>Encomendas</title>
</head>
<body>
    <header>
        <h1>Sistema de Encomendas</h1>
    </header>
    <div class="container">
        <form id="orderForm">
            <label for="productName">Nome do Produto:</label>
            <input type="text" id="productName" name="productName" required>
            <br><br>
            <label for="quantity">Quantidade:</label>
            <input type="number" id="quantity" name="quantity" required>
            <br><br>
            <label for="customerName">Nome do Cliente:</label>
            <input type="text" id="customerName" name="customerName" required>
            <br><br>
            <input type="submit" value="Adicionar Encomenda">
        </form>
        <table id="ordersTable">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Cliente</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui serão adicionadas as encomendas -->
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("orderForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var productName = document.getElementById("productName").value;
            var quantity = document.getElementById("quantity").value;
            var customerName = document.getElementById("customerName").value;

            var table = document.getElementById("ordersTable").getElementsByTagName("tbody")[0];
            var row = table.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML = productName;
            cell2.innerHTML = quantity;
            cell3.innerHTML = customerName;

            document.getElementById("orderForm").reset();
        });
    </script>
</body>
</html>
