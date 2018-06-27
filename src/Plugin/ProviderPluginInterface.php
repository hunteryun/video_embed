<?php

namespace Hunter\video_embed\Plugin;

/**
 * Providers an interface for embed providers.
 */
interface ProviderPluginInterface {

  /**
   * Check if the plugin is applicable to the user input.
   *
   * @param string $input
   *   User input to check if it's a URL for the given provider.
   *
   * @return bool
   *   If the plugin works for the given URL.
   */
  public static function isApplicable($input);

  /**
   * Render embed code.
   *
   * @param string $width
   *   The width of the video player.
   * @param string $height
   *   The height of the video player.
   * @param bool $autoplay
   *   If the video should autoplay.
   *
   * @return mixed
   *   A renderable array of the embed code.
   */
  public function renderEmbedCode($width, $height, $autoplay);

  /**
   * Get the ID of the video from user input.
   *
   * @param string $input
   *   Input a user would enter into a video field.
   *
   * @return string
   *   The ID in whatever format makes sense for the provider.
   */
  public static function getIdFromInput($input);

}
