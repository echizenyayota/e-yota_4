<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns#">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width" initial-scale="1.0">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosansjp.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

  <?php if ( is_single() || is_page() ) : // 記事の個別ページ用のメタデータ?>
    <meta name="<?php echo esc_attr( 'description' ); ?>" content="<?php echo wp_html_excerpt($post->post_content, 100, '...'); ?>">
    <?php if (has_tag()) : ?>
      <?php
        $tags = get_the_tags();
        $kwds = [];
        foreach ($tags as $tag) {
          $kwds[] = $tag->name;
        }
      ?>
      <meta name="<?php echo esc_attr( 'keywords' ); ?>" content="<?php echo implode(',', $kwds); ?>">
    <?php endif; ?>
    <!-- 運用前に外部公開してhttps://developers.facebook.com/tools/debug/で確認。ローカル開発環境では確認できない -->
    <meta property="<?php echo esc_attr( 'og:type' ); ?>" content="<?php echo esc_attr( 'article' ); ?>">
    <meta property="<?php echo esc_attr( 'og:title' ); ?>" content="<?php the_title(); ?>">
    <meta property="<?php echo esc_attr( 'og:url' ); ?>" content="<?php the_permalink(); ?>">
    <meta property="<?php echo esc_attr( 'og:description' ); ?>" content="<?php echo wp_html_excerpt ($post->post_content, 100, '...'); ?>">
    <meta property="<?php echo esc_attr( 'og:image' ); ?>" content="<?php echo mythumb( 'large' ); ?>">
  <?php endif; // 記事の個別ページ用のメタデータここまで?>

  <?php if (is_home()): // トップページ用のメタデータ　?>
    <meta name="<?php echo esc_attr( 'description' ); ?>" content="<?php bloginfo('description'); ?>">
    <?php
      $allcats = get_categories();
      $kwds = [];
      foreach ($allcats as $allcat) {
        $kwds[] = $allcat->name;
      }
    ?>
    <meta name="<?php echo esc_attr( 'keywords' ); ?>" content="<?php echo implode(',', $kwds); ?>">
    <meta property="<?php echo esc_attr( 'og:type' ); ?>" content="<?php echo esc_attr( 'website' ); ?>">
    <meta property="<?php echo esc_attr( 'og:title' ); ?>" content="<?php bloginfo('name'); ?>">
    <?php $url = esc_url( home_url() ); ?>
    <meta property="<?php echo esc_attr( 'og:url' ); ?>" content="<?php echo $url ; ?>">
    <meta property="<?php echo esc_attr( 'og:description' ); ?>" content="<?php bloginfo('description'); ?>">
    <meta property="<?php echo esc_attr( 'og:image' ); ?>" content="<?php echo get_template_directory_uri(); ?>/ecoteki-top.jpg">
  <?php endif; // トップページ用のメタデータ（ここまで）　?>

  <?php if (is_category() || is_tag() ): // カテゴリー・タグ用のメタデータ ?>
    <?php
        if (is_category()) {
          $categoryname = single_cat_title('',false);
          $termid = get_cat_ID($categoryname);
        } elseif(is_tag()) {
          $posttags = get_the_tags();
            foreach($posttags as $tag) {
              $termid = $tag->term_id;
            }
        }
  ?>

    <meta property="<?php echo esc_attr( 'og:description' ); ?>" content="<?php single_term_title(); ?>に関する記事一覧です">

    <?php
      $categories = get_the_category();
      $kwds = [];
      foreach($categories as $category) {
        $category = $category->name;
        array_push($kwds, $category);
      }
    ?>

    <meta name="<?php echo esc_attr( 'keywords' ); ?>" content="<?php echo implode(',', $kwds); ?>">

    <meta property="<?php echo esc_attr( 'og:type' ); ?>" content="<?php echo esc_attr( 'website' ); ?>">
    <meta property="<?php echo esc_attr( 'og:title' ); ?>" content="<?php single_term_title(); ?> | <?php bloginfo('name'); ?>">
    <meta property="<?php echo esc_attr( 'og:url' ); ?>" content="<?php echo esc_url ( get_term_link($termid) ); ?>">
    <meta property="<?php echo esc_attr( 'og:description' ); ?>" content="<?php single_term_title(); ?> に関する記事の一覧です。">
    <meta property="<?php echo esc_attr( 'og:image' ); ?>" content="<?php echo get_template_directory_uri(); ?>/ecoteki-top.jpg">

  <?php endif; // カテゴリー・タグ用のここまで　?>

    <meta property="<?php echo esc_attr( 'og:site_name' ); ?>" content="<?php bloginfo('name'); ?>">
    <meta property="<?php echo esc_attr( 'og:locale' ); ?>" content="<?php echo esc_attr( 'ja_jp' ); ?>">

    <!-- 実際に運用するときにhttps://cards-dev.twitter.com/validatorに申請 -->
    <meta name="<?php echo esc_attr( 'twitter:site' ); ?>" content="<?php echo esc_attr( '@echizenya_yota' ); ?>">
    <meta name="<?php echo esc_attr( 'twitter:card' ); ?>" content="<?php echo esc_attr( 'summary_large_image' ); ?>">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/ecoteki_favicon.ico" />

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
  <div class="header-inner">
    <div class="site">
      <h1>
        <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
      </h1>
    </div>
    <div class="sitenav">
      <button type="button" id=navbtn>
        <i class="fa fa-bars"></i><span>Menu</span>
      </button>
      <?php
        wp_nav_menu( array(
          'theme_location' => 'sitenav',
          'container' => 'nav',
          'container_class' => 'mainmenu',
          'container_id' => 'mainmenu'
        ));
      ?>
   </div>
  </div>
</header>
