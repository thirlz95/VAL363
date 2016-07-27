<script type="text/javascript">

$.getJSON("/home/unn_w14040301/public_html/VAL363/music.json", function(artist){
	//start off by getting an empty list every time to get the latest from the server
	$('#artistList').empty();

	//add the music items as list

$.each(artist, function(i, artist){
	$('#artistList').append(generateMusicLink(music));
});

//refresh the list view to show the latest changes
$('artistList').listview('refresh');

});