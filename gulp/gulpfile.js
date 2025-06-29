const proxy = "http://t2025-01-11wp.local/";
const { src, dest, watch, series, parallel } = require("gulp"); // Gulpの基本関数をインポート
const sass = require("gulp-sass")(require("sass")); // SCSSをCSSにコンパイルするためのモジュール
const plumber = require("gulp-plumber"); // エラーが発生してもタスクを続行するためのモジュール
const notify = require("gulp-notify"); // エラーやタスク完了の通知を表示するためのモジュール
const sassGlob = require("gulp-sass-glob-use-forward"); // SCSSのインポートを簡略化するためのモジュール
const postcss = require("gulp-postcss"); // CSSの変換処理を行うためのモジュール
const autoprefixer = require("autoprefixer"); // ベンダープレフィックスを自動的に追加するためのモジュール
const cssdeclsort = require("css-declaration-sorter"); // CSSの宣言をソートするためのモジュール
const postcssPresetEnv = require("postcss-preset-env"); // 最新のCSS構文を使用可能にするためのモジュール
const rename = require("gulp-rename"); // ファイル名を変更するためのモジュール
const sourcemaps = require("gulp-sourcemaps"); // ソースマップを作成するためのモジュール
const babel = require("gulp-babel"); // ES6+のJavaScriptをES5に変換するためのモジュール
const uglify = require("gulp-uglify"); // JavaScriptを圧縮するためのモジュール
const imageminSvgo = require("imagemin-svgo"); // SVGを最適化するためのモジュール
const browserSync = require("browser-sync"); // ブラウザの自動リロード機能を提供するためのモジュール
const imagemin = require("gulp-imagemin"); // 画像を最適化するためのモジュール
const imageminMozjpeg = require("imagemin-mozjpeg"); // JPEGを最適化するためのモジュール
const imageminPngquant = require("imagemin-pngquant"); // PNGを最適化するためのモジュール
const changed = require("gulp-changed"); // 変更されたファイルのみを対象にするためのモジュール
const del = require("del"); // ファイルやディレクトリを削除するためのモジュール
const webp = require("gulp-webp");  // webp不要時コメントアウト
const pixrem = require("pixrem");
const replace = require("gulp-replace");
const combineMq = require("postcss-combine-media-query");
const webpackStream = require("webpack-stream");
const named = require("vinyl-named");


// 読み込み先
const srcPath = {
  css: "../src/sass/**/*.scss",
  js: "../src/js/**/*",
  img: "../src/images/**/*",
  rt: "../src/root/**/*",
};


// WordPress反映用
const destWpPath = {
  all: `../assets/**/*`,
  css: `../assets/css/`,
  js: `../assets/js/`,
  img: `../assets/images/`,
  rt: `../`,
};

const browsers = [
  "last 2 versions",
  "> 5%",
  "ie = 11",
  "not ie <= 10",
  "ios >= 8",
  "and_chr >= 5",
  "Android >= 5",
];

const cssSass = () => {
  // ソースファイルを指定
  return (
    src(srcPath.css)
      // ソースマップを初期化
      .pipe(sourcemaps.init())
      // エラーハンドリングを設定
      .pipe(
        plumber({
          errorHandler: notify.onError("Error:<%= error.message %>"),
        })
      )
      // Sassのパーシャル（_ファイル）を自動的にインポート
      .pipe(sassGlob())
      // SassをCSSにコンパイル
      .pipe(
        sass.sync({
          includePaths: ["src/sass"],
          outputStyle: "expanded", // コンパイル後のCSSの書式（expanded or compressed）
        })
      )
      // ベンダープレフィックスを自動付与
      .pipe(
        postcss([
          postcssPresetEnv(),
          autoprefixer({
            grid: true,
          }),
        ])
      )
      // CSSプロパティをアルファベット順にソートし、未来のCSS構文を使用可能に
      .pipe(
        postcss([
          cssdeclsort({ order: "alphabetical" }),
          pixrem({ atrules: true }),
          postcssPresetEnv({ browsers: "last 2 versions" }),
          combineMq() // 2023/09/08 style.css.map に対応する
        ])
      )
      // ソースマップを書き出し
      .pipe(sourcemaps.write("./"))
      .pipe(dest(destWpPath.css))
      // Sassコンパイルが完了したことを通知
      .pipe(
        notify({
          message: "Sassをコンパイルしました！",
          onLast: true,
        })
      )
  );
};

// 画像圧縮
const imgImagemin = () => {
  // 画像ファイルを指定
  return (
    src(srcPath.img)
      // 変更があった画像のみ処理対象に
      .pipe(changed(destWpPath.img))
      // 画像を圧縮
      .pipe(
        imagemin(
          [
            // JPEG画像の圧縮設定
            imageminMozjpeg({
              quality: 80, // 圧縮品質（0〜100）
            }),
            // PNG画像の圧縮設定
            imageminPngquant(),
            // SVG画像の圧縮設定
            imageminSvgo({
              plugins: [
                {
                  removeViewbox: false, // viewBox属性を削除しない
                },
              ],
            }),
          ],
          {
            verbose: true, // 圧縮情報を表示
          }
        )
      )
      // 圧縮済みの画像ファイルを出力先に保存
      .pipe(dest(destWpPath.img))
      // .pipe(dest(destWpPath.img))
      .pipe(webp()) //webp不要な場合はコメントアウト
      // 圧縮済みの画像ファイルを出力先に保存
      .pipe(dest(destWpPath.img))
    // .pipe(dest(destWpPath.img))
  );
};

// js圧縮
const jsWebpack = () => {
  return src(srcPath.js)
    .pipe(plumber({
      errorHandler: notify.onError("Error: <%= error.message %>"),
    }))
    .pipe(named())
    .pipe(webpackStream({
      mode: "development",
      devtool: "source-map",
      entry: {
        index: "../src/js/index.js"
      },
      output: {
        filename: "bundle.js"
      },
      module: {
        rules: [
          {
            test: /\.js$/,
            exclude: /node_modules/,
            use: {
              loader: "babel-loader",
              options: {
                presets: ["@babel/preset-env"]
              }
            }
          }
        ]
      },
      resolve: {
        extensions: [".js"]
      }
    }))
    .pipe(dest(destWpPath.js));
};

// root/に格納したファイルをそのまま出力
const copyRootFiles = () => {
  return src(srcPath.rt).pipe(dest(destWpPath.rt));
};

// ブラウザーシンク
const browserSyncOption = {
  notify: false,
  //WordPressの場合は↓を有効にする。その場合、↑(server)はコメントアウトする。
  proxy: proxy, // ローカルサーバーのURL（WordPress）
};
const browserSyncFunc = () => {
  browserSync.init(browserSyncOption);
};
const browserSyncReload = (done) => {
  browserSync.reload();
  done();
};

// ファイルの削除
const clean = () => {
  return del([destWpPath.all], { force: true });
};

// ファイルの監視
const watchFiles = () => {
  watch(srcPath.css, series(cssSass, browserSyncReload));
  watch(srcPath.js, series(jsWebpack, browserSyncReload));
  watch(srcPath.img, series(imgImagemin, browserSyncReload));
  watch(srcPath.rt, series(copyRootFiles, browserSyncReload));
  watch('../**/*.php').on('change', browserSync.reload);
};

// ブラウザシンク付きの開発用タスク
exports.default = series(
  series(cssSass, jsWebpack, imgImagemin, copyRootFiles),
  parallel(watchFiles, browserSyncFunc)
);

// 本番用タスク
exports.build = series(clean, cssSass, jsWebpack, imgImagemin, copyRootFiles);
