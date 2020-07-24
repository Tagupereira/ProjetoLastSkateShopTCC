<?php

if(isset($_GET['msg']) && !empty($_GET['msg'])){
	if($_GET['msg']==1){
        $msg = $_SESSION['msgok'] = 'Venda efetuada com sucesso';

        echo"
            <div class='msg sucesso alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                    
                </div>
            </div>
        ";    
    }
    if($_GET['msg']==2){
        $msg = $_SESSION['msgok'] = 'Venda não pode ser concluida';
        echo"
            <div class='msg error alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                </div>
            </div>
        ";
    }
    if($_GET['msg']==3){
        $msg = $_SESSION['msgok'] = 'Verifique todos os campos';
        echo"
            <div class='msg info alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                </div>
            </div>
            
        ";

    }
    if($_GET['msg']==4){
        $msg = $_SESSION['msgok'] = 'Você não tem permissão para acessar esta pagina!';
        echo"
            <div class='msg atencao alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                </div>
            </div>
        ";

    }
    if($_GET['msg']==5){
        $msg = $_SESSION['msgok'] = 'Venda cancelada';
        echo"
            <div class='msg error alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                </div>
            </div>
        ";

    }
    if($_GET['msg']=='cadastroOk'){
        $msg = $_SESSION['msgok'] = 'Cadastrado com sucesso!';
        echo"
            <div class='msg sucesso alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                </div>
            </div>
        ";
        unset($msg);
    }
    if($_GET['msg']=='alteradoOk'){
        $msg = $_SESSION['msgok'] = 'Alterado com sucesso!';
        echo"
            <div class='msg sucesso alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                </div>
            </div>
        ";      
    }
    if($_GET['msg']=='excluidoOk'){
        $msg = $_SESSION['msgok'] = 'Excluido com sucesso!';
        echo"
            <div class='msg sucesso alerta' id='msg'>
                $msg
                <div class='fecharAlerta'>
                    <a href='?'><i class='fa fa-close' aria-hidden='true'></i></a>
                </div>
            </div>
        ";
    }
    

}else{

    $_SESSION['msgok'] = " ";

}