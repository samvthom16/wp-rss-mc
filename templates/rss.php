<?php
  header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
  echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

  $feeds = get_option( 'wp_rss_mc_publish_feeds' );

  /*
  $feeds = array(
    array(
      'title' => 'Religious Freedom & Freedom of Speech',
      'items' => array(
        array(
          'link'    => "https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/",
          'title'   => "In 5 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone",
          'source'  => "Catholic World Report"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "Burkina Faso priest describes rampant Christian persecution",
          'source'  => "Aletia"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "US: Montana governor signs bills protecting life, conscience rights",
          'source'  => "ADF US"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "Canada: Bill C-11's effect on religion remains to be seen",
          'source'  => "BC Catholic"
        ),
      )
    ),
    array(
      'title' => 'Marriage & Family',
      'items' => array(
        array(
          'link'    => "https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/",
          'title'   => "In 5 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone",
          'source'  => "Catholic World Report"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "Canada: Bill C-11's effect on religion remains to be seen",
          'source'  => "BC Catholic"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "Burkina Faso priest describes rampant Christian persecution",
          'source'  => "Aletia"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "US: Montana governor signs bills protecting life, conscience rights",
          'source'  => "ADF US"
        ),

      )
    ),
    array(
      'title' => 'Sanctity of Life',
      'items' => array(
        array(
          'link'    => "https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/",
          'title'   => "In 5 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone",
          'source'  => "Catholic World Report"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "US: Montana governor signs bills protecting life, conscience rights",
          'source'  => "ADF US"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "Canada: Bill C-11's effect on religion remains to be seen",
          'source'  => "BC Catholic"
        ),
        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "Burkina Faso priest describes rampant Christian persecution",
          'source'  => "Aletia"
        ),


      )
    ),
    array(
      'title' => 'Religious Freedom & Freedom of Speech',
      'items' => array(
        array(
          'link'    => "https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/",
          'title'   => "In 5 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone",
          'source'  => "Catholic World Report"
        ),

        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "US: Montana governor signs bills protecting life, conscience rights",
          'source'  => "ADF US"
        ),

        array(
          'link'    => "https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/",
          'title'   => "Burkina Faso priest describes rampant Christian persecution",
          'source'  => "Aletia"
        ),

      )
    ),
  );
  */

?>
<rss version="2.0"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:wfw="http://wellformedweb.org/CommentAPI/"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:atom="http://www.w3.org/2005/Atom"
  xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
  xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
  <?php do_action('rss2_ns'); ?>>

  <channel>
    <title><?php bloginfo_rss('name'); ?></title>
    <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
    <link><?php bloginfo_rss('url') ?></link>
    <description><?php bloginfo_rss('description') ?></description>
    <lastBuildDate><?php echo get_option( 'wp_rss_mc_publish_time' ); ?></lastBuildDate>
    <language>en</language>
    <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
    <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
    <?php do_action('rss2_head'); ?>

    <item>
      <pubDate>Fri, 19 May 2023 15:55:39 +0000</pubDate>
      <guid><?php bloginfo_rss('url') ?></guid>
      <title><![CDATA[<?php echo "Newsletter for 2023"; ?>]]></title>
      <description>
        <?php foreach( $feeds as $feed ): if( is_array( $feed['items'] ) && count( $feed['items'] ) ):?>
        <![CDATA[<div style="color:#1d4289;font-size:26px;text-align:center;font-weight: 600;"><?php echo $feed['title']; ?></div>]]>
        <![CDATA[<ul style="padding:30px;box-shadow:0 0 11px #aba6a6;border-radius:5px;margin: 26px 0 40px;">
          <?php foreach( $feed['items'] as $item ):?>
          <li style="margin:0 0 20px; padding-bottom: 15px; border-bottom: 1px #d0d0d0 solid;list-style: none;">
            <h5><a style="color: #b3292a!important;font-size: 14px;" href="<?php echo $item['link'];?>"><?php echo $item['title'];?></a></h5>
            <?php if( isset( $item['source'] ) && $item['source'] ):?>
            <p style="font-weight: 400; font-size: 14px; color: #5d5d5d;">&ndash;&nbsp;<?php echo $item['source'];?></p>
            <?php endif;?>
          </li>
          <?php endforeach;?>
        </ul>]]>
      <?php endif;endforeach;?>
      </description>
      <?php rss_enclosure(); ?>
      <?php do_action('rss2_item'); ?>
    </item>


  </channel>
</rss>
