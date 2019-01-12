/*if(document.querySelector('#searchMain')){
	var element = document.querySelector('#searchMain');
	if( window.KeyEvent ){
	  var e = document.createEvent('KeyEvents');
	  e.initKeyEvent( 'keydown', true, true, window, false, false, false, false, 13, 0 );
	} 
	else // Для остальных браузеров
	 {
	  var e = document.createEvent('UIEvents');
	  e.initUIEvent( 'keydown', true, true, window, 1 );
	  e.keyCode = 13; // Указываем дополнительный параметр, так как initUIEvent его не принимает
	}
	element.addEventListener('click', function(){
		console.log('a')
		element.parentNode.querySelector('.search-live-field').dispatchEvent(e);
	})
}
var t = new keyboardEvent()
 event = new KeyboardEvent(typeArg, KeyboardEventInit);
*/

  



/*var searchMain = document.querySelector('#searchMain');
searchMain.addEventListener('click', function(){
	fireEvent(searchMain.parentNode.querySelector('.search-live-field'), 'keypress');
})*/

// change library links
if(!location.href.match('kameleoon.com/fr/') ){
	var academieLinks = document.querySelectorAll('a[href="https://www.kameleoon.com/fr/ressources.html"]');
	for(var i = 0; i < academieLinks.length; i++){
		academieLinks[i].href = 'https://www.kameleoon.com/en/library';
    }
}

//add hash to url when you click on tabs
if(document.location.href.match('#menu') ){
	document.querySelector('*[href="'+ document.location.href.match('#menu.+?') +'"').click();
}
if(document.querySelector('.nav.nav-tabs')){
	document.querySelector('.nav.nav-tabs').addEventListener('click', function(e){
		if(e.target.href && e.target.href.match('#menu') ){
			location.hash = e.target.href.match('#menu.+?');
	    }
	})
}


//remove href from Knowledge base menu
document.querySelector('#menu-main > li:first-child > a').removeAttribute('href');

//switch last articles
if(document.querySelector('ul.lastArticles')){
	var changeArticles =  setInterval (function(){
		var ul = document.querySelector('ul.lastArticles');
		var active  = ul.querySelector('.active');
		if(active){
			if(active.nextElementSibling){
				$('ul.lastArticles .active + * a').trigger('click');
				//document.body.click();
				//active.nextElementSibling.querySelector('a').mouseenter();
			}
			else{
				$('ul.lastArticles li:first-child a').trigger('click');
				//document.body.click();
				//ul.querySelector('li:first-child a').mouseenter();
			}
		}
		
	},4000);
	var ulArticles = document.querySelector('ul.lastArticles');
	ulArticles.addEventListener('click', function(e){
		if(e.target.tagName == 'A' && e.isTrusted){
			clearInterval(changeArticles);
		}
	})

}

/*delete last > in the breadcrumb*/
if (document.querySelector('.tree')){
	document.querySelector('.tree a:last-child').nextSibling.data = '';
}

/*header for all devices*/

fixHeaderMobile();
fixHeaderDesktopSmall();

function fixHeaderMobile(){
	if ( (device.tablet()||device.mobile() ) && (document.documentElement.offsetWidth > 1200)){
		if (document.querySelector('#menu-main > .menu-item-has-children a') ){
			var allLinks = document.querySelectorAll('#menu-main > .menu-item-has-children > a');
			for (i = 0; i < allLinks.length; i++){
				allLinks[i].style.zIndex = '-1';
				allLinks[i].parentNode.parentNode.style.zIndex = '0';
			}
		}
	}
}
function fixHeaderDesktopSmall(){
	if ( device.desktop()  && (document.documentElement.offsetWidth < 1200)){
		if (document.querySelector('.menu-item-has-children') ){
			var script = '<style>'
			+'nav#header .menu li:hover .nav-sub{'
			+'display:none'
			+'} '
			+'nav#header .menu li:focus .nav-sub{'
			+'display:block'
			+'} '
			/*+'nav#header.scrolled .menu .nav-sub .menu-item-has-children:hover .nav-sub{' 
			+'display:none'
			+'} '
			+'nav#header.scrolled .menu .nav-sub .menu-item-has-children:focus .nav-sub{' 
			+'display:block'
			+'}'*/
			+'.menu-item-has-children:focus{'
			+'outline:none'
			+'}'
			+'</style>';
			document.body.insertAdjacentHTML('beforeend', script);
			var allLi = document.querySelectorAll('.menu-item-has-children');
			for (i = 1; i <= allLi.length; i++){
				allLi[i-1].setAttribute('tabindex', i);
			}
		}
	}
}
/*END header for all devices*/




/*load images*/

if(document.images){
	if(document.querySelector('.site-content .searchBox') ){
		var searchBox = document.querySelector('.site-content .searchBox');
		var found = getComputedStyle(searchBox).backgroundImage.indexOf('/img/');
		var urlIndex = getComputedStyle(searchBox).backgroundImage.indexOf('http');
		var pic1=new Image(); 
		pic1.src=getComputedStyle(searchBox).backgroundImage.slice(urlIndex, found+5) + 'hp-bg.png';
		var pic2=new Image(); 
		pic2.src=getComputedStyle(searchBox).backgroundImage.slice(urlIndex, found+5) + 'background_audiences.png';
		var pic3=new Image(); 
		pic3.src=getComputedStyle(searchBox).backgroundImage.slice(urlIndex, found+5) + 'background_perso.png';
	}
}

/*cross in the main search*/
if (document.querySelector('.searchBox input.search-live-field')) {
	var searchInput = document.querySelector('.searchBox input.search-live-field');
	searchInput.addEventListener('input', function(){
		if(document.querySelector('.searchBox input.search-live-field').value){
			document.querySelector('#closeMain').style.display = 'block';
		}
		else{
			document.querySelector('#closeMain').style.display = '';
		}
	});
}
if (document.querySelector('#closeMain')) {
	document.querySelector('#closeMain').addEventListener('click', function(){
		document.querySelector('.searchBox input.search-live-field').value = '';
		document.querySelector('.searchBox input.search-live-field').focus();
		document.querySelector('#searchMain').style.display = 'block';
		document.querySelector('#closeMain').style.display = 'none';
	})
}
/*END cross in the main search*/

/*search live search placeholder*/
if (document.location.href.match('/de/')) {
	if (document.querySelectorAll('input.search-live-field')) {
		var allSearchInput = document.querySelectorAll('input.search-live-field');
		for (i = 0; i < allSearchInput.length; i++){
			allSearchInput[i].placeholder = 'Suche. . .' 
		}
	}
}
if (document.location.href.match('/fr/')) {
	if (document.querySelectorAll('input.search-live-field')) {
		var allSearchInput = document.querySelectorAll('input.search-live-field');
		for (i = 0; i < allSearchInput.length; i++){
			allSearchInput[i].placeholder = 'Recherche. . .' 
		}
	}
}

/*add class to the lastArticle container in the homepage*/
if (document.querySelector('#article1')){
	document.querySelector('#article1').className += ' in active';
/*document.querySelector('#article1').classList.add('in active');*/
}
/*delete background if we have thumbnail denires publications*/
if (document.querySelector('.linksContainer .imgBlock img')) {
	var images = document.querySelectorAll('.linksContainer .imgBlock img');
	for (i = 0; i < images.length; i++){
		//images[i].parentNode.style.backgroundImage = 'none';
		images[i].parentNode.style.backgroundImage = 'url('+images[i].src+')';
		images[i].parentNode.style.backgroundSize = 'cover';
		images[i].parentNode.style.backgroundPositionY = 0;
		images[i].style.display = 'none';
	}
}

/*wp-admin delete space*/
if (document.querySelector('#wpadminbar')) {
	if (document.querySelector('.searchBox')) {
		document.querySelector('.searchBox').style.marginTop = '58px';
	}
}

/*search box in the header*/
/*setTimeout(function(){
	var resultBox = document.querySelectorAll('.algolia-autocomplete'),
		flag =	document.querySelector('.qtranxs_widget .active');
	if (resultBox) {
	resultBox[0].classList.add('auto-left');
	resultBox[0].style.right = document.body.offsetWidth - flag.getBoundingClientRect().left + 35 + 'px';
	}
}, 100)*/

/*add hr to the header*/
var liHeader = document.querySelectorAll('.container_right >ul> li')
if (liHeader) {
	for (var i = 0; i < liHeader.length - 1; i++) {
		liHeader[i].insertAdjacentHTML('afterend', '<hr>');
	}
}

/*SEARCH PANEL IN THE HEADER*/
var searchImg = document.querySelector('#search'),
	cross = document.querySelector('#closeSmall'),
	searchInput = document.querySelector('.searchBar input[type="search"]'),
	searchBar = document.querySelector('.searchBar');
if ( (searchImg !== null) &&  (cross !== null) && (searchInput !== null) && (searchBar !== null) ) {
	searchImg.addEventListener('click', function(){
		if(document.documentElement.offsetWidth > 1200){
			searchBar.style.width = searchImg.getBoundingClientRect().right - document.querySelector('.container_right .menu > li:last-child > a').getBoundingClientRect().right  + 'px';
		}
		else{
			searchBar.style.width = searchImg.getBoundingClientRect().right - document.querySelector('.container_left').getBoundingClientRect().right -15 + 'px';
		}
		searchImg.style.display = 'none';
		searchBar.style.display = 'block';
		searchInput.focus();
	});
	cross.addEventListener('click', function(){
		if (document.querySelector('.searchBar input[type="search"]').value){
			searchInput.value = '';
			searchInput.focus();
		}
		else{
			searchImg.style.display = 'block';
			searchBar.style.display = 'none';
		}
	});
	window.addEventListener('resize', function(){
		if(searchBar.style.width){
			if (document.documentElement.offsetWidth > 1199) {
				searchBar.style.width = document.querySelector('.qtranxs_widget').getBoundingClientRect().left - document.querySelector('.container_right .menu > li:last-child > a').getBoundingClientRect().right -25  + 'px';
			}
			else{
				searchBar.style.width = document.documentElement.offsetWidth - document.querySelector('.container_left').getBoundingClientRect().right -40 + 'px';
			}		
		}
	});
	searchInput.addEventListener('blur', function(){
		setTimeout(function(){
			if (document.activeElement != searchInput){
				searchBar.style.display = 'none';
				document.querySelector('#ajaxsearchliteres1').style.display = 'none';
				if(document.querySelector('.searchBox')){
					if (document.documentElement.scrollTop < 300) {
						return;
					}
				}
				searchImg.style.display = 'block';
			}
		},500);
	})
}


/*changing font-weight of a in the nav in the homepage */
if (document.querySelector('.tabs .nav-tabs') !== null) {
	document.querySelector('.tabs .nav-tabs').addEventListener('click', function(e){
		if (e.target.tagName != 'A') return;
		if (document.querySelector('.nav-tabs .active a')) {
		    setTimeout(function(){
		      var subLinks =   document.querySelectorAll('#menu-main .nav-sub li a');
		      for (var i = 0; i < subLinks.length; i++) {
		        subLinks[i].style.fontWeight = '';
		         if (subLinks[i].innerHTML == document.querySelector('.nav-tabs .active a').textContent) {
		          subLinks[i].style.fontWeight = '600';
		         }
		      }
		    },0);
		}
		if(document.querySelector('.site-content .searchBox') ){
			var searchBox = document.querySelector('.site-content .searchBox');
			var found = getComputedStyle(searchBox).backgroundImage.indexOf('/img/');

			if (e.target.href.indexOf('#menu1') != -1)  {
				searchBox.style.backgroundImage = getComputedStyle(searchBox).backgroundImage.slice(0, found+5) + 'hp-bg.png';
			};
			if (e.target.href.indexOf('#menu2') != -1)  {
				var links = document.querySelectorAll('.tab-content #menu2 .categoryLink a');
				for (i = 0; i < links.length; i++){
					links[i].className ='perso';
				}
				searchBox.style.backgroundImage = getComputedStyle(searchBox).backgroundImage.slice(0, found+5) + 'background_perso.png';
			};

			if (e.target.href.indexOf('#menu3') != -1) {
				var links = document.querySelectorAll('.tab-content #menu3 .categoryLink a');
				for (i = 0; i < links.length; i++){
					links[i].className ='aud';
				}
				searchBox.style.backgroundImage = getComputedStyle(searchBox).backgroundImage.slice(0, found+5) + 'background_audiences.png';
			}
		}
	});
}

if (document.querySelector('.nav-tabs .active a')) {
	var subLinks = document.querySelectorAll('#menu-main .nav-sub li a');
    for (var i = 0; i < subLinks.length; i++) {
       if (subLinks[i].innerHTML == document.querySelector('.nav-tabs .active a').textContent) {
        subLinks[i].style.fontWeight = '600';
       }
    }
}


/*category for Mobile change h2 content*/
if (document.querySelector('.nav-tabs .active a')) {
	if ( document.querySelector('.categoryForMobile h2') ){
		document.querySelector('.categoryForMobile h2').textContent = document.querySelector('.nav-tabs .active a').textContent;
		document.querySelector('.categoryForMobile h2').style.color = getComputedStyle(document.querySelector('.nav-tabs .active a')).borderColor;
	}

	document.querySelector('.tabs .nav-tabs').addEventListener('click', function(e){
		if (document.querySelector('.nav-tabs .active a')) {
			setTimeout(function(){
			document.querySelector('.categoryForMobile h2').textContent = document.querySelector('.nav-tabs .active a').textContent
			document.querySelector('.categoryForMobile h2').style.color = getComputedStyle(document.querySelector('.nav-tabs .active a')).borderColor;
			 },0);
		};
	})
}
/* END category for Mobile change h2 content*/

/*search tool with a scroll*/
window.addEventListener('scroll',  function(){
	if(document.querySelector('#search')){
		if (document.documentElement.scrollTop > 300) {
			if (! (document.querySelector('.searchBar').offsetWidth)) {
				document.querySelector('#search').style.display = 'block';
			}
		}
		else{
			if ((document.querySelector('.searchBox')) ) {
				document.querySelector('#search').style.display = '';
			}	
		}
	}
});


/*color of links in the linksContainer*/
if (document.querySelector('.tabs .nav-tabs .col-xs-4:nth-child(2)') !== null) {
	if (document.querySelector('.tabs .nav-tabs .col-xs-4:nth-child(2)').classList.contains('active'))  {
		var links = document.querySelectorAll('.tab-content #menu2 .categoryLink a');
		for (i = 0; i < links.length; i++){
			links[i].className = 'perso';
		}
	};
}
if (document.querySelector('.tabs .nav-tabs .col-xs-4:nth-child(3)') !== null) {
	if (document.querySelector('.tabs .nav-tabs .col-xs-4:nth-child(3)').classList.contains('active'))  {
		var links = document.querySelectorAll('.tab-content #menu3 .categoryLink a');
		for (i = 0; i < links.length; i++){
			links[i].className = 'aud';
		}
	}
}

	
/*sidebar Tags links*/
var links = document.querySelector('.links');
if(links){
	links.style.maxHeight = document.documentElement.clientHeight - document.querySelector('#header').clientHeight - 20 +'px';
	/*links.style.top = document.querySelector('.innerArticle').getBoundingClientRect().top + document.documentElement.scrollTop + 'px';*/
	var articleContent = document.querySelector('.contentArticle'),
	allNodes = articleContent.querySelectorAll('*');
	nodesH = Array.from(allNodes).filter(function(node) {
			return ( ((node.tagName =='H1') || (node.tagName =='H2') || (node.tagName =='H3')) && (!node.parentNode.classList.contains('info')) );
	});
	for(i = 0; i < nodesH.length; i++){
		nodesH[i].id = "a"+i;
	}
	var i = 0;
	while (document.querySelector('#a'+i)!==null) {
		links.style.display = 'block';
		/*for normal scroll*/
		document.querySelector('#a'+i).style.marginTop = '-80px';
		document.querySelector('#a'+i).style.paddingTop = '100px';
		/*for normal scroll*/
		var a = document.createElement('a');
		var tag = document.createElement(document.querySelector('#a'+i).tagName);
		a.href = '#a'+i;
		a.insertAdjacentElement('beforeend',tag);
		tag.innerHTML =  document.querySelector('#a'+i).innerHTML;
		var div = document.createElement('div');
		div.innerHTML = a.outerHTML;
		document.querySelector('.links').insertAdjacentElement('beforeend',div);
		i++;
	}
	var offset = document.querySelector('.innerArticle').getBoundingClientRect().top
	links.style.top = offset + 'px';
	links.style.left = document.querySelector('.innerArticle').getBoundingClientRect().right + 10 +'px';
	window.addEventListener('resize', function(){
		var offset = document.querySelector('.innerArticle').getBoundingClientRect().top
		links.style.top = offset + 'px';
		links.style.left = document.querySelector('.innerArticle').getBoundingClientRect().right + 10 +'px';
	})
	window.addEventListener('scroll',  function(){
		if (document.documentElement.scrollTop > offset - document.querySelector('#header').offsetHeight -10){
			links.style.position = 'fixed';
			links.style.top = document.querySelector('#header').offsetHeight +10 + 'px';
		}
		else{
			links.style.position = 'absolute';
			links.style.top = offset + 'px';

		}
		var footer = document.querySelector('.footer');
		if (footer.getBoundingClientRect().top < links.getBoundingClientRect().bottom) {
			links.style.maxHeight = links.getBoundingClientRect().bottom - document.querySelector('#header').clientHeight - 15 +'px';
		}
		else if (footer.getBoundingClientRect().top - links.getBoundingClientRect().bottom >100){
			links.style.maxHeight = document.documentElement.clientHeight - document.querySelector('#header').clientHeight - 20 +'px';
		}
	})
}
/*END sidebar Tags links*/


/*icons*/
if (document.querySelector('.contentArticle .info')) {
	if (document.querySelector('.contentArticle .info h1')) {
		var minute = document.querySelector('.contentArticle .info h1').classList[0];
		if (document.querySelector('.icons .howLong')){
			document.querySelector('.icons .howLong').textContent = minute;
		}
	}
	if (document.querySelector('.contentArticle .info h2')) {
		if (document.querySelector('.contentArticle .info h2').classList[0] == 1) {
			document.querySelector('.icons .quizBlock').style.display = 'block'
		} 
	}
	if (document.querySelector('.contentArticle .info h3')) {
		var level = document.querySelector('.contentArticle .info h3').classList[0] 
		if(document.querySelector('.complexity')){
			var found = document.querySelector('.complexity').src.indexOf('level');
			document.querySelector('.complexity').src = document.querySelector('.complexity').src.slice(0, found + 5) + level + '.png';
			/*document.querySelector('.complexity').src = "<?php bloginfo('template_directory'); ?>/img/level"+level+".png";*/
		}
	}
}


/*icons in category*/
/*var allArticlesFull = document.querySelectorAll('.fullText'),
	allArticles = document.querySelectorAll('.articleContainer .article');*/

if ( (document.querySelector('.fullText')) && (document.querySelector('.articleContainer .article')) ) {
	var allArticlesFull = document.querySelectorAll('.fullText'),
	allArticles = document.querySelectorAll('.articleContainer .article');
	for(i = 0; i < allArticlesFull.length; i++ ){
		if (allArticlesFull[i].querySelector('.info')) {
			if (allArticlesFull[i].querySelector('.info h1')) {
				var minute = allArticlesFull[i].querySelector('.info h1').classList[0];
				if (allArticles[i].querySelector('.icons .howLong')){
					allArticles[i].querySelector('.icons .howLong').textContent = minute;
				}
			}
			if (allArticlesFull[i].querySelector('.info h2')) {
				if (allArticlesFull[i].querySelector('.info h2').classList[0] == 1) {
					allArticles[i].querySelector('.icons .quizBlock').style.display = 'block'
				} 
			}
			if (allArticlesFull[i].querySelector('.info h3')) {
				var level = allArticlesFull[i].querySelector('.info h3').classList[0]; 
				if(allArticles[i].querySelector('.complexity')){
					var found = allArticles[i].querySelector('.complexity').src.indexOf('level');
					allArticles[i].querySelector('.complexity').src = allArticles[i].querySelector('.complexity').src.slice(0, found + 5) + level + '.png';
					/*document.querySelector('.complexity').src = "<?php bloginfo('template_directory'); ?>/img/level"+level+".png";*/
				}
			}
		}
		allArticlesFull[i].remove();
	}
}



/*icons in latest publications*/
if ( (document.querySelector('.fullText')) && (document.querySelector('.lastArticles .tab-pane')) ) {
	var allArticlesFull = document.querySelectorAll('.fullText'),
	allArticles = document.querySelectorAll('.lastArticles .tab-pane');
	for(i = 0; i < allArticlesFull.length; i++ ){
		if (allArticlesFull[i].querySelector('.info')) {
			if (allArticlesFull[i].querySelector('.info h1')) {
				var minute = allArticlesFull[i].querySelector('.info h1').classList[0];
				if (allArticles[i].querySelector('.icons .howLong')){
					allArticles[i].querySelector('.icons .howLong').textContent = minute;
				}
			}
			if (allArticlesFull[i].querySelector('.info h2')) {
				if (allArticlesFull[i].querySelector('.info h2').classList[0] == 1) {
					allArticles[i].querySelector('.icons .quizBlock').style.display = 'block'
				} 
			}
			if (allArticlesFull[i].querySelector('.info h3')) {
				var level = allArticlesFull[i].querySelector('.info h3').classList[0]; 
				if(allArticles[i].querySelector('.complexity')){
					var found = allArticles[i].querySelector('.complexity').src.indexOf('level');
					allArticles[i].querySelector('.complexity').src = allArticles[i].querySelector('.complexity').src.slice(0, found + 5) + level + '.png';
					/*document.querySelector('.complexity').src = "<?php bloginfo('template_directory'); ?>/img/level"+level+".png";*/
				}
			}
		}
		allArticlesFull[i].remove();
	}
}
/*img in category and search page*/
var imgContainers = document.querySelectorAll('.article .thumbnail');
if (imgContainers){
	for (i = 0; i < imgContainers.length; i++){
		if (! imgContainers[i].querySelector('img')){
			/*var img = document.createElement('img');
			var found = document.querySelector('#search').src.indexOf('img/');
			img.src = document.querySelector('#search').src.slice(0, found + 4) +'logo-kam.png';
			imgContainers[i].firstChild.insertAdjacentElement('afterbegin', img);*/
			imgContainers[i].style.display = 'none';
		}
	}
}


/*if ( document.querySelectorAll('form.search-form input.search-field') ){
	(function(){
		var allInputs = document.querySelectorAll('form.search-form input.search-field');
		for (i = 0 ; i < allInputs.length; i++){
			allInputs[i].addEventListener('input', function(){
												var allSearchBoxes = document.querySelectorAll('.algolia-autocomplete .aa-dropdown-menu');
				setTimeout(function(){

					var allTitles = document.querySelectorAll('.algolia-autocomplete .aa-dropdown-menu .suggestion-post-title');
					for (i = 0; i < allTitles.length; i++){
						var span = document.createElement('span');
						span.innerHTML = allTitles[i].textContent;
						if (1==1) { <?php echo "ok" ?>;}
						allTitles[i].insertAdjacentElement('afterend', span);
					}
					
				}, 600)  
			})
		}
	}) ();
}*/


/*show when hover qTranslate*/
if(document.querySelector('.language-chooser')){
	var ul = document.querySelector('.language-chooser');
	ul.addEventListener('mouseover', function(){
		var b = ul.querySelectorAll('li');
		for (i = 0; i < b.length; i++){
			b[i].style.display = 'block';
		}
	});
	ul.addEventListener('mouseout', function(){
		var b = ul.querySelectorAll('li');
		for (i = 0; i < b.length; i++){
			b[i].style.display = '';
		}
	})
}
/* active Element on the first part qTranslate*/
if (document.querySelector('.language-chooser .active')) {
	document.querySelector('.language-chooser .active').parentNode.insertAdjacentElement('afterbegin', document.querySelector('.language-chooser .active'));
	document.querySelector('.language-chooser .active a').href = '#';
}

/*toogler in the header on mobile*/
if(document.querySelector('button.navbar-toggle')){
	document.querySelector('button.navbar-toggle').addEventListener('click', function(){
		if(document.querySelector('#menu-main')){
			var mobileMenuVisibility = document.querySelector('#menu-main');
			var widgetLanguage = document.querySelector('.qtranxs_widget');
			mobileMenuVisibility.style.display = (mobileMenuVisibility.style.display == '') ?  'block' : '';
			widgetLanguage.style.display = (widgetLanguage.style.display == '') ?  'block' : '';
		}
	})
}



//hover complexity
if(document.querySelector('img.complexity')){ 
	var allRating = document.querySelectorAll('img.complexity');
	for (var i = 0; i < allRating.length; i++){
		addHint(allRating[i]);
	}
 	function addHint(elem){
		if(document.location.href.match('/fr/')){
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level1.png') {
				var text = 'Niveau : débutant';
			}
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level2.png') {
				text = 'Niveau: moyen';
			}
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level3.png') {
				text = 'Niveau : avancé';
			}
		}else if(document.location.href.match('/en/')){
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level1.png') {
				text = 'Level: Beginner';
			}
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level2.png') {
				text = 'Level: Intermediate';
			}
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level3.png') {
				text = 'Level: Advanced';
			}
		}else if(document.location.href.match('/de/')){
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level1.png') {
				text = 'Niveau: Anfänger';
			}
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level2.png') {
				text = 'Niveau: Grundkenntnissen';
			}
			if(elem.src == 'https://help.kameleoon.com/wp-content/themes/kameleoonNew/img/level3.png') {
				text = 'Niveau: Fortgeschritten';
			}
		}
		var wrapper = document.createElement('div');
		wrapper.className = 'wrapper';
		var icons = elem.parentNode;
		icons.appendChild(wrapper);
		var hint = document.createElement('span');
		hint.className = 'hint';
		hint.textContent = text;
		wrapper.appendChild(hint);
		wrapper.appendChild(icons.querySelector('.complexity'));
		if(getComputedStyle(elem).float =='right' ){
			hint.style.right = '0';
		}
	}
	
}
/*
// change order of topics
if(document.querySelector('#menu1 .rowFirst')){
	var allLinks = document.querySelectorAll('#menu1 .rowFirst .categoryLink a');
	var arrOfLinks = [];
	for(var i = 0; i < allLinks.length; i++){
		arrOfLinks.push(allLinks[i].outerHTML);
	}
	var allCategories = document.querySelectorAll('#menu1 .rowFirst .categoryLink');
	allCategories[0].innerHTML = arrOfLinks[getIndex(arrOfLinks, 'premiers-pas')];
	allCategories[2].innerHTML = arrOfLinks[getIndex(arrOfLinks, 'analyse-des-resultats')];
	allCategories[4].innerHTML = arrOfLinks[getIndex(arrOfLinks, 'ciblage-et-deviation')];

	allCategories[1].innerHTML = arrOfLinks[getIndex(arrOfLinks, 'b-a-ba-du-test-ab')];
	allCategories[3].innerHTML = arrOfLinks[getIndex(arrOfLinks, 'test-a-b-en-detail')];
	allCategories[5].innerHTML = arrOfLinks[getIndex(arrOfLinks, 'mon-compte-kameleoon')];
	function getIndex(arr, text){
		for (var a = 0; a < arr.length; a ++){
			if(~arr[a].indexOf(text)){
				return a;
			}
		}
	}

}*/

// scroll on article page green links on the right
if(document.querySelector('.links')){
	window.addEventListener('scroll', function(){
		var elem = document.elementFromPoint(window.innerWidth/2, 120);
		if(elem.id && elem.id.match(/a\d/) && !~document.querySelector('*[href="#'+ elem.id + '"]').className.indexOf('green') && document.querySelector('*[href="#'+ elem.id + '"] > *').offsetHeight){
			if(document.querySelector('.green') ){
				document.querySelector('.green').className = '';
	        }
			document.querySelector('*[href="#'+ elem.id + '"] > *').className = 'green';
	    }
	})
}