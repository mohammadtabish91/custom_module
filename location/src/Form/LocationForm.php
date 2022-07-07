<?php  
/**  
 * @file  
 * Contains Drupal\location\Form\LocationForm.  
 */  
namespace Drupal\location\Form;  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  
  
class LocationForm extends ConfigFormBase {  
  /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'location.adminsettings',  
    ];  
  }  
  
  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'location_form';  
  }

  /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('location.adminsettings');
    $form['country'] = array(
      '#type' => 'textfield',
      '#title' => t('Country'),
      '#default_value' => $config->get('country'),
      '#required' => TRUE,
    );
    $form['city'] = array(
      '#type' => 'textfield',
      '#title' => t('City'),
      '#default_value' => $config->get('city'),  
      '#required' => TRUE,
    );
    $form['timezone'] = array (
      '#type' => 'select',
      '#title' => ('Timezone'),
      '#options' => array(
        'America/Chicago' => t('America/Chicago'),
		    'America/New_York' => t('America/New_York'),
        'Asia/Tokyo' => t('Asia/Tokyo'),
        'Asia/Dubai' => t('Asia/Dubai'),
        'Asia/Kolkata' => t('Asia/Kolkata'),
        'Europe/Amsterdam' => t('Europe/Amsterdam'),
        'Europe/Oslo' => t('Europe/Oslo'),
        'Europe/London' => t('Europe/London'),
      ),
      '#default_value' => $config->get('timezone'),  
    );
  
    return parent::buildForm($form, $form_state);  
  }

  /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  
  
    $this->config('location.adminsettings')  
      ->set('country', $form_state->getValue('country'))  
      ->set('city', $form_state->getValue('city'))  
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }  
}