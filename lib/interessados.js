function fAlterarValor(valor,email) 
{    
   $("#"+valor.id).removeAttr("readonly"); //retira o somente leitura
   $("#"+valor.id).attr("class","altera"); //muda o estilo
   let campo = valor.id.slice(0,1); //seleciona a primeira letra do ID
   
   //criar um evento para quando for alterado um valor
   $("#"+valor.id).change( function() {    
     if ((campo == "f" && fValidaFone($("#"+valor.id).val())) || (campo == "n" && ($("#"+valor.id).val() != ""))) {
        let acao = "altera_valor.php?email="+email+"&valor="+$("#"+valor.id).val()+"&campo="+campo;
        //console.log(acao);
        //Ajax Alteração dado
        $.get(acao, function(dados, status) {
        //alert(dados);
            if (status == "success") {
                $("#"+valor.id).attr("readonly","");
                $("#"+valor.id).removeAttr("class");
        }
        });  
     } else {
        mostramsg("Verifique se o valor da alteração é valido.");
        $("#dListaInteressados").load('lista_interessados.php');
     }   
   });

   //Ao sair do Input retorna as propriedades
   $("#"+valor.id).blur( function() { 
         $("#"+valor.id).attr("readonly","");
         $("#"+valor.id).removeAttr("class");
     });
}

function fExcluirInteressado(email,l) {
  let acao = "excluir_interessado.php?email="+email;
  //Ajax para excluir o Interessado
  if (window.confirm("*Confirma exclusão*\n Interessado?: "+email)) {
    $.get(acao, function(dados, status){
        if (status == "success") {
            $("#l"+l).remove();
        }
    });  
  }   
}

//Configura uma função no evento onSubit do formulário.
//Para Validação do FORM.
$(document).ready(function(){
    $("#dListaInteressados").load('lista_interessados.php');

    $("#bGravar").click(function(){
        //Chamada da função de Validação do FORM
        if (fValida()) {
            //Chamar o Ajax para Salvar no MySQL.
            $.post("salvar_interessados.php", 
                  {iNome: $('#iNome').val()
                  ,iEmail: $('#iEmail').val()
                  ,iFone: $('#iFone').val()
                  ,sEstado: $('#sEstado').val()
                  ,sCidade: $('#sCidade').val()
                  ,bGravar: $('#bGravar').val()
                  }, function(result){
                      mostramsg(result);
                      $("#dListaInteressados").load('lista_interessados.php');
                  }
            );
        }
        //return true;
    })  

    $("#sEstado").change(function(){
        //Chamar por Ajax a consulta de Estado
        sigla = $("#sEstado").val();
        //console.log("sigla:"+sigla);
        acao = "consulta_cidades.php?estado="+sigla;
        //Limpa <option> do #SCidade
        $("#sCidade").empty();
        $("#sCidade").append("<option value=\"00\">Selecionar</option>");

        //Ajax para carregar cidades
        $.get(acao, function(opcoes, status){
            $("#sCidade").append(opcoes);
        });  
    })
});

