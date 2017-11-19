<?php

// 子テーマの読み込み
// add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
// function theme_enqueue_styles() {
//     wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
// }

// 抜粋の文字数
function my_length($length) {
  return 30;
}
add_filter('excerpt_mblength', 'my_length');

// 抜粋の省略記号
function my_more($more) {
  return '...';
}
add_filter('excerpt_more', 'my_more');

// コンテンツの最大幅
if (!isset($content_width)) {
  $content_width = 747;
}

//YouTubeのビデオ：<div>でマークアップ
function ytwrapper($return, $data, $url) {
	if ($data->provider_name == 'YouTube') {
		return '<div class="ytvideo">'.$return.'</div>';
	} else {
		return $return;
	}
}
add_filter('oembed_dataparse','ytwrapper',10,3);

//YouTubeのビデオ: キャッシュをクリア
function clear_ytwrapper($post_id) {
  global $wp_embed;
  // var_dump($wp_embed);
  // exit;
  $wp_embed->delete_oembed_caches($post_id);
}
add_action('pre_post_update', 'clear_ytwrapper');

add_theme_support( 'title-tag' );

// アイキャッチ画像の指定
add_theme_support('post-thumbnails');

// 編集画面の設定(h1を削除、補足情報と注意書きを追加)
function editor_setting($init) {
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre';
  $style_formats = array(
    array(
      'title' => '補足情報',
      'block' => 'div',
      'classes' => 'point'
    ),
    array(
      'title' => '注意書き',
      'block' => 'div',
      'classes' => 'attention'
    )
  );

  $init['style_formats'] = json_encode($style_formats);

  return $init;
}
add_filter('tiny_mce_before_init', 'editor_setting');

// スタイルメニューを有効化
function add_stylemenu($buttons) {
  array_splice($buttons, 1, 0, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'add_stylemenu');

// エディタスタイルシート EdgeとIEでも読み込めるようにする
add_editor_style(get_template_directory_uri() . '/editor-style.css?ver=' . date('U'));
add_editor_style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

// サムネイル画像
function mythumb( $size ) {

  global $post;

  if (has_post_thumbnail() ) {
    $postthumb = wp_get_attachment_image_src( get_post_thumbnail_id(), '$size');
    $url = $postthumb[0];
    // var_dump($url);
    // 小かっこは、パターンにマッチした部分文字列を取得したい場合に使います。https://goo.gl/nqdwvE
  } elseif(preg_match('/wp-image-(\d+)/s', $post->post_content, $thumbid)) {
    $postthumb = wp_get_attachment_image_src( $thumbid[1], $size);
    $url = $postthumb[0];
  } else {
    $url = get_template_directory_uri() . '/ecoteki-image.png';
  }
  return esc_url( $url );

}

// mythumb()関数の無害化 GitとGitHubの動作確認
// function the_mythumb() {
//   echo esc_url( mythumb() );
// }

// カスタムメニュー
register_nav_menu( 'sitenav', 'サイトナビゲーション');
register_nav_menu( 'pickup', 'おすすめ記事');

// トグルボタン
function navbtn_scripts() {
  wp_enqueue_script('navbtn-script', get_template_directory_uri() . '/navbtn.js', array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'navbtn_scripts');

// /*  存在しないページを指定された場合は 404 ページを表示する  */
// function redirect_404() {
//   //メインページ・シングルページ・アーカイブ・固定ページ 以外の指定の場合 404 ページを表示する
//   if(is_home() || is_single() || is_category() || is_tag() || is_page()) {
//     return;
//   }
//   include(TEMPLATEPATH . '/404.php');
//   exit;
// }
// add_action('template_redirect', 'redirect_404');

// 前後の記事に関するメタデータの出力を禁止（Firefox対策）
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// ウイジェットエリア
function mytheme_register_sidebar() {
  register_sidebar( array(
    'id' => 'submenu',
    'name' => 'サブメニュー',
    'description' => 'サイドバーに表示するウイジェットを指定',
    'before_widget' => '<aside id="%1$s" class="mymenu widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>'
  ));

  register_sidebar( array(
    'id' => 'ad',
    'name' => '広告',
    'description' => 'サイドバーに表示する広告を指定',
    'before_widget' => '<aside id="%1$s" class="myad widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>'
  ));
}
add_action( 'widgets_init', 'mytheme_register_sidebar' );

// 検索フォーム
 add_theme_support ('html5', array('search-form'));

 // テーマのタグクラウドのパラメータ変更
function my_tag_cloud_filter($args) {
    $myargs = array(
        'smallest' => 10, // 最小文字サイズは 10pt
        'largest' => 10, // 最大文字サイズは 10pt
        'number' => 30,  // 一度に表示するのは30タグまで（0で無限)
        'echo' => false,  // wordpress4.4以前の人はこの行は不要
    );
    return $myargs;
}
add_filter('widget_tag_cloud_args', 'my_tag_cloud_filter');

 // カテゴリーディレクトリの削除
 //パーマリンクカテゴリ削除
// add_filter('user_trailingslashit', 'remcat_function');
// function remcat_function($link) {
//     return str_replace("/category/", "/", $link);
// }
// add_action('init', 'remcat_flush_rules');
// function remcat_flush_rules() {
//     global $wp_rewrite;
//     $wp_rewrite->flush_rules();
// }
// add_filter('generate_rewrite_rules', 'remcat_rewrite');
// function remcat_rewrite($wp_rewrite) {
//     $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
//     $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
// }

// 月別アーカイブリスト
// function my_get_archives_link($link_html) {
//     $data = get_the_time('Y年m月');
//     var_dump($data);
//     exit;
//
//     // Link to archive page
//     $link = esc_url(home_url($data));
//
//     var_dump($link);
//     exit;
//
//     // Check if the link is in string
//     $strpos = strpos($link_html, $link);
//
//     // var_dump($strpos);  // boolean
//     // exit;
//
//     // Add class if link has been found
//     if ($strpos !== false) {
//         $link_html = str_replace('<li>', '<li class="current-archive">', $link_html);
//     }
//
//     return $link_html;
// }
// add_filter("get_archives_link", "my_get_archives_link");

// function add_nen_year_archives( $link_html ) {
//   $regex = array (
//       "/ title='([\d]{4})'/"  => " title='$1年'",
//       "/ ([\d]{4}) /"         => " $1年 ",
//       "/>([\d]{4})<\/a>/"        => ">$1年</a>"
//   );
//
//   $link_html = preg_replace( array_keys( $regex ), $regex, $link_html );
//   return $link_html;
// }
// add_filter( 'get_archives_link', 'add_nen_year_archives' );

// 月別アーカイブリストその2
function my_archive_link( $link_html, $url, $text, $format, $before, $after){

	$after = str_replace( array('(',')'),'', $after );

	$link_html = '<li>
                  <a href="%1$s" class="rd-archive-link">
							   　<span class="rd-archive-date">%2$s</span>
							　　　<span class="rd-archive-count"> %3$s</span>
			  			   </a>
                   </li>';

	return sprintf($format, $link_html, $url,$text, $after );

}
add_filter( 'get_archives_link','my_archive_link', 10, 6 );
