module.exports = function ( grunt ) {

    grunt.initConfig( {
        pkg: grunt.file.readJSON( 'package.json' ),

        pot: {
            options: {
                package_name: 'artfolio',
                package_version: '1.14.11',
                msgid_bugs_address: "https://github.com/artem-solovev/artfolio/issues",
                text_domain: 'artfolio', //Your text domain. Produces my-text-domain.pot
                dest: 'languages/', //directory to place the pot file
                keywords: [ '_e', '__' ], //functions to look for
            },
            files: {
                src:  [ '**/*.php' ], //Parse all php files
                expand: true,
            }
        }


    });

    grunt.loadNpmTasks( 'grunt-pot' );

    grunt.registerTask( 'default', [ 'pot' ]);
};