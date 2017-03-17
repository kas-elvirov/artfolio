module.exports = function ( grunt ) {

    grunt.initConfig( {
        pkg: grunt.file.readJSON( 'package.json' ),

        pot: {
            options: {
                package_name: 'artfolio',
                package_version: '1.21.53',
                msgid_bugs_address: "https://github.com/artem-solovev/artfolio/issues",
                text_domain: 'artfolio',
                dest: 'languages/',
                keywords: [ '_e', '__' ],
            },
            files: {
                src:  [ '**/*.php' ],
                expand: true,
            }
        }


    });

    grunt.loadNpmTasks( 'grunt-pot' );

    grunt.registerTask( 'default', [ 'pot' ]);
};
