<?php

namespace Hunter\video_embed\Plugin\Provider;

use Hunter\video_embed\Plugin\ProviderPluginBase;
use Hunter\video_embed\Annotation\VideoEmbedProvider;

/**
 * @VideoEmbedProvider(
*   id = "qq",
*   title = "QQ"
 * )
 */
class Qq extends ProviderPluginBase {

  /**
   * {@inheritdoc}
   */
  public function renderEmbedCode($width, $height, $autoplay) {
    return '<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="https://v.qq.com/iframe/player.html?vid='.$this->getVideoId().'&tiny=0&auto='.$autoplay.'" allowfullscreen></iframe>';
  }

  /**
   * {@inheritdoc}
   */
  public static function getIdFromInput($input) {
    $id = FALSE;
    // Parse_url is an easy way to break a url into its components.
    $parsed = parse_url($input);
    $path = $parsed['path'];
    if($parsed['host'] == 'v.qq.com'){
      $parts = explode('/', $path);
      foreach ($parts as $part) {
        if (strstr($part, '.html')) {
          $id = str_replace('.html', '', $part);
          return $id;
        }
      }
    }
  }

}
