window.addEventListener('load', function(){
	function requete(nom, cible){
		if (typeof cible === "undefined" ) {
			cible = '';
		};
		document.execCommand(nom, false, cible);	
	}
	document.getElementById('gras').addEventListener('click', function(){
		requete('bold');
	});
});
