<?php
  header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
  echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

  ob_start();
?>

  <ul>
    <li>
      <p><a href='https://www.catholicworldreport.com/2023/05/04/in-5-years-the-church-in-nicaragua-has-suffered-more-than-500-attacks-90-in-2023-alone/?utm_source=ADF+International&utm_campaign=faaa72c17f-AA_20230505&utm_medium=email&utm_term=0_7732cae558-faaa72c17f-94953419&mc_cid=faaa72c17f&mc_eid=53c9c62c34'>In 5 years the Church in Nicaragua has suffered more than 500 attacks, 90 in 2023 alone</a></p>
      <p>Catholic World Report</p>
    </li>
    <li>
      <p><a href='https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/?mc_cid=faaa72c17f&mc_eid=53c9c62c34&utm_campaign=faaa72c17f-AA_20230505&utm_medium=email&utm_source=ADF+International&utm_term=0_7732cae558-faaa72c17f-94953419'>Burkina Faso priest describes rampant Christian persecution</a></p>
      <p>Aletia</p>
    </li>
    <li>
      <p><a href='https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/?mc_cid=faaa72c17f&mc_eid=53c9c62c34&utm_campaign=faaa72c17f-AA_20230505&utm_medium=email&utm_source=ADF+International&utm_term=0_7732cae558-faaa72c17f-94953419'>US: Montana governor signs bills protecting life, conscience rights</a></p>
      <p>ADF US</p>
    </li>
    <li>
      <p><a href='https://aleteia.org/2023/05/04/burkina-faso-priest-describes-rampant-christian-persecution/?mc_cid=faaa72c17f&mc_eid=53c9c62c34&utm_campaign=faaa72c17f-AA_20230505&utm_medium=email&utm_source=ADF+International&utm_term=0_7732cae558-faaa72c17f-94953419'>Canada: Bill C-11's effect on religion remains to be seen</a></p>
      <p>BC Catholic</p>
    </li>
  </ul>
  <?php

  $html_posts = ob_get_clean();

  $items = array(
    array(
      'title' => 'Religious Freedom & Freedom of Speech',
      'desc'  => $html_posts
    ),
    array(
      'title' => 'Marriage & Family',
      'desc'  => $html_posts
    ),
    array(
      'title' => 'Sanctity of Life',
      'desc'  => $html_posts
    ),
    array(
      'title' => 'Religious Freedom & Freedom of Speech',
      'desc'  => $html_posts
    ),
  );


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
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <language>en</language>
    <!--sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
    <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency-->
    <?php do_action('rss2_head'); ?>

    <?php foreach( $items as $item ):?>
    <item>
      <pubDate>Fri, 19 May 2023 15:55:39 +0000</pubDate>
      <!--guid><?php bloginfo_rss('url') ?></guid-->
      <title><![CDATA[<?php echo $item['title']; ?>]]></title>
      <description><![CDATA[<?php echo $item['desc']; ?>]]></description>
      <content:encoded><![CDATA[<?php echo $item['desc']; ?>]]></content:encoded>
      <?php rss_enclosure(); ?>
      <?php do_action('rss2_item'); ?>
    </item>
    <?php endforeach;?>

  </channel>
</rss>
