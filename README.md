# WordPressサイト制作用テンプレートファイル

## 使用環境
- Node.js バージョン14系以上
- npm バージョン8以上
- バージョンは、以下のコマンドで確認
  - `node -v`
  - `npm -v`


## 導入手順
- LOCALなどを使って、WordPressをインストール
- theme直下にclone
- `cd` コマンドで、`gulp/`へ移動
- `npm i` を実行
- `gulp/`に`node_modules`、`package-lock.json`が生成されたことを確認
- `gulpfile.js`の`proxy`の設定「http://XXXXX.local/」とLOCALのSiteDomainを合わせる
  https://gyazo.com/5c5e683ff44ac48c69922e9082c6fa64
- `npx gulp`でタスクランナー起動

## JavaScriptのバンドル設定
- `src/js/`配下のJavaScriptファイルは、webpackでバンドルされます
- エントリーポイントは`src/js/index.js`です
- バンドルされたファイルは`dist/assets/js/bundle.js`に出力されます
- モジュール分割の例：
  - `src/js/index.js` - メインのエントリーポイント
  - `src/js/_drawer.js` - ドロワーメニュー関連のモジュール
  - `src/js/_slider.js` - スライダー関連のモジュール
  - `src/js/_modal.js` - モーダル関連のモジュール
  - アンダースコア（_）で始まるファイルは、モジュールファイルとして扱われます

## テンプレートファイルの特徴
  - src/sass/global/_breakpoints.scssにある変数を`pc` or `sp`に設定することで、spファースト・pcファーストの切り替えが可能です。（初期値：`sp`）
  - サイズ指定は、原則rem()を使います
  - font-sizeは、maxrem()の単位を使うことで、10px未満にならないように指定できます。
  - src/root/内にファイルを設置すると、dist直下にコピーされます。（画像やJSファイルなど圧縮せずそのまま設置したいとき）
  - 詳細は、以下のNotionページで説明しています。
  https://rea1i2e.notion.site/WordPress-1770f4d8911580d09bf8ff20fbb843f2?pvs=4
  
## その他
- 提出時は`npx gulp build`コマンドで、`assets/`内の不要なファイル（`scr/`で削除したもの）を削除できます。
