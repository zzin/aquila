/**
 * Register block styles.
 */

import { registerBlockStyle, unregisterBlockStyle } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

/**
 * Quote Block styles.
 *
 * @type {Array}
 */
const layoutStyleQuote = [
	{
		name: 'layout-dark-background',
		label: __('Layout style dark background', 'aquila'),
	},
];

const layoutStyleButton = [
	{
		name: 'layout-border-blue-fill',
		label: __('Blue outline', 'aquila'),
	},
	{
		name: 'layout-border-white-no-fill',
		label: __('White outline - to be used with dark background', 'aquila'),
	},
];

const deRegister = () => {
	unregisterBlockStyle('core/quote', 'plain');
};

const register = () => {
	layoutStyleQuote.forEach((layoutStyle) =>
		registerBlockStyle('core/quote', layoutStyle)
	);
	layoutStyleButton.forEach((layoutStyle) =>
		registerBlockStyle('core/button', layoutStyle)
	);
};

/**
 * Register styles on dom ready.
 */
wp.domReady(() => {
	register();
	deRegister();
});
