/*
 * Steps for setup
 * 1- sudo npm install
 * 3- grunt watch
 *
 * grunt sprite - Sprite generation. See instruction in components/scss/partials/_sprites.scss
 */
module.exports = function(grunt) {

	var CONFIG = {
		scripts: ['./assets/js/**.js', '!./assets/js/**.min.js'],

		/* Minimize */
		uglify: {
			drop_console: false,
			files: {
			  'assets/js/scripts.min.js': ['assets/js/scripts.js']  // Dest : src
			}
		},

		/* Combine Media Queries */
		cmq: {
			files: {
				'assets/css': ['assets/css/style.css']  // Dest : src
			}
		},

		/* Autoprefixer */
		autoprefixer: {
			browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'],
			files: {
				expand: true,
				flatten: true,
				src: 'assets/css/style.css',
				dest: 'assets/css'
			}
		},

		/* SASS */
		sass: {
			files: {
				'assets/css/style.css': 'components/scss/style.scss',
			},
			options: {
				outputStyle: 'compressed',
				sourceMapRoot: 'assets/css',
			}
		}

	};

	/**
	* @author Lenlay
	* @version 1.0.5
	*/

	/*Init config*/
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-combine-media-queries');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-spritesmith');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	var gruntConfig = {
		pkg: grunt.file.readJSON('package.json'),

		/* Stylesheets START */
		sass: {
			lwp: {
				files: CONFIG.sass.files,
				options: CONFIG.sass.options
			}
		},

		autoprefixer: {
			options: {
				browsers: CONFIG.autoprefixer.browsers,
				map: false
			},
			files: CONFIG.autoprefixer.files
		},

		cmq: {
			options: {
				log: true
			},
			lwp: {
				files: CONFIG.cmq.files
			}
		},

		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'assets/css',
					src: ['*.css', '!*.min.css'],
					dest: 'assets/css',
					ext: '.min.css'
				}]
			}
		},
		/* Stylesheets END */

		sprite:{
			all: {
				src: 'components/icons/*.png',
				dest: 'assets/img/icons/sprite.png',
				destCss: 'components/scss/partials/_sprites.scss',
				cssTemplate: 'components/spriteTemplate.css.handlebars',
				imgPath: '../img/icons/sprite.png'
			}
		},

		uglify: {
			options: {
				compress: {
					drop_console: CONFIG.uglify.drop_console
				}
			},
			dist: {
				files: CONFIG.uglify.files
			}
		},

		watch: {
			sass: {
				files: [
					'components/scss/**/*.scss',
					'components/scss/*.scss'
				],
				tasks: ['sass', 'cmq', 'autoprefixer', 'cssmin'],
				options: {
					interrupt: true,
					nospawn: true
				}
			},

			scripts: {
				files: CONFIG.scripts,
				tasks: ['uglify'],
				options: {
					interrupt: true,
					nospawn: true
				}
			}
		}
	};

	// INIT GRUNT
	grunt.initConfig(gruntConfig);

	grunt.registerTask('default', ['watch']);

};