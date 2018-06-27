<?php

namespace Hunter\video_embed\Plugin\Provider;

use Hunter\video_embed\Plugin\ProviderPluginBase;
use Hunter\video_embed\Annotation\VideoEmbedProvider;

/**
 * @VideoEmbedProvider(
*   id = "bilibili",
*   title = "Bilibili"
 * )
 */
class Bilibili extends ProviderPluginBase {

  /**
   * {@inheritdoc}
   */
  public function renderEmbedCode($width, $height, $autoplay) {
    return '<iframe src="//player.bilibili.com/player.html?aid='.$this->getVideoId().'" width="'.$width.'" height="'.$height.'" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>';
  }

  /**
   * {@inheritdoc}
   */
  public static function getIdFromInput($input) {
    $id = FALSE;
    // Parse_url is an easy way to break a url into its components.
    $parsed = parse_url($input);
    $path = $parsed['path'];
    if($parsed['host'] == 'www.bilibili.com'){
      $parts = explode('/', $path);
      foreach ($parts as $part) {
        if (strstr($part, 'av')) {
          $id = str_replace('av', '', $part);
          return $id;
        }
      }
    }
  }

}
