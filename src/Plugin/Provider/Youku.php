<?php

/**
 * @file
 * Contains \Hunter\video_embed_youku\Plugin\Provider\Youku.
 */

namespace Hunter\video_embed\Plugin\Provider;

use Hunter\video_embed\Plugin\ProviderPluginBase;
use Hunter\video_embed\Annotation\VideoEmbedProvider;

/**
 * @VideoEmbedProvider(
*   id = "youku",
*   title = "Youku"
 * )
 */
class Youku extends ProviderPluginBase {

  /**
   * {@inheritdoc}
   */
  public function renderEmbedCode($width, $height, $autoplay) {
    return '<iframe src="http://player.youku.com/embed/'.$this->getVideoId().'" width="'.$width.'" height="'.$height.'" frameborder=0 allowfullscreen></iframe> ';
  }

  /**
   * {@inheritdoc}
   */
  public function getRemoteThumbnailUrl() {
    $video_data = json_decode(file_get_contents('https://openapi.youku.com/v2/videos/show_basic.json?client_id=8d025b9c897b22a8&video_id=s%', $this->getVideoId()));
    return $video_data->thumbnail;
  }

  /**
   * {@inheritdoc}
   */
  public static function getIdFromInput($input) {
    $id = FALSE;
    // Parse_url is an easy way to break a url into its components.
    $parsed = parse_url($input);
    $path = $parsed['path'];
    $parts = explode('/', $path);
    foreach ($parts as $part) {
      if (strstr($part, 'id_')) {
        $id = str_replace('id_', '', $part);
        $id = str_replace('.html', '', $id);
        return $id;
      }
    }
  }

}
