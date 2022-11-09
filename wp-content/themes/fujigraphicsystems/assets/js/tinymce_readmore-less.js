(function() {
    tinymce.PluginManager.add( 'readmore_readless', function( editor, url ) {

        let siteOrigin = document.location.origin;

        // Add Button to Visual Editor Toolbar
        editor.addButton('readmore_readless', {
            text: 'Insert Read More-Less',
            title: 'Insert Read More-Less',
            tooltip: 'Insert read more-less to the content it will cut the content and display read more read less button on mobile view.',
            onclick: function(){
                editor.insertContent('<p id="readmore-less" class="mobile-read-more-less-tag"><img src="'+ siteOrigin + '/wp-includes/js/tinymce/skins/wordpress/images/more.png"></p>');
            }
        });
    });
})();
