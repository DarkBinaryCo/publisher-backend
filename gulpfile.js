const gulp = require('gulp');
const babel = require('gulp-babel'); // ES6 support
const concat = require('gulp-concat');
const imageMin = require('gulp-imagemin');
const purgeCSS = require('gulp-purgecss');
const uglifyCSS = require('gulp-uglifycss');
const uglifyJS = require('gulp-uglify');

// Codeigniter views directory
const CI_VIEW_DIRECTORIES = ['ci/application/views/*.php', 'ci/application/views/**/*.php'];

//* GULP FUNCTIONS
// Optimize images
const optimizeImages = () => {
	return gulp.src('_dev/img/*')
		.pipe(imageMin())
		.pipe(gulp.dest('public/assets/img'));
};

// Optimize CSS - Purge then combine - then minify
const optimizeCSS = () => {
	//? Add any files that must be specifically loaded after each other to array (same as bootstrap as first array value)
	return gulp.src(['_dev/css/vendor/bootstrap.css', '_dev/**/*.css'])
		.pipe(purgeCSS({
			content: CI_VIEW_DIRECTORIES
		}))
		.pipe(concat('styles.min.css'))
		.pipe(uglifyCSS())
		.pipe(gulp.dest('public/assets/css'));
};

// Optimize our own JS ~ Also add ES6+ support 
const optimizeCustomJS = ()=>{
	return gulp.src(['_dev/js/*.js'])
	.pipe(babel({presets: ['@babel/preset-env']}))
	.pipe(uglifyJS())
	.pipe(gulp.dest('public/assets/js'));
};


//* GULP TASKS
gulp.task('optimizeImages',optimizeImages);

gulp.task('optimizeCSS', optimizeCSS);

gulp.task('optimizeCustomJS',optimizeCustomJS)



// Watch for file changes
gulp.task('watch', () => {
	// View directory changes in Codeigniter ~ optimize CSS
	gulp.watch(CI_VIEW_DIRECTORIES, optimizeCSS);

	// JS changes ~ reminify JS
	gulp.watch('_dev/js/*.js', optimizeCustomJS);

	// Image changes and add optimized versions of the images when need be
	gulp.watch('_dev/img/*', optimizeImages);
});

// Build for production
gulp.task('build', gulp.series(optimizeCSS,optimizeImages,optimizeCustomJS));