const proxy = "http://t2025-01-11wp.local/";
const { src, dest, watch, series, parallel } = require("gulp"); // Gulpの基本関数をインポート
const sass = require("gulp-sass")(require("sass")); // SCSSをCSSにコンパイルするためのモジュール
const plumber = require("gulp-plumber"); // エラーが発生してもタスクを続行するためのモジュール
const notify = require("gulp-notify"); // エラーやタスク完了の通知を表示するためのモジュール
const sassGlob = require("gulp-sass-glob-use-forward"); // SCSSのインポートを簡略化するためのモジュール
const postcss = require("gulp-postcss"); // CSSの変換処理を行うためのモジュール
const autoprefixer = require("autoprefixer"); // ベンダープレフィックスを自動的に追加するためのモジュール
const postcssPresetEnv = require("postcss-preset-env"); // 最新のCSS構文を使用可能にするためのモジュール
const sourcemaps = require("gulp-sourcemaps"); // ソースマップを作成するためのモジュール
const imageminSvgo = require("imagemin-svgo"); // SVGを最適化するためのモジュール
const browserSync = require("browser-sync"); // ブラウザの自動リロード機能を提供するためのモジュール
const imagemin = require("gulp-imagemin"); // 画像を最適化するためのモジュール
const imageminMozjpeg = require("imagemin-mozjpeg"); // JPEGを最適化するためのモジュール
const imageminPngquant = require("imagemin-pngquant"); // PNGを最適化するためのモジュール
const changed = require("gulp-changed").default || require("gulp-changed"); // 変更されたファイルのみを対象にするためのモジュール
const del = require("del"); // ファイルやディレクトリを削除するためのモジュール
const webp = require("gulp-webp");  // webp不要時コメントアウト
const webpackStream = require("webpack-stream");
const named = require("vinyl-named");
const path = require("path");


// 読み込み先
const srcPath = {
  css: "./src/sass/**/*.scss",
  js: "./src/js/**/*",
  img: "./src/images/**/*",
  rt: "./src/root/**/*",
};


// WordPress反映用
const distPath = {
  all: `./assets/**/*`,
  css: `./assets/css/`,
  js: `./assets/js/`,
  img: `./assets/images/`,
  rt: `./`,
};

// Sassコンパイル
const browsers = [ // 対応ブラウザの指定
  'last 2 versions',
  '> 1%',
  'not dead',
  'not ie 11'
]
const cssSass = () => {
  return src(srcPath.css)
    .pipe(sourcemaps.init()) // ソースマップの初期化
    .pipe(
      plumber({ // エラーが出ても処理を止めない
          errorHandler: notify.onError('Error:<%= error.message %>')
      }))
    .pipe(sassGlob()) // globパターンを使用可にする
    .pipe(sass.sync({ // sassコンパイル
      includePaths: ['src/sass', 'node_modules'], // 相対パス省略
      outputStyle: 'expanded' // 出力形式をCSSの一般的な記法にする
    }))
    .pipe(postcss([autoprefixer({ overrideBrowserslist: browsers })])) // ベンダープレフィックス自動付与
    .pipe(sourcemaps.write('./')) // ソースマップの出力先をcssファイルから見たパスに指定
    .pipe(dest(distPath.css)) // 
    .pipe(notify({ // エラー発生時のアラート出力
      message: 'Sassをコンパイルしました！',
      onLast: true
    }))
}

// 画像圧縮
const imgImagemin = () => {
  // 画像ファイルを指定
  return (
    src(srcPath.img)
      // 変更があった画像のみ処理対象に
      .pipe(changed(distPath.img))
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
      .pipe(dest(distPath.img))
      .pipe(webp()).pipe(dest(distPath.img)) // webp不要な場合はコメントアウト
  );
};

// JavaScript処理
const jsWebpack = () => {
  return src(srcPath.js)
    .pipe(
      plumber({
        errorHandler: notify.onError("Error: <%= error.message %>"),
      })
    )
    .pipe(named())
    .pipe(webpackStream({
      mode: "development",
      devtool: "source-map",
      entry: {
        bundle: "./src/js/index.js" // エントリーポイント
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
          },
          // CSSローダーの設定を追加
          {
            test: /\.css$/,
            use: ["style-loader", "css-loader"]
          }
        ]
      },
      resolve: {
        extensions: [".js"]
      }
    }))
    .pipe(dest(distPath.js))
    .pipe(notify({
      message: 'JavaScriptをバンドルしました！',
      onLast: true
    }));
};

// root/に格納したファイルをそのまま出力
const copyRootFiles = () => {
  return src(srcPath.rt).pipe(dest(distPath.rt));
};

// kiso.cssをassets/css/にコピー
const copyKisoCss = () => {
  return src('node_modules/kiso.css/kiso.css')
    .pipe(dest(distPath.css));
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
  return del([distPath.all], { force: true });
};

// ファイルの監視
const watchFiles = () => {
  watch(srcPath.css, series(cssSass, browserSyncReload));
  watch(srcPath.js, series(jsWebpack, browserSyncReload));
  watch(srcPath.img, series(imgImagemin, browserSyncReload));
  watch(srcPath.rt, series(copyRootFiles, browserSyncReload));
  watch('./**/*.php').on('change', browserSync.reload);
};

// ブラウザシンク付きの開発用タスク
exports.default = series(
  series(copyKisoCss, cssSass, jsWebpack, imgImagemin, copyRootFiles),
  parallel(watchFiles, browserSyncFunc)
);

// 本番用タスク
exports.build = series(clean, copyKisoCss, cssSass, jsWebpack, imgImagemin, copyRootFiles);
