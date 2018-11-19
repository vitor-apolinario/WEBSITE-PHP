/*fecha o menu quando carrega a página*/
window.onload = function(){
	var menu=document.getElementsByClassName("menu-opcoes")[0];
	var header=document.getElementsByClassName("c1")[0];

	//se estiver em desktop pula essa parte
	if(screen.width > 500)
		return;

	if(menu.style.display=='none'){
		menu.style.display='block';
		header.style.height='200px';
	}else{
		menu.style.display='none';
		header.style.height='65px';
	}
}

/*fecha/abre o menu de acordo com o click no hamburger*/
document.getElementById("controle-menu").onclick = function(){	
	var menu=document.getElementsByClassName("menu-opcoes")[0];
	var header=document.getElementsByClassName("c1")[0];

	if(menu.style.display=='none'){
		menu.style.display='block';
		header.style.height='200px';
	}else{
		menu.style.display='none';
		header.style.height='65px';
	}
};

function pegarFrete(ciot, cpf){
	if(confirm('Deseja mesmo pegar o frete ' + ciot + '?')){
		var xhttp = new XMLHttpRequest();
	 	xhttp.onreadystatechange = function() {
	 		if (this.readyState == 4 && this.status == 200) {
	 			if(this.responseText == "reload"){
	 				window.location.reload();	
	 			}	 			
	 		}
 		};
		xhttp.open("GET", "ajax/pegaFrete.php?ciot="+ciot+"&cpf="+cpf, true);
		xhttp.send();
	}
}

function finalizarFrete(ciot){
	var x = document.getElementById("andamento"+ciot);
	if(x.innerHTML=="Entrega em andamento"){
		x.innerHTML="Finalizar entrega!";
	}else
		x.innerHTML="Entrega em andamento";

}