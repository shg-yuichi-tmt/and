<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package and
 */
?>

<article id="post-<?php the_ID(); ?>">
    <header class="entry-header">
        <div class="mainVisual">
            <div class="copy">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                <p>太田駅北口から徒歩<span class="num">3</span>分<br>厳選された日本人セラピストによる <br>《高品質》な極上リラクゼーションを <br>是非ご堪能下さい。</p>
            </div>
            <div class="post-thumbnail">
                <?php
                if (wp_is_mobile()) :
                    the_post_thumbnail('mobile_front_thumbnail');
                else :
                    the_post_thumbnail();
                endif;
                ?>
                <div class="logo">
                    <div class="and"><span class="symbol">&</span><span class="name"> - アンド -</span></div>
                    <div class="tx">RELAXATION SALON</div>
                </div>
            </div>
        </div>
        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'and'); ?></button>
            <?php
            wp_nav_menu(
                array(
                    'menu' => 'Primary',
                    'theme_location' => 'primary',
                    'menu_id'        => 'header-nav',
                )
            );
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <section class="intro fadein">
            <div class="container">
                <div class="img">
                    <img src="/assets/img/mat.png" alt="施術マット">
                </div>
                <div class="tx">
                    <h2>繋がりを表す記号【＆】</h2>
                    <p>人と人との繋がりを大切に。</p>
                    <p>日々の喧騒で疲れた身体に。</p>
                    <p>隠れ家の様な落ち着いた雰囲気の中、お客様が心身共に【安堵】できる空間を。</p>
                    <p>安心してご来店していただけるリラクゼーションサロンを目指して・・</p>
                </div>
            </div>
        </section>
        <section class="front_schedule fadein">
            <div class="container">
                <div class="h">
                    <h2><span class="sm">TODAY'S SCHEDULE</span>本日の出勤</h2>
                </div>
                <div class="list">
                    <?php
                    $current_date = date('Y-m-d');
                    $today_args = array(
                        'post_type' => 'therapist',
                        'posts_per_page' => 8,
                        'meta_query' => array(
                            array(
                                'key' => 'therapist__schedule__field__' . $current_date,
                                'compare' => '!=',
                                'value' => '',
                            ),
                        ),
                    );

                    $today_query = new WP_Query($today_args);
                    if ($today_query->have_posts()) :
                        while ($today_query->have_posts()) :
                            $today_query->the_post();
                    ?>
                            <div class="item">
                                <div class="img">
                                    <a href="<?php the_permalink(); ?>" class="link"></a>
                                    <?php if (!empty(get_post_meta($post->ID, '__therapist__twitter__field', true))) : ?>
                                        <a href="https://twitter.com/<?php echo get_post_meta($post->ID, '__therapist__twitter__field', true); ?>" target="_blank" class="tw_icon">
                                            <img src="/assets/img/tw_icon.png" alt="Twitterのアイコン">
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post->ID, 'therapist__new__field', true))) : ?>
                                        <div class="new">
                                            <span>New</span>
                                        </div>
                                    <?php endif; ?>
                                    <?php and_post_thumbnail(); ?>
                                </div>
                                <div class="tx">
                                    <div class="name">
                                        <h3><?php echo get_post_meta($post->ID, '__therapist__name__field', true); ?></h3>
                                        <span class="age">
                                            <?php
                                            echo get_post_meta($post->ID, '__therapist__age__field', true);
                                            echo get_post_meta($post->ID, '__therapist__unit__field', true);
                                            ?>
                                        </span>
                                    </div>
                                    <div class="info">T.<?php echo get_post_meta($post->ID, '__therapist__height__field', true); ?>cm</div>
                                </div>
                                <div class="hour"><?php echo get_post_meta($post->ID, 'therapist__schedule__field__' . $current_date, true); ?></div>
                            </div>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <section class="front_therapist fadein">
            <div class="container">
                <div class="h">
                    <h2><span class="sm">THERAPIST</span>在籍セラピスト</h2>
                </div>
                <div class="list">
                    <?php
                    $args = array(
                        'post_type' => 'therapist',
                        'posts_per_page' => 8,
                    );

                    $query = new WP_Query($args);
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                    ?>
                            <div class="item">
                                <div class="img">
                                    <a href="<?php the_permalink(); ?>" class="link"></a>
                                    <?php if (!empty(get_post_meta($post->ID, '__therapist__twitter__field', true))) : ?>
                                        <a href="https://twitter.com/<?php echo get_post_meta($post->ID, '__therapist__twitter__field', true); ?>" target="_blank" class="tw_icon">
                                            <img src="/assets/img/tw_icon.png" alt="Twitterのアイコン">
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty(get_post_meta($post->ID, 'therapist__new__field', true))) : ?>
                                        <div class="new">
                                            <span>New</span>
                                        </div>
                                    <?php endif; ?>
                                    <?php and_post_thumbnail(); ?>
                                </div>
                                <div class="tx">
                                    <div class="name">
                                        <h3><?php echo get_post_meta($post->ID, '__therapist__name__field', true); ?></h3>
                                        <span class="age">
                                            <?php
                                            echo get_post_meta($post->ID, '__therapist__age__field', true);
                                            echo get_post_meta($post->ID, '__therapist__unit__field', true);
                                            ?>
                                        </span>
                                    </div>
                                    <div class="info">T.<?php echo get_post_meta($post->ID, '__therapist__height__field', true); ?>cm</div>
                                </div>
                            </div>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="more">
                    <a href="/therapist/">セラピスト一覧</a>
                </div>
            </div>
        </section>
        <section class="front_news fadein">
            <div class="container">
                <div class="twitter">
                    <div class="h">
                        <h2>Twitter <span class="sm">ツイッター</span></h2>
                    </div>
                    <div class="feed">
                        <a class="twitter-timeline" href="https://twitter.com/and_0316?ref_src=twsrc%5Etfw"></a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
                <div class="news">
                    <div class="h">
                        <h2>News <span class="sm">ニュース</span></h2>
                    </div>
                    <div class="list">
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => 5,
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post(); ?>
                                    <li>
                                        <article>
                                            <div class="thumbnail">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail(); ?>
                                                <?php else : ?>
                                                    <img src="/assets/img/logo_symbol.png" alt="&のロゴ">
                                                <?php endif; ?>
                                            </div>
                                            <div class="tx">
                                                <div class="ttl">
                                                    <div class="date"><?php the_time('Y-m-d H:i') ?></div>
                                                    <h3><?php the_title(); ?></h3>
                                                </div>
                                                <div class="desc">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                            <?php endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </ul>
                        <div class="more">
                            <a href="/news/">ニュース一覧</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="banner fadein">
            <div class="container">
                <div class="list">
                    <a href="/system/" class="item">
                        <div class="tx">
                            <h3>料金・システム <span class="sm">System</span></h3>
                        </div>
                        <div class="img">
                            <img src="/assets/img/system_banner.png" alt="">
                        </div>
                    </a>
                    <a href="#access" class="item">
                        <div class="tx">
                            <h3>アクセス <span class="sm">Access</span></h3>
                        </div>
                        <div class="img">
                            <img src="/assets/img/access_banner.png" alt="">
                        </div>
                    </a>
                    <a href="/recruitment/" class="item">
                        <div class="tx">
                            <h3>求人 <span class="sm">Recruit</span></h3>
                        </div>
                        <div class="img">
                            <img src="/assets/img/recruit_banner.png" alt="">
                        </div>
                    </a>
                    <a href="/review/" class="item">
                        <div class="tx">
                            <h3>口コミ <span class="sm">Review</span></h3>
                        </div>
                        <div class="img">
                            <img src="/assets/img/review_banner.png" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="access fadein" id="access">
            <div class="container">
                <div class="h">
                    <h2>Access <span class="sm">アクセス</span></h2>
                </div>
                <div class="flex">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6431.1845715514355!2d139.37583219705476!3d36.29794148649816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601f2061f181b549%3A0x9e7da137cc2c25b2!2z44CSMzczLTAwMjYg576k6aas55yM5aSq55Sw5biC5p2x5pys55S6!5e0!3m2!1sja!2sjp!4v1686728648245!5m2!1sja!2sjp" width="613" height="497" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="tx">
                        <h3>relaxation salon &. -アンド-</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <th>住所</th>
                                    <td>群馬県太田市東本町</td>
                                </tr>
                                <tr>
                                    <th>最寄り</th>
                                    <td>太田駅北口から徒歩3分<br>(お車でお越しの方はお近くのコインパーキングへお願い致します。)</td>
                                </tr>
                                <tr>
                                    <th>OPEN</th>
                                    <td>10:00-26:00</td>
                                </tr>
                                <tr>
                                    <th>電話番号</th>
                                    <td>0276-57-8093</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->