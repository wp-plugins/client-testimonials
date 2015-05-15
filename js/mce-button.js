(function() {
	tinymce.PluginManager.add('testimonials_mce_button', function( editor, url ) {
		editor.addButton( 'testimonials_mce_button', {

            title : 'Add Client Testimonials',
			image : url + '/icon.png',
			type: 'menubutton',
			menu: [
				{
					text: 'Client Testimonials Slide',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Client Testimonials Shortcode',
							body: 
							[
								{
									type: 'textbox',
									name: 'items_desktop',
									label: 'Items Desktop',
									value: '1'
								},
								{
									type: 'textbox',
									name: 'items_tablet',
									label: 'Items Tablet',
									value: '1'
								},
								{
									type: 'textbox',
									name: 'items_tablet_small',
									label: 'Items Tablet Small',
									value: '1'
								},
								{
									type: 'textbox',
									name: 'items_mobile',
									label: 'Items Mobile',
									value: '1'
								},
								{
									type: 'textbox',
									name: 'posts_per_page',
									label: 'Total numbers of Testimonials to show',
									value: '-1'
								},
								{
									type: 'listbox',
									name: 'orderby',
									label: 'Order By',
										'values': 
										[
											{text: 'None', value: 'none'},
											{text: 'ID', value: 'ID'},
											{text: 'Date', value: 'date'},
											{text: 'Modified', value: 'modified'},
											{text: 'Rand', value: 'rand'}
										]
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[client-testimonials items_desktop="' + e.data.items_desktop + '" items_tablet="' + e.data.items_tablet + '" items_tablet_small="' + e.data.items_tablet_small + '" items_mobile="' + e.data.items_mobile + '" posts_per_page="' + e.data.posts_per_page + '" orderby="' + e.data.orderby + '"]');
								}
							}
						);
					}
				}, // End Client Testimonials Slide
				{
					text: 'Client Testimonials No Slide',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Client Testimonials Shortcode',
							body: 
							[
								{
									type: 'textbox',
									name: 'testimonial_id',
									label: 'Testimonial ID',
									value: ''
								},
								{
									type: 'textbox',
									name: 'posts_per_page',
									label: 'Total numbers of Testimonials to show',
									value: '1'
								},
								{
									type: 'listbox',
									name: 'orderby',
									label: 'Order By',
										'values': 
										[
											{text: 'None', value: 'none'},
											{text: 'ID', value: 'ID'},
											{text: 'Date', value: 'date'},
											{text: 'Modified', value: 'modified'},
											{text: 'Rand', value: 'rand'}
										]
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '[testimonial testimonial_id="' + e.data.testimonial_id + '" posts_per_page="' + e.data.posts_per_page + '" orderby="' + e.data.orderby + '"]');
								}
							}
						);
					}
				} // End Client Testimonials NO Slide
			]
		});
	});
})();