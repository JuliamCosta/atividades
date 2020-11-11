<?php
    include "config.php";
    cabecalho();
?>  
    
<h3 class="py-4  font-weight-bold ">Autor</h3>

    <form method="POST" action="lista_autor.php">
        <b>Filtrar por:</b>
        <div>     
            <select name="cod_movimento" id="cod_movimento" class="form-control">
                <option label="::Selecione o Movimento Literário::"></option>';
                    <?php
                    include "conexao.php";
                    $select = "SELECT id_movimento, nome FROM movimento_literario";
                    $resultado = mysqli_query($conexao,$select);
                    while($linha=mysqli_fetch_assoc($resultado)){
                        echo '<option value='.$linha["id_movimento"].'>'.$linha["nome"].'</option>';
                    }
                ?>
            </select>
        </div>
        <div>
                <input type="text" name="nome" placeholder="Nome do Autor..." class="input-control form-control" />
        </div>
        <div>                
            <input type="text" name="sobrenome" placeholder="Sobrenome do Autor..." class="input-control form-control" />
        </div>
     <button id="btn" class="input-control btn btn-secondary">Cadastrar</button>
    </form>
            <table class="table">
                <tr>
                    <th>Autor</th>
                    <th>Movimento Literário</th>
                        
                    </tr>
                    <?php
                        include "conexao.php";
                        $select = "SELECT  autor.nome as autor, sobrenome, movimento_literario.nome as movimento FROM autor INNER JOIN movimento_literario ON movimento_literario.id_movimento = autor.cod_movimento";                    
                        if(!empty($_POST)){
                            if($_POST["cod_movimento"] != ""){
                                $movimento = $_POST["cod_movimento"];
                                $select .= " AND autor.cod_movimento = '$movimento'";
                            }
                            if($_POST["nome"]!=""){
                                $nome = $_POST["nome"];
                                $select .= " AND autor.nome LIKE '%$nome%'";
                            }
                            if($_POST["sobrenome"]!=""){
                                $sobrenome = $_POST["sobrenome"];
                                $select .= " AND autor.sobrenome LIKE '%$sobrenome%'";
                            }
                        }

                        $resultado = mysqli_query($conexao,$select); 
                        
                        while($linha = mysqli_fetch_assoc($resultado)){
                            echo '<tr>
                                    <td style="font-style:italic;">'.$linha["autor"].' '.$linha["sobrenome"].'</td>
                                    <td style="font-style:italic;">'.$linha["movimento"].'</td>
                                </tr>'; 
                        }
                    ?>
                </table>
            </form>
        </div>
    </div>
<?php
    rodape();
?>
     



