import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InnerBlocks } from '@wordpress/block-editor';
import Edit from './edit';

// Register the block
registerBlockType('aquila-blocks/dos-anddonts', {
	title: __("Dos and dont's", 'aquila'),
	icon: 'editor-table',
	description: __('Add heading and text', 'aquila'),
	category: 'aquila',
	edit: Edit,
	save: function () {
		return (
			<div className="aquila-dos-and-donts">
				<InnerBlocks.Content />
			</div>
		);
	},
});
