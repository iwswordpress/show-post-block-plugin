wp.blocks.registerBlockType('ourplugin/are-you-paying-attention', {
	title: 'Are You Paying Attention?',
	icon: 'smiley',
	category: 'common',
	attributes: {
		skyColor: { type: 'string' },
		grassColor: { type: 'string' },
		postId: { type: 'string' },
	},
	edit: function (props) {
		function updateSkyColor(event) {
			props.setAttributes({ skyColor: event.target.value });
		}

		function updateGrassColor(event) {
			props.setAttributes({ grassColor: event.target.value });
		}
		function updatePostId(event) {
			props.setAttributes({ postId: event.target.value });
		}

		return (
			<div>
				<input type='text' placeholder='sky color' value={props.attributes.skyColor} onChange={updateSkyColor} />
				<input
					type='text'
					placeholder='grass color'
					value={props.attributes.grassColor}
					onChange={updateGrassColor}
				/>
				<input type='text' placeholder='postid' value={props.attributes.postId} onChange={updatePostId} />
				{/* Web Component */}
				<show-post-block postid={props.attributes.postId ? props.attributes.postId : '34'}></show-post-block>
			</div>
		);
	},
	save: function (props) {
		return null;
	},
});
