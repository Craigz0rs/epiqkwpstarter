var gulp = require('gulp'),
  sass = require ('gulp-sass')(require('node-sass')),
  sourcemaps = require ('gulp-sourcemaps'),
  notify = require('gulp-notify'),
  filter = require('gulp-filter'),
  autoprefixer = require('gulp-autoprefixer'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  imagemin = require('gulp-imagemin'),
  jimp = require('gulp-jimp'),
  babel = require('gulp-babel'),
  plumber = require('gulp-plumber');

var config = {
  stylesPath: 'src/assets/css',
  jsPath: 'src/assets/js',
  imagesPath: 'src/assets/images',
  faviconPath: 'src/assets/favicon',
  webfontPath: 'src/assets/fonts',
  templatePath: 'src',
  outputDir: 'public_html/wp-content/themes/epiqk/assets',
  themeDir: 'public_html/wp-content/themes/epiqk',
  publicDir: 'public_html'
}

gulp.task( 'fonts', function() {
  return gulp.src( [
      './node_modules/@fortawesome/fontawesome-free/webfonts/*.*', 
      './node_modules/slick-carousel/slick/fonts/slick.*', 
      config.webfontPath + '/*'] )
    .pipe(plumber())
    .pipe(gulp.dest(config.outputDir + '/fonts'));
});

gulp.task('images-jimp', function() {
  return gulp.src(config.imagesPath + '-original/*.+(jpg|jpeg)')
    .pipe(plumber())
    .pipe(jimp({
      '': {
        scaleToFit: { width: 1920, height:1280 },
        quality: 85
      }
    }))
    .pipe(gulp.dest(config.imagesPath));
});

gulp.task('images-imagemin', function() {
  return gulp.src(config.imagesPath + '/*.+(gif|jpg|jpeg|png|svg)')
    .pipe(plumber())
    .pipe(imagemin())
    .pipe(gulp.dest(config.outputDir + '/images'));
});

gulp.task('images-copy', function() {
  return gulp.src(config.imagesPath + '/**/*.(gif|jpg|jpeg|png|svg)')
    .pipe(gulp.dest(config.outputDir + '/images'));
});

gulp.task( 'images', gulp.series( 'images-imagemin', 'images-copy' ) );

gulp.task('favicon', function() {
  return gulp.src(config.faviconPath + '/**')
    .pipe(plumber())
    .pipe(imagemin())
    .pipe(gulp.dest(config.publicDir));
});

gulp.task('css', function() {
  return gulp.src([
		config.stylesPath + '/app*.scss'
	])
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass({
        outputStyle: 'compressed',
        includePaths: [
          config.stylesPath,
          './node_modules/bootstrap/scss',
          './node_modules/slick-carousel/slick',
          './node_modules/superfish/dist/css',
          './node_modules/lity/dist',
          './node_modules/@fortawesome/fontawesome-free/scss',
          // './public_html/wp-content/plugins/woocommerce/assets/css',
        ],
        functions: {
          'btoa($string)': function(string) {
            string.setValue( Buffer.from( string.getValue() ).toString( 'base64' ) );
            return string;
          }
        }
      }).on('error', function (err) {
        console.log(err.toString());
        this.emit('end');
      }))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(config.outputDir + '/css'));
});

gulp.task('js-dependencies', function(){
  return gulp.src([
      './node_modules/objectFitPolyfill/dist/objectFitPolyfill.basic.min.js',
      './node_modules/slick-carousel/slick/slick.js',
      './node_modules/superfish/dist/js/hoverIntent.js',
      './node_modules/superfish/dist/js/superfish.js',
      './node_modules/lity/dist/lity.js'
    ])
    .pipe(plumber())
    .pipe(uglify())
    .pipe(concat('app-libs.js'))
    .pipe(gulp.dest(config.outputDir + '/js'));
});

gulp.task('js', function() {
  return gulp.src( [ config.jsPath + '/app*.js' ])
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(babel({
      presets: ['@babel/env'] 
    }))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(config.outputDir + '/js'));
});

gulp.task('php', function() {
    return gulp.src([config.templatePath + '/**/*.php', config.templatePath + '/*.css', config.templatePath + '/screenshot.png'])
    .pipe(gulp.dest(config.themeDir));  
});

gulp.task('watch', function(){
  gulp.watch([config.webfontPath + '/*'], gulp.series('fonts'));
  gulp.watch([config.imagesPath + '/**/*'], gulp.series('images'));
  gulp.watch([config.faviconPath + '/**/*'], gulp.series('favicon'));
  gulp.watch([config.stylesPath + '/**/*.scss'], gulp.series('css'));
  gulp.watch([config.jsPath + '/**/*.js'], gulp.series('js'));
  gulp.watch([config.templatePath + '/**/*.php', config.templatePath + '/*.css'], gulp.series('php'));
});

gulp.task('default', gulp.series('fonts', 'images', 'favicon', 'css', 'js-dependencies', 'js', 'php'));
