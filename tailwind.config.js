// tailwind.config.js
module.exports = {
    theme: {},
    variants: {},
    plugins: [


        function ({addUtilities, theme}) {
            const newUtilities = {
                '.grid': {display: 'grid'},
                '.grid-col-1': {'grid-template-columns': '1fr'},
                '.grid-col-2': {'grid-template-columns': '1fr 1fr'},
                '.grid-col-3': {'grid-template-columns': '1fr 1fr 1fr'},

            };


            let paddings = theme('padding');
            for(padding in paddings){
                newUtilities['.grid-gap-' + padding] = {'grid-gap': paddings[padding]};
            }


            addUtilities(newUtilities, {
                variants: ['responsive'],
            })
        }

    ],
};


