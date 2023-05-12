const getBlockColumn = (optionVal, colClassName, heading) => {
	return [
		'core/column',
		{ className: colClassName },
		[
			[
				'aquila-blocks/heading',
				{
					className: 'aquila-dos-and-donts__heading',
					option: optionVal,
					content: heading,
				},
			],
			[
				'core/list',
				{
					className: 'aquila-dos-and-donts__list',
				},
			],
		],
	];
};
export const blockColumns = [
	[
		'core/columns',
		{
			className: 'aquila-dos-and-donts__cols',
		},
		[
			getBlockColumn('dos', 'aauila-dos-and-donts_col-one', 'Dos'),
			getBlockColumn('donts', 'aauila-dos-and-donts_col-two', "Dont's"),
		],
	],
];
