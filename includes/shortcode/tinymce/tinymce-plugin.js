(function() {
    tinymce.create('tinymce.plugins.Kwpborgs_Gallery_Shortcode', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init: function(ed, url) {
            ed.addCommand('kwpborgs_gallery_cmd', function() {
                tb_show('Insert Shortcode', 'admin-ajax.php?action=admin_shortcode_popup&nonce=' + kwpborgs_gallery_tinymce.ajax_nonce);
                //add class to thickbox for style scrollbars
                jQuery("#TB_window").addClass("tinymce-plugin-form");
            });
            ed.addButton('kwpborgs_gallery_tinymce', {
                title: 'Insert CONF Kwpborgs Gallery Shortcode',
                cmd: 'kwpborgs_gallery_cmd',
                icon: 'icon dashicons-layout'
            });
        },
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl: function(n, cm) {
            return null;
        },
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo: function() {
            return {
                longname: 'CONF Kwpborgs Gallery',
                author: 'KWProductions Co.',
                authorurl: 'https://extensions.kwproductions121.ir',
                infourl: 'http://wiki.moxiecode.com/',
                version: "1.0.0"
            };
        }
    });
    // Register plugin
    tinymce.PluginManager.add('kwpborgs_gallery_tinymce', tinymce.plugins.Kwpborgs_Gallery_Shortcode);
})();