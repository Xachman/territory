var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var shell = require('gulp-shell');
var execSync = require('child_process').execSync;

gulp.task('styles', function() {
    gulp.src('sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('styles.css'))
        .pipe(gulp.dest('./webroot/css/'));
});

gulp.task('default', function() {
    gulp.watch('sass/**/*.scss', ['styles']);
})

global.isRunning = false;

gulp.task('run-tests',  function() {
    var isRunning = global.isRunning;
    console.log(isRunning)
    if(!isRunning) {
        global.isRunning = true;
        console.log(global.isRunning);
        console.log(execSync("echo $PWD").toString());
    return gulp.src("/var/www/").pipe(shell("vendor/bin/phpunit"))
            .on("end", function() {
        global.isRunning = false;
    })
    }
})

gulp.task("test-test", function() {
    console.log(execSync("echo $PWD").toString());
})

gulp.task('test', function() {
    gulp.watch(['src/**/*.php', "tests/**/*.php"], ['run-tests']);
})

function handleError(err) {
  console.log(err.toString());
  this.emit('end');
}