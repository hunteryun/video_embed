<?php

namespace Hunter\video_embed\Plugin;

/**
 * A base for the provider plugins.
 */
abstract class ProviderPluginBase implements ProviderPluginInterface {

  /**
   * The directory where thumbnails are stored.
   *
   * @var string
   */
  protected $thumbsDirectory = 'public://video_thumbnails';

  /**
   * The ID of the video.
   *
   * @var string
   */
  protected $videoId;

  /**
   * The input that caused the embed provider to be selected.
   *
   * @var string
   */
  protected $input;

  /**
   * Create a plugin with the given input.
   */
  public function __construct($input, $definition) {
    $this->videoId = $this->getIdFromInput($input);
  }

  /**
   * Get the ID of the video.
   *
   * @return string
   *   The video ID.
   */
  protected function getVideoId() {
    return $this->videoId;
  }

  /**
   * Get the input which caused this plugin to be selected.
   *
   * @return string
   *   The raw input from the user.
   */
  protected function getInput() {
    return $this->input;
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable($input) {
    $id = static::getIdFromInput($input);
    return !empty($id);
  }

}
