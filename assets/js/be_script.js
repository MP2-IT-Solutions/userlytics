function clickTab(id){
	
	//HIDE/DISPLAY TABS
	document.getElementById('tab1').style.display = 'none';
	document.getElementById('tab2').style.display = 'none';
	document.getElementById('tab3').style.display = 'none';
	document.getElementById('tab4').style.display = 'none';
	document.getElementById('tab'+id).style.display = 'block';
	
	//TAB-CONTROL
	document.getElementById('nav1').className  = '';
	document.getElementById('nav2').className  = '';
	document.getElementById('nav3').className  = '';
	document.getElementById('nav4').className  = '';
	document.getElementById('nav'+id).className  = 'active';
	
}