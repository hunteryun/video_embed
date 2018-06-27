<?php

namespace Hunter\video_embed\Plugin;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
   * An http client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Create a plugin with the given input.
   *
   * @param string $configuration
   *   The configuration of the plugin.
   * @param string $plugin_id
   *   The plugin id.
   * @param array $plugin_definition
   *   The plugin definition.
   * @param \GuzzleHttp\ClientInterface $http_client
   *    An HTTP client.
   *
   * @throws \Exception
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

  /**
   * {@inheritdoc}
   */
  public function renderThumbnail($image_style, $link_url) {
    $output['#theme'] = 'image_style';
    return $output;
  }

  /**
   * {@inheritdoc}
   */
  public function downloadThumbnail() {
    $local_uri = $this->getLocalThumbnailUri();
    if (!file_exists($local_uri)) {
      file_prepare_directory($this->thumbsDirectory, FILE_CREATE_DIRECTORY);
      try {
        $thumbnail = $this->httpClient->request('GET', $this->getRemoteThumbnailUrl());
        file_unmanaged_save_data((string) $thumbnail->getBody(), $local_uri);
      }
      catch (\Exception $e) {
      }
    }
  }


}
