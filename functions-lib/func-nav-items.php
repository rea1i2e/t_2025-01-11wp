<?php
/**
 * ナビメニューを一元管理
 * 
 * @return array ナビゲーションアイテムの配列
 * 各アイテムは 'slug' と 'text' を含み、必要に応じて 'modifier' を含むことがあります。
 * 'modifier' は特定のスタイルを適用するためのクラス名を指定するために使用されます。
 */
function get_nav_items() {
    return [
        [
            'slug' => 'top',
            'text' => 'トップ',
        ],
        [
            'slug' => 'news',
            'text' => 'お知らせ',
        ],
        [
            'slug' => 'works',
            'text' => '実績',
        ],
        [
            'slug' => 'contact',
            'text' => 'お問い合わせ',
            'modifier' => 'contact',
        ],
        [
            'slug' => 'privacy-policy',
            'text' => 'プライバシーポリシー',
        ],
        [
            'slug' => 'terms-of-use',
            'text' => '利用規約',
        ],
    ];
} 