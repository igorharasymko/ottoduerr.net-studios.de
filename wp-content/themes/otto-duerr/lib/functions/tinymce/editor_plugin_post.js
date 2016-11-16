// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('shortcode_kaya');
	
	tinymce.create('tinymce.plugins.shortcode_kaya', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('mceshortcode_kaya', function() {
				ed.windowManager.open({
					file : url + '/window_post.php',
					width : 360 + ed.getLang('shortcode_kaya.delta_width', 0),
					height : 210 + ed.getLang('shortcode_kaya.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('shortcode_kaya', {
				title : 'add short code',
				cmd : 'mceshortcode_kaya',
				image : url + '/portfolio.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('shortcode_kaya', n.nodeName == 'IMG');
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'shortcode_kaya',
					author 	  : 'Alex Rabe',
					authorurl : 'http://alexrabe.boelinger.com',
					infourl   : 'http://alexrabe.boelinger.com',
					version   : "2.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('shortcode_kaya', tinymce.plugins.shortcode_kaya);
})();


