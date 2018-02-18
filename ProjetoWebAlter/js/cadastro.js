function validacaoCadastro(){
    var a=document.forms["cadastro"]["nome"].value;
    var b=document.forms["cadastro"]["email"].value;
    var c=document.forms["cadastro"]["senha"].value;
    var d=document.forms["cadastro"]["confirmaSenha"].value;
    var e = cadastro.senha.value;
    var f = cadastro.confirmaSenha.value;

    if (a==null || a=="" || b==null || b=="" || c==null || c=="" || d==null || d==""){
        alert("Um ou mais campos vazios! Por favor, verifique e preencha-os!");
        return false;
    } 
    if(e != f){
        alert("A senha não bate. Por favor, digite novamente!");
        return false;
    }
    if(e.length <= 4 || f.length >= 41){
        alert("Tamanho inválido! Digite uma senha entre 5 e 40 caracteres!");
        return false;
    }
    if(a.length>=45 || a.length<=2 || b.length<=8 || b.length>=45){
        alert("Tamanho inválido! Abrevie o nome e/ou utilize outro e-mail!");
        return false;
    }
}

function validacaoRifa(){
    var a=document.forms["rifa"]["titulo"].value;
    var b=document.forms["rifa"]["descricao"].value;
    var c=document.forms["rifa"]["dataP"].value;
    var d=document.forms["rifa"]["dataI"].value;
    var e=document.forms["rifa"]["dataF"].value;
    var f=document.forms["rifa"]["valor"].value;
 
    if (a==null || a=="" || b==null || b=="" || c==null || c=="" || d==null || d=="" || e==null || e=="" || f==null || f==""){
        alert("Um ou mais campos vazios! Por favor, verifique e preencha-os!");
        return false;
    } 

    if(a.length <= 4 || a.length >= 41){
        alert("Tamanho inválido! Digite um título entre 5 e 40 caracteres!");
        return false;
    }
    if(b.length<4 || b.length>=400){
        alert("Tamanho inválido! Insira uma descrição entre 4 e 400 caracteres!");
        return false;
    }
}

function validacaoTipo(){
    var a=document.forms["tipo"]["descricao"].value;
    var b=document.forms["tipo"]["numI"].value;
    var c=document.forms["tipo"]["passo"].value;
    var d=document.forms["tipo"]["quantidade"].value;

    if (a==null || a=="" || b==null || b=="" || c==null || c=="" || d==null || d==""){
        alert("Um ou mais campos vazios! Por favor, verifique e preencha-os!");
        return false;
    } 

    if(a.length <= 4 || a.length >= 41){
        alert("Tamanho inválido! Digite uma descrição entre 5 e 40 caracteres!");
        return false;
    }
    if(b<1 || b.length>=11 || c<1 || c.length>=11 || d<1 || d.length>=11){
        alert("Tamanho inválido! Insira um número com valor maior a 0 e até 10 dígitos!");
        return false;
    }
}

function validacaoPremio(){
    var premio=document.forms["premio"]["descricao"].value;
 
    if (premio==null || premio==""){
        alert("Defina o prêmio a ser sorteado!");
        return false;
    } 
    
    if(premio.length <= 4 || premio.length >= 41){
        alert("Tamanho inválido! Digite uma descrição do prêmio entre 5 e 40 caracteres!");
        return false;
    }
    
}