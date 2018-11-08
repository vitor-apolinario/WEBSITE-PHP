document.getElementById("form-cadastro").onsubmit = validaCadastro;

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
	
	if(contErro > 0)
		return false;
}

function carregaCidades(uf){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("city-select").innerHTML+=this.responseText;
		}
	};
	xhttp.open("GET", "ajax/buscaCidades.php?uf="+uf, true);
	xhttp.send();
}

function tipoUsuario(fl_tipo){
	if (fl_tipo == "C") {
		document.getElementById("c1").disabled = false;
		document.getElementById("c2").disabled = false;
		document.getElementById("c3").disabled = false;
		document.getElementById("datanasc").disabled = false;
	}else{
		document.getElementById("c1").disabled = true;
		document.getElementById("c2").disabled = true;
		document.getElementById("c3").disabled = true;
		document.getElementById("datanasc").disabled = true;
	}

}







