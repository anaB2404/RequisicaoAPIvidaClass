<?php
    $cpf = $_POST["cpf"];
    
    // OBTENDO O TOKEN

    $url = "https://bi.vidaclass.com.br/auth";
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-type: application/json'
    ));

    $jsonCredenciais = json_encode(array(
        'company_id' => 1,
        'username' => 'webmaster@vidaclass.com.br',
        'password' => 'Teste20170705'

    ));

    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonCredenciais);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch); 
    $result = json_decode($result); 

    $meuToken = $result->data->result->token; 
    curl_close($ch); 

    // CONSULTANDO CPF

    $removePontosCpf = array(".","-");
    $cpfTratado = str_replace($removePontosCpf, "", $cpf);

    $url = "https://bi.vidaclass.com.br/utils";
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-type: application/json',
        'Authorization: Bearer '.$meuToken
    ));

    $usuarioASerBuscado = json_encode(array(
        'action' => 4, 
        'key' => array(
            'cpf' => intval($cpfTratado)
        )
    ));

    curl_setopt($ch, CURLOPT_POSTFIELDS, $usuarioASerBuscado);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $resultado = curl_exec($ch); 
    $resultado = json_decode($resultado,true); 
    // echo "<pre>";

    if(empty($resultado['data']['result'])){
        echo "Usuario não tem cadastro";
        die;
    }
    
    $nome = current($resultado['data']['result'])['cliente']['name'];
    $email = current($resultado['data']['result'])['cliente']['mail'];
    $celular = current($resultado['data']['result'])['cliente']['cellphone'];
    $qntCompra = current($resultado['data']['result'])['saude'];
    $qntComprasUsuario = count($qntCompra);
    $qntDeps = current(current($resultado['data']['result'])['farma'])['dependents'];
    $qntDependentes = count($qntDeps);

    echo "Nome: ".$nome."</br>";
    echo "Email: ".$email."</br>";
    echo "Telefone: ".$celular."</br>";

    if($qntComprasUsuario){
        echo "Tem compras</br>";
    }else{
        echo "Não tem compras</br>";
    }
    echo "Quantas compras tem: ".$qntComprasUsuario."</br>";

    if($qntDependentes){
        echo "Tem dependentes</br>";
    }else{
        echo "Não tem dependentes</br>";
    }
    echo "Quantidade de dependentes: ".$qntDependentes."</br>";

    curl_close($ch); 
?>