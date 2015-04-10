module.exports = function(grunt) {
	grunt.initConfig({
		jshint: {
			options: {
				curly: true,
				eqeqeq: true,
				eqnull: true,
				browser: true,
				globals: {
					jQuery: true
				}
			},
			files: ['admin/themes/jmgroup/js/app/*.js']
		},
		uglify: {
			/*options: {
				mangle: {
			 		except: ['jQuery']
				}
			},*/
			script: {
				files: {
					'admin/themes/jmgroup/js/global.min.js': ['admin/themes/jmgroup/js/app/*.js']
				}
			}/*,
			vendor: {
				files: {
					'admin/themes/jmgroup/js/foundation.min.js': ['admin/themes/jmgroup/js/foundation/*.js']
				}
			}*/
		},
		compass: {
			development: {
				options: {
					sassDir: 'admin/themes/jmgroup/sass/app',
					cssDir: 'admin/themes/jmgroup/css/app'
				}
			},
			vendor: {
				options: {
					sassDir: 'admin/themes/jmgroup/sass/vendor',
					cssDir: 'admin/themes/jmgroup/css/vendor'
				}
			}
		},
		csslint: {
			development:{
				options: {
					'box-sizing': false,
					'star-property-hack': false,
					'floats': false,
					'important': false,
					'font-sizes': false,
					'duplicate-background-images': false,
					'text-indent': false
				},
				src: ['admin/themes/jmgroup/css/app/*.css']
			}
		},
		cssmin: {
			style: {
				files: {
					'admin/themes/jmgroup/css/login.min.css': [
						'admin/themes/jmgroup/css/vendor/normalize.css',
						'admin/themes/jmgroup/css/app/login.css'
					],
					'admin/themes/jmgroup/css/global.min.css': [
						'admin/themes/jmgroup/css/vendor/normalize.css',
						'admin/themes/jmgroup/css/app/global.css'
					]
				}
			},
			vendor: {
				files: {
					'admin/themes/jmgroup/css/foundation.min.css': [
						'admin/themes/jmgroup/css/vendor/foundation.css'
					]
				}
			},
			plugins: {
				files: {
					'admin/themes/jmgroup/css/plugins.min.css': ['admin/themes/jmgroup/css/plugins/*.css']
				}
			}
		},
		watch: {
			script:{
				files: ['<%= jshint.files %>'],
				tasks: ['jshint', 'uglify']
			},
			css:{
				files: ['admin/themes/jmgroup/sass/app/*.scss', 'admin/themes/jmgroup/sass/app/*/*.scss'],
				tasks: ['compass', 'cssmin']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-csslint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.registerTask('default', ['jshint', 'uglify', 'compass', 'csslint', 'cssmin']);
	grunt.registerTask('vendor', ['uglify:vendor', 'compass:vendor', 'cssmin:vendor']);

};