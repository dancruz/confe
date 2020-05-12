tinyMCE_GZ.init({
		plugins : "emotions,spellchecker,advhr,insertdatetime,preview",
		themes : 'simple,advanced',
        languages : 'en',
        disk_cache : true,
        debug : false
});
tinymce.init({
    selector: "textarea",
    theme: "modern",
    width: 1000,
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "include/tinymce/css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
 
$.fx.speeds._default = 100;
jQuery.fn.asError = function() {
	return this.each(function() {
		$(this).replaceWith(function(i, html) {
			var newHtml = "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>";
			newHtml += "<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'>";
			newHtml += "</span>";
			newHtml += html;
			newHtml += "</p></div>";
			return newHtml;
		});
	});
};
 
jQuery.fn.asHighlight = function() {
	return this.each(function() {
		$(this).replaceWith(function(i, html) {
			var newHtml = "<div class='ui-state-highlight ui-corner-all' style='padding: 0 .7em;'>";
			newHtml += "<p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'>";
			newHtml += "</span>";
			newHtml += html;
			newHtml += "</p></div>";
			return newHtml;
		});
	});
};
$(function() {
	$( ".confirmacion" ).dialog({
		autoOpen: true,
		minHeight: 30,
		minWidth: 340,
		show: "blind",
		hide: "blind",
		modal: true,
		  buttons: {
			Aceptar: function() {
			  $( this ).dialog( "close" );
			}
		  }
	});
});