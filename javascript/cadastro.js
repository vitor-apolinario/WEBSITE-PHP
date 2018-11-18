document.getElementById("form-cadastro").onsubmit = validaCadastro;

function validarCPF(cpf) {
	cpf = cpf.replace(/[^\d]+/g,'');
	if(cpf == '') return false;
	// Elimina CPFs invalidos conhecidos
	if (cpf.length != 11 ||
		cpf == "00000000000" ||
		cpf == "11111111111" ||
		cpf == "22222222222" ||
		cpf == "33333333333" ||
		cpf == "44444444444" ||
		cpf == "55555555555" ||
		cpf == "66666666666" ||
		cpf == "77777777777" ||
		cpf == "88888888888" ||
		cpf == "99999999999")
			return false;
	// Valida 1o digito
	add = 0;
	for (i=0; i < 9; i ++)
		add += parseInt(cpf.charAt(i)) * (10 - i);
		rev = 11 - (add % 11);
		if (rev == 10 || rev == 11)
			rev = 0;
		if (rev != parseInt(cpf.charAt(9)))
			return false;
	// Valida 2o digito
	add = 0;
	for (i = 0; i < 10; i ++)
		add += parseInt(cpf.charAt(i)) * (11 - i);
	rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(10)))
		return false;
	return true;
}

function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g,'');

    if(cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;

    return true;

}

function validaCadastro(){
	var contErro = 0;

	var nome = document.getElementById("nome");
	var erro_nome = document.getElementById("msg-nome");
	if((nome.value == "") || (nome.value.indexOf(" ") == -1)){
		erro_nome.innerHTML = "Por favor digite o Nome completo";
		erro_nome.style.display = 'block';
		contErro+=1;
	}
	else{
		erro_nome.style.display = "none";
	}
	//valida email
	var email = document.getElementById("email");
	var erro_email = document.getElementById("msg-email");
	if((email.value == "") || (email.value.indexOf("@") == -1)){
		erro_email.innerHTML = "Por favor digite o E-mail";
		erro_email.style.display = 'block';
		contErro+=1;
	}
	else{
		erro_email.style.display = 'none';
	}

    var endereco = document.getElementById("endereco");
	var erro_endereco = document.getElementById("msg-endereco");
	if(endereco.value == ""){
		erro_endereco.innerHTML = "Por favor digite o Endereço completo";
		erro_endereco.style.display = 'block';
		contErro+=1;
	}
	else{
		erro_endereco.style.display = "none";
	}

	// validação do campo senha
	var senha = document.getElementById("senha");
	var erro_senha = document.getElementById("msg-senha");
	if(senha.value == ""){
		erro_senha.innerHTML = "Por favor digite a Senha";
		erro_senha.style.display = 'block';
		contErro+=1;
	}
	else if (senha.value.length < 6){
		erro_senha.innerHTML = "A Senha deve possuir pelo menos 6 caracteres";
		erro_senha.style.display = 'block';
		contErro+=1;
	}
	else{
		erro_senha.style.display = 'none';
	}

	var senha2 = document.getElementById("senha2");
	var erro_senha2 = document.getElementById("msg-senha2");
	if((senha2.value == "") || (senha.value != senha2.value)){
		erro_senha2.innerHTML = "A senha não confere";
		erro_senha2.style.display = 'block';
		contErro+=1;
	}
	else{
		erro_senha2.style.display = 'none';
	}

	// validação da repetição da senha
	var concordo = document.getElementById("concordo");
	var erro_concordo = document.getElementById("msg-concordo");
	if(!concordo.checked){
		erro_concordo.innerHTML = "Você precisa concordar com os termos de uso do site";
		erro_concordo.style.display = 'block';
		contErro+=1;
	}
	else{
		erro_concordo.style.display = 'none';
	}
	tipo = document.getElementById("fl_tipo").value;
	if(tipo == 'c'){
		var cpf = document.getElementById("cpf");
		var erro_cpf = document.getElementById("msg-cpf");
		if(!validarCPF(cpf.value)){
			contErro+=1;
			erro_cpf.innerHTML = "Digite um CPF válido";
			erro_cpf.style.display = 'block';
		}else{
			erro_cpf.style.display = 'none';
		}
	}
	if(tipo == 'e'){
		var cnpj = document.getElementById("cnpj");
		var erro_cnpj = document.getElementById("msg-cnpj");
		if(!validarCNPJ(cnpj.value)){
			contErro+=1;
			erro_cnpj.innerHTML = "Digite um CNPJ válido";
			erro_cnpj.style.display = 'block';
		}else{
			erro_cnpj.style.display = 'none';
		}
	}

	var cidade = document.getElementById("city-select");
	var value = cidade[cidade.selectedIndex].value;
	var erro_cidade = document.getElementById("msg-cidade");
	if(value == ""){
		erro_cidade.innerHTML = "Seleciona um estado e uma cidade";
		erro_cidade.style.display = 'block';
	}else {
		erro_cidade.style.display = 'none';
	}

	var telefone = document.getElementById("telefone").value;
	var erro_tele = document.getElementById("msg-tele");
	if(telefone != parseInt(telefone) || telefone.length < 10){
		erro_tele.innerHTML = "Digite o número de telefone";
		erro_tele.style.display = 'block';
	}else{
		erro_tele.style.display = 'none';
	}

	if(contErro > 0)
		return false;
}

function carregaCidades(uf, id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(id).innerHTML="";
			document.getElementById(id).innerHTML+=this.responseText;
		}
	};
	xhttp.open("GET", "ajax/buscaCidades.php?uf="+uf, true);
	xhttp.send();
}
