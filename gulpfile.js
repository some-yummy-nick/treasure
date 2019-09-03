const gulp = require('gulp');
const browserSync = require('browser-sync').create();

const paths = {
    php: {
        src: 'web/index.php',
        all: 'modules/**/*.php'
    }
};


function php() {
    return gulp.src(paths.php.src)
        .pipe(browserSync.stream());
}


function watcher() {
    browserSync.init({
        proxy: 'treasure',
        open:false
    });
    gulp.watch(paths.php.all, php);
}

gulp.task("default", gulp.series(watcher));
