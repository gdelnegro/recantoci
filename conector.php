<?php
//Senha do banco, deve ser a mesma configurada na classe mysql.as
$senha = "gutinho17";

//Verificar se � a classe do AS3 que est� acessando o banco, por motivo de seguran�a. Ela dever� enviar a senha atrav�s da vari�vel correta (secret_code).
if(isset($_POST['senha_banco']) && $_POST['senha_banco'] == $senha)
{
    //Conecta � base de dados. Alterar as configura��es para as do seu banco de dados.
    $conexao = new mysqli("localhost","bestwebf_admin",$senha,"bestwebf_recanto");
    
    
    $string_consulta = $_POST['string_consulta'];
    //$string_consulta = "select * from acougue";
    //$string_consulta = "select ac.id,ac.titulo,ac.descricao,ac.observacao,ac.preco,ac.imagem_carne,ac.imagem_corte,ac.promocao,ac.apresentacao,mp.modo_preparo from acougue_modo_preparo as amp inner join acougue as ac on ac.id = amp.id_acougue inner join modo_preparo as mp on mp.id = amp.id_modo_preparo ORDER by ac.id";

    //Exibe uma mensagem de erro caso n�o consiga se conectar ao banco.
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $conexao->query('SET CHARACTER SET utf8');
    //Verifica se a string de consulta est� configurada
    if(isset($string_consulta))
    {
        //Executando a query
        if ($resultado_consulta = $conexao->query($string_consulta))
        {
            $array_consulta = array();
            //$array_colunas["numero_de_colunas"] = $resultado_consulta->num_rows;
            
            if($resultado_consulta->num_rows > 0) {
                //armazena todos os resultados retornados em subarrays do array_consulta
                while ($coluna = $resultado_consulta->fetch_assoc()) {
                    $array_consulta[] = $coluna;
                }
                for($i=0; $i < count($array_consulta); $i++)
                {
                    //configura a vari�vel id_atual com o id do resultado referente ao indice $i
                    $id_atual = $array_consulta[$i]['id'];
                    //Percorre cada resultado (subarrays do $array_consulta, que cont�m todos os resultados)
                    foreach($array_consulta[$i] as $chave => $valor){
                        //Se a chave ainda n�o existir, armazena
                        if(empty($array_resultado[$id_atual][$chave]) || $array_resultado[$id_atual][$chave] == 'id'){
                            if( $chave != 'id' || empty($array_resultado[$id_atual]['id']) )
                                $array_resultado[$id_atual][$chave] = $valor;
                        }
                        //Caso a chave j� exista, significa que existem mais resultados para serem armazenados na mesma:
                        //Se ainda n�o for um array, instancia um com o nome da chave
                        elseif( !is_array($array_resultado[$id_atual][$chave]) && $array_resultado[$id_atual][$chave] != $valor )
                        {
                            //recupera o valor armazenado na chave, zera a mesma e a transforma em um array
                            $chave_duplicada = $array_resultado[$id_atual][$chave];
                            empty($array_resultado[$id_atual][$chave]);
                            $array_resultado[$id_atual][$chave] = Array();
                            //armazena o valor antigo na chave
                            array_push($array_resultado[$id_atual][$chave], $chave_duplicada);
                            //armazena o valor novo na chave
                            array_push($array_resultado[$id_atual][$chave], $valor);
                        }
                        //Caso a chave j� seja um array, armazena o valor no mesmo
                        else
                        {
                            if($array_resultado[$id_atual][$chave] != $valor)
                                array_push($array_resultado[$id_atual][$chave], $valor);
                        }
                    }
                 }
            }
            $resultado_consulta->close();
        }
        else
        {
            die(mysqli_error($resultado_consulta));
        }
        
        $numero_de_colunas = count($array_resultado);
        
        $array_resultado['numero_de_colunas'] = Array();
        array_push($array_resultado['numero_de_colunas'], $numero_de_colunas ) ;
        echo json_encode($array_resultado);
    }
    $conexao->close();
}
?>




