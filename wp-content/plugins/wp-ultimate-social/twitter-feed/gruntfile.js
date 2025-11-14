module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

		sass: {
			dist: {
				options: {
					sourcemap: 'auto',
					style: 'expanded'
				},
				files: {
					'css/frontend.css': 'css/frontend.scss'
				}
			} 
		},
		
		autoprefixer:{
			options: {
			  // Task-specific options go here. 
			  map: true
			},
			no_dest: {
			  src: 'css/frontend.css'// Target-specific file lists and/or options go here. 
			},
		},
		
		watch: {
			sass:{
				files:['css/frontend.scss'],
				tasks:['sass'],
			},
			css: {
				files: ['css/frontend.css'],
				tasks: ['autoprefixer'],
			},
			livereload:{
				options: { livereload: true },
      			files: ['css/frontend.css']
			} 

		}

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
	grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['watch']);

};