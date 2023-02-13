/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        './node_modules/tw-elements/dist/js/**/*.js',
    ],

    theme: {
        extend: {
            colors : {
                'primary' : {
                    DEFAULT : '#065fd4',
                    300 : '#065fd44d',
                    500 : '#065fd4a3',
                    700 : '#065fd4cc',
                    900: '#065fd4ee',
                    'strong' : '#0625d4',
                },
                'purple' : {
                    DEFAULT : '#583469',
                    300 : '#3f3162',
                },
                'dark': {
                    DEFAULT : '#1a1a1a',
                }
            },
        },
    },

    darkMode: ['class'],

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require('tw-elements/dist/plugin'),
    ],
};