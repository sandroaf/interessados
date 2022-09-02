function mostramsg(msg) {
    $("#dMsg").html(msg);
    setTimeout(() => {
        $("#dMsg").text("");
    }, 4000);
}

function fValidaEmail(vemail) {    
    var re = /^[\w+.]+@\w+\.\w{2,}(?:\.\w{2})?$/;
    // console.log(vemail," - ",re.test(vemail));
    return(re.test(vemail))
}

function fValidaFone(vfone) {    
    var re = /^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/;
    //console.log(vfone," - ",re.test(vfone));
    return(re.test(vfone))
}

//Função que faz a valiação do FORM ainda no Browser do Cliente
function fValida() {
    //Carrego valores do FORM para Variáveis
    const vnome=$("#iNome").val();
    const vemail=$("#iEmail").val();
    const vfone=$("#iFone").val();
    const vestado=$("#sEstado").val();
    const vcidade=$("#sCidade").val();

    let valido = true; //variavel para controlar validação

    //Verificar Nome foi preenchido
    if (vnome == "") {
        mostramsg("Nome é Obrigatório");
        $("#iNome").focus();
        valido = false;
    } else if (!fValidaEmail(vemail)) { //Chama função de Validação e-mail
        mostramsg("e-mail Inválido");
        $("#iEmail").focus();
        valido = false;
    } else if (!fValidaFone(vfone)) { //Chama função de Validação Fone
        mostramsg("Fone Inválido");
        $("#iFone").focus();
        valido = false;
    } else if (vestado == "00") { //Testa se Estado foi selecionado
        mostramsg("Estado Inválido");
        $("#sEstado").focus();
        valido = false;
    } else if (vcidade == "00") { //Testa se Cidade foi selecionada
        mostramsg("Cidade Inválido");
        $("#sCidade").focus();
        valido = false;
    }
    return(valido);
}
