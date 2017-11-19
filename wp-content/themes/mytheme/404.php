<?php get_header(); ?>
<div class="container">
  <div class="container">
    <div class="ad1">
      <p><img src="" width=320 height="50" ></p>
    </div>
  </div>
  <div class="contents">
    <h2>404 not found!</h2>
      <p>申し訳ありません、お探しの記事はございません。</p>
      <p><a href="<?php echo esc_url( home_url() ); ?>">トップページへ戻る</a></p>
  </div>
  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>
