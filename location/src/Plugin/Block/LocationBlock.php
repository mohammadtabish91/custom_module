<?php

namespace Drupal\location\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a block with a Site location.
 *
 * @Block(
 *   id = "location_block",
 *   admin_label = @Translation("Site Location Block"),
 * )
 */
class LocationBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('location.adminsettings');
    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $config->get('timezone');    

    $t = \Drupal::time()->getCurrentTime();
    $date_output = date('Y-m-d H:i:s', $t); 

    $date_original= new DrupalDateTime( $date_output );     
    $time = \Drupal::service('date.formatter')->format( $date_original->getTimestamp(), 'custom', 'dS M Y - h:i A', $timezone );   
    return [
      '#theme' => 'location',
      '#data' => [
        'Country' => $country, 
        'City' => $city, 
        'Timezone' => $timezone, 
        'Time' => $time, 
      ],
    ];
  }

  /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge() {
        return 0;
    }
}