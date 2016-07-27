function goToMusicDetailPage(artistName, artistAlbums, albumDescription){
	
//create the page html template....dummyUrl just placeholder for backbutton
var moviePage = $("<div data-role='page' data-url=dummyUrl><div data-role='header'><h1>" 
				+ artistName + "</h1></div><div data-role='content'><img border='0' src'"
				+ artistAlbums + "</h1></div><div data-role='content'><img border='0' src'"
				+ albumDescription + "</h1></div><div data-role='content'><img border='0' src'"
				+ artistName + "</h4></div></div>");

//append the new page to the page container
musicPage.appendTo(	$.mobile.pageContainer );

//go to the newly created page
$.mobile.changePage( musicPage);

}