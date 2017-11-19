<?php get_header(); ?>
<div class="sub-header">
<div class="bread">
  <ol>
    <li>
      <a href="<?php echo esc_url( home_url() ); ?>"><i class="fa fa-home"></i><span>TOP</span></a>
    </li>
    <li>
      <a>検索結果</a>
    </li>
</ol>
</div>
</div>
<div class="container">
  <div class="container">
    <div class="ad1">
      <p><img src="" width=320 height="50" ></p>
    </div>
  </div>
  <div class="contents">

    <h1>"
      <?php
        // echo esc_attr( get_search_query() );
        // get_search_query();
        the_search_query();
      ?>"
    に関する記事
    </h1>

    <?php if (have_posts()): while(have_posts()): the_post(); ?>

      <?php get_template_part('gaiyou', 'medium'); ?>

    <?php endwhile; ?>

    <?php else: ?>
      <p>お探しのキーワードに関する記事は見つかりませんでした。</p>
      <?php get_search_form(); ?>
    <?php endif; ?>

    <div class="pagination pagination-index">
      <?php echo paginate_links( array(
        'type' => 'list',
        'end_size' => '2',
        'mid_size' => '3',
      )); ?>
    </div>
  </div>

  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
