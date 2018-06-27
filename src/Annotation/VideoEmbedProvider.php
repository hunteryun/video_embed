<?php

namespace Hunter\video_embed\Annotation;

use Hunter\Core\Annotation\Plugin;

/**
 * Defines a VideoEmbedProvider item annotation object.
 *
 * @Annotation
 */
class VideoEmbedProvider extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The title of the plugin.
   *
   */
  public $title;

}
