<?php

namespace Drupal\simple_social_icons\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

/**
 * Provides a 'SimpleSocialIconsBlock' block.
 *
 * @Block(
 *  id = "simple_social_icons_block",
 *  admin_label = @Translation("Simple social icons block"),
 * )
 */
class SimpleSocialIconsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $reddit_enable = isset($this->configuration['reddit_enable']) ? $this->configuration['reddit_enable'] : '';
    $tumblr_enable = isset($this->configuration['tumblr_enable']) ? $this->configuration['tumblr_enable'] : '';
    $stumbleupon_enable = isset($this->configuration['stumbleupon_enable']) ? $this->configuration['stumbleupon_enable'] : '';
    $linkedin_enable = isset($this->configuration['linkedin_enable']) ? $this->configuration['linkedin_enable'] : '';
    $pinterest_enable = isset($this->configuration['pinterest_enable']) ? $this->configuration['pinterest_enable'] : '';
    $email_enable = isset($this->configuration['email_enable']) ? $this->configuration['email_enable'] : '';
    $facebook_enable = isset($this->configuration['facebook_enable']) ? $this->configuration['facebook_enable'] : '';
    $googleplus_enable = isset($this->configuration['googleplus_enable']) ? $this->configuration['googleplus_enable'] : '';
    $twitter_enable = isset($this->configuration['twitter_enable']) ? $this->configuration['twitter_enable'] : '';
    $reddit_icon_order = isset($this->configuration['reddit_icon_order']) ? $this->configuration['reddit_icon_order'] : '1';
    $tumblr_icon_order = isset($this->configuration['tumblr_icon_order']) ? $this->configuration['tumblr_icon_order'] : '2';
    $stumbleupon_icon_order = isset($this->configuration['stumbleupon_icon_order']) ? $this->configuration['stumbleupon_icon_order'] : '3';
    $twitter_icon_order = isset($this->configuration['twitter_icon_order']) ? $this->configuration['twitter_icon_order'] : '4';
    $linkedin_icon_order = isset($this->configuration['linkedin_icon_order']) ? $this->configuration['linkedin_icon_order'] : '5';
    $pinterest_icon_order = isset($this->configuration['pinterest_icon_order']) ? $this->configuration['pinterest_icon_order'] : '6';
    $email_icon_order = isset($this->configuration['email_icon_order']) ? $this->configuration['email_icon_order'] : '7';
    $facebook_icon_order = isset($this->configuration['facebook_icon_order']) ? $this->configuration['facebook_icon_order'] : '8';
    $googleplus_icon_order = isset($this->configuration['googleplus_icon_order']) ? $this->configuration['googleplus_icon_order'] : '9';

    $values = [
      'reddit_enable' => $reddit_enable,
      'tumblr_enable' => $tumblr_enable,
      'stumbleupon_enable' => $stumbleupon_enable,
      'linkedin_enable' => $linkedin_enable,
      'pinterest_enable' => $pinterest_enable,
      'email_enable' => $email_enable,
      'facebook_enable' => $facebook_enable,
      'googleplus_enable' => $googleplus_enable,
      'twitter_enable' => $twitter_enable,
      'reddit_icon_order' => $reddit_icon_order,
      'tumblr_icon_order' => $tumblr_icon_order,
      'stumbleupon_icon_order' => $stumbleupon_icon_order,
      'twitter_icon_order' => $twitter_icon_order,
      'linkedin_icon_order' => $linkedin_icon_order,
      'pinterest_icon_order' => $pinterest_icon_order,
      'email_icon_order' => $email_icon_order,
      'facebook_icon_order' => $facebook_icon_order,
      'googleplus_icon_order' => $googleplus_icon_order,
    ];

    $form['icon_placement'] = array(
      '#type' => 'radios',
      '#title' => t('Icon alignment'),
      '#default_value' => isset($this->configuration['icon_placement']) ? $this->configuration['icon_placement'] : '',
      '#description' => $this->t('By default it will display horizontally .'),
      '#options' => array(0 => t('Horizontal'), 1 => t('Vertical')),
      '#weight' => '0',
    );
    $form['size'] = array(
      '#type' => 'range',
      '#title' => $this->t('Layout Size'),
      '#description' => $this->t('Adjust the layout size.'),
      '#default_value' => isset($this->configuration['size']) ? $this->configuration['size'] : '38',
      '#weight' => '0',
    );
    $form['font_size'] = array(
      '#type' => 'range',
      '#title' => $this->t('Icon size'),
      '#description' => $this->t('Adjust the icon size.'),
      '#default_value' => isset($this->configuration['font_size']) ? $this->configuration['font_size'] : '23',
      '#weight' => '0',
    );
    $form['radius'] = array(
      '#type' => 'range',
      '#title' => $this->t('Radius'),
      '#description' => $this->t('Adjust the icon radius'),
      '#default_value' => isset($this->configuration['radius']) ? $this->configuration['radius'] : '30',
      '#weight' => '0',
    );
    $form['spacing'] = array(
      '#type' => 'range',
      '#title' => $this->t('Spacing'),
      '#description' => $this->t('Adjust the Margin between icons.'),
      '#default_value' => isset($this->configuration['spacing']) ? $this->configuration['spacing'] : '8',
      '#weight' => '0',
      '#attributes' => array(
      //'onblur' => 'simple_social_share_block_live_changes(this)',
      //'onclick' => 'simple_social_share_block_live_changes(this)'
      ),
    );
    $form['button_link_color'] = array(
      '#type' => 'color',
      '#title' => $this->t('Layout color'),
      '#description' => $this->t('Color of a link'),
      '#default_value' => isset($this->configuration['button_link_color']) ? $this->configuration['button_link_color'] : 'auto',
      '#weight' => '0',
    );
    $form['icon_color'] = array(
      '#type' => 'color',
      '#title' => $this->t('Icon Color'),
      '#description' => $this->t('Color of an icon'),
      '#default_value' => isset($this->configuration['icon_color']) ? $this->configuration['icon_color'] : '#ffffff',
      '#weight' => '0',
    );
    $form['use_default_style_ignore_colors'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Use default style & ignore colors.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['use_default_style_ignore_colors']) ? $this->configuration['use_default_style_ignore_colors'] : '1',
      '#weight' => '0',
    );
    $form['contact_information'] = array(
      '#markup' => $this->icons($values),
      '#weight' => '-100',
      '#title' => 'Preview',
    );
    $form['#attached']['library'][] = 'simple_social_icons/simple_social_icons';
    $style = '.soc li a {
                /*size*/
                width: 38px;
                height: 38px;
                line-height: 38px;

                /*size 55%*/
                font-size: 20px;

                /*Radius*/
                -webkit-border-radius: 25px;
                -moz-border-radius: 25px;
                border-radius: 25px;

                /*Spacing*/
                margin-right: 7px;
    }';

    $style .= '.soc_ver li a {
                /*size*/
                width: 38px;
                height: 38px;
                line-height: 38px;

                /*size 55%*/
                font-size: 20px;

                /*Radius*/
                -webkit-border-radius: 25px;
                -moz-border-radius: 25px;
                border-radius: 25px;

                /*Spacing*/
                margin-right: 7px;
    }';




    $form['#attached']['html_head'][] = [
      // The data.
      [
        // The HTML tag to add, in this case a <script> tag.
        '#tag' => 'style',
        // The value of the HTML tag, here we want to end up with <script>alert("Hello world!");</script>.
        '#value' => Markup::create($style),
      ],
      // A key, to make it possible to recognize this HTML <HEAD> element when altering.
      'hello-world'
    ];

    $form['simple_social_icons_reddit'] = array(
      '#type' => 'details',
      '#title' => t('Reddit settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_reddit']['reddit_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => isset($this->configuration['reddit_title']) ? $this->configuration['reddit_title'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Reddit title to be used while sharing.',
    );
    $form['simple_social_icons_reddit']['reddit_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Url'),
      '#default_value' => isset($this->configuration['reddit_url']) ? $this->configuration['reddit_url'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Reddit url to use while sharing.',
    );
    $form['simple_social_icons_reddit']['reddit_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable reddit icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['reddit_enable']) ? $this->configuration['reddit_enable'] : 0,
      '#weight' => '1',
    );
    $form['simple_social_icons_reddit']['reddit_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['reddit_icon_order']) ? $this->configuration['reddit_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
        '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );
    $form['simple_social_icons_tumblr'] = array(
      '#type' => 'details',
      '#title' => t('Tumblr settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_tumblr']['tumblr_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => isset($this->configuration['tumblr_title']) ? $this->configuration['tumblr_title'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Tumblr title to be used while sharing.',
    );
    $form['simple_social_icons_tumblr']['tumblr_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Url'),
      '#default_value' => isset($this->configuration['tumblr_url']) ? $this->configuration['tumblr_url'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Tumblr url to use while sharing.',
    );
    $form['simple_social_icons_tumblr']['tumblr_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable tumblr icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['tumblr_enable']) ? $this->configuration['tumblr_enable'] : 0,
      '#weight' => '1',
    );
    $form['simple_social_icons_tumblr']['tumblr_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['tumblr_icon_order']) ? $this->configuration['tumblr_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );
    $form['simple_social_icons_stumbleupon'] = array(
      '#type' => 'details',
      '#title' => t('Stumbleupon settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_stumbleupon']['stumbleupon_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => isset($this->configuration['stumbleupon_title']) ? $this->configuration['stumbleupon_title'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Stumbleupon title to be used while sharing.',
    );
    $form['simple_social_icons_stumbleupon']['stumbleupon_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Url'),
      '#default_value' => isset($this->configuration['stumbleupon_url']) ? $this->configuration['stumbleupon_url'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Stumbleupon url to use while sharing.',
    );
    $form['simple_social_icons_stumbleupon']['stumbleupon_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable stumbleupon icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['stumbleupon_enable']) ? $this->configuration['stumbleupon_enable'] : 0,
      '#weight' => '1',
    );
    $form['simple_social_icons_stumbleupon']['stumbleupon_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['stumbleupon_icon_order']) ? $this->configuration['stumbleupon_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );
    $form['simple_social_icons_twitter'] = array(
      '#type' => 'details',
      '#title' => t('Twitter settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_twitter']['twitter_via'] = array(
      '#type' => 'textfield',
      '#title' => t('Via'),
      '#default_value' => isset($this->configuration['twitter_via']) ? $this->configuration['twitter_via'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Twitter handle to use when sharing.',
    );
    $form['simple_social_icons_twitter']['twitter_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable twitter icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['twitter_enable']) ? $this->configuration['twitter_enable'] : 0,
      '#weight' => '1',
    );
    $form['simple_social_icons_twitter']['twitter_weight'] = array(
      '#type' => 'select',
      '#title' => t('Weight'),
      '#options' => [-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5],
      '#default_value' => isset($this->configuration['twitter_weight']) ? $this->configuration['twitter_weight'] : '',
      '#description' => t(''),
      '#weight' => '2',
    );

    $form['simple_social_icons_twitter']['twitter_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['twitter_icon_order']) ? $this->configuration['twitter_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );
    $form['simple_social_icons_linkedin'] = array(
      '#type' => 'details',
      '#title' => t('Linkedin settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_linkedin']['linkedin_summary'] = array(
      '#type' => 'textarea',
      '#title' => t('Summary'),
      '#default_value' => isset($this->configuration['linkedin_summary']) ? $this->configuration['linkedin_summary'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
      '#description' => 'Provide summary for the linkedin post',
    );
    $form['simple_social_icons_linkedin']['linkedin_source'] = array(
      '#type' => 'textfield',
      '#title' => t('Source'),
      '#default_value' => isset($this->configuration['linkedin_source']) ? $this->configuration['linkedin_source'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Provide the source url of the linkedin post',
    );
    $form['simple_social_icons_linkedin']['linkedin_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable linkedin icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['linkedin_enable']) ? $this->configuration['linkedin_enable'] : 0,
      '#weight' => '2',
    );
    $form['simple_social_icons_linkedin']['linkedin_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['linkedin_icon_order']) ? $this->configuration['linkedin_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );

    $form['simple_social_icons_pinterest'] = array(
      '#type' => 'details',
      '#title' => t('Pinterest settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_pinterest']['pinterest_image_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Image Url'),
      '#default_value' => isset($this->configuration['pinterest_image_url']) ? $this->configuration['pinterest_image_url'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '0',
      '#description' => 'Give the pinterest image url',
    );
    $form['simple_social_icons_pinterest']['pinterest_desc'] = array(
      '#type' => 'textfield',
      '#title' => t('Description'),
      '#default_value' => isset($this->configuration['pinterest_desc']) ? $this->configuration['pinterest_desc'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
      '#description' => 'Give the description of the image',
    );
    $form['simple_social_icons_pinterest']['pinterest_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Pinterest icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['pinterest_enable']) ? $this->configuration['pinterest_enable'] : 1,
      '#weight' => '2',
    );

    $form['simple_social_icons_pinterest']['pinterest_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['pinterest_icon_order']) ? $this->configuration['pinterest_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );

    $form['simple_social_icons_email'] = array(
      '#type' => 'details',
      '#title' => t('Email settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_email']['email_subject'] = array(
      '#type' => 'textfield',
      '#title' => t('Subject'),
      '#default_value' => isset($this->configuration['email_subject']) ? $this->configuration['email_subject'] : '',
      '#size' => 60,
      '#maxlength' => 128,
    );
    $form['simple_social_icons_email']['email_body'] = array(
      '#type' => 'textarea',
      '#title' => t('Body'),
      '#default_value' => isset($this->configuration['email_body']) ? $this->configuration['email_body'] : '',
      '#size' => 60,
      '#maxlength' => 128,
    );
    $form['simple_social_icons_email']['email_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Email icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['email_enable']) ? $this->configuration['email_enable'] : 0,
      '#weight' => '2',
    );
    $form['simple_social_icons_email']['email_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['email_icon_order']) ? $this->configuration['email_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );

    $form['simple_social_icons_facebook'] = array(
      '#type' => 'details',
      '#title' => t('Facebook settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_facebook']['facebook_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Facebook icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['facebook_enable']) ? $this->configuration['facebook_enable'] : 0,
      '#weight' => '2',
    );
    $form['simple_social_icons_facebook']['facebook_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['facebook_icon_order']) ? $this->configuration['facebook_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );

    $form['simple_social_icons_googleplus'] = array(
      '#type' => 'details',
      '#title' => t('Google Plus settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );
    $form['simple_social_icons_googleplus']['googleplus_enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Google Plus icon.'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['googleplus_enable']) ? $this->configuration['googleplus_enable'] : 0,
      '#weight' => '2',
    );

    $form['simple_social_icons_googleplus']['googleplus_icon_order'] = array(
      '#type' => 'select',
      '#title' => $this->t('Order of icon'),
      '#default_value' => isset($this->configuration['googleplus_icon_order']) ? $this->configuration['googleplus_icon_order'] : 1,
      '#options' => [
        '1' => $this->t('First'),
        '2' => $this->t('Second'),
        '3' => $this->t('Third'),
        '4' => $this->t('Fourth'),
        '5' => $this->t('Fifth'),
        '6' => $this->t('Sixth'),
        '7' => $this->t('Seventh'),
         '8' => $this->t('Eigth'),
        '9' => $this->t('Ninth'),
      ],
    );


    $form['simple_social_icons_titletext'] = array(
      '#type' => 'details',
      '#title' => t('Set title on mouse hovering of links'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#description' => '',
    );

    $form['simple_social_icons_titletext']['tumblr_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Tumblr title text'),
      '#default_value' => isset($this->configuration['tumblr_titletext']) ? $this->configuration['tumblr_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );

    $form['simple_social_icons_titletext']['reddit_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Reddit title text'),
      '#default_value' => isset($this->configuration['reddit_titletext']) ? $this->configuration['reddit_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );
    $form['simple_social_icons_titletext']['stumbleupon_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Stumbleupon title text'),
      '#default_value' => isset($this->configuration['stumbleupon_titletext']) ? $this->configuration['stumbleupon_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );
    $form['simple_social_icons_titletext']['twitter_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter title text'),
      '#default_value' => isset($this->configuration['twitter_titletext']) ? $this->configuration['twitter_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );
    $form['simple_social_icons_titletext']['linkedin_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Linkedin title text'),
      '#default_value' => isset($this->configuration['linkedin_titletext']) ? $this->configuration['linkedin_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );
    $form['simple_social_icons_titletext']['email_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Email title text'),
      '#default_value' => isset($this->configuration['email_titletext']) ? $this->configuration['email_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );
    $form['simple_social_icons_titletext']['facebook_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Facebook title text'),
      '#default_value' => isset($this->configuration['facebook_titletext']) ? $this->configuration['facebook_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );
    $form['simple_social_icons_titletext']['googleplus_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Google plus title text'),
      '#default_value' => isset($this->configuration['googleplus_titletext']) ? $this->configuration['googleplus_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );
    $form['simple_social_icons_titletext']['pinterest_titletext'] = array(
      '#type' => 'textfield',
      '#title' => t('Pinterest title text'),
      '#default_value' => isset($this->configuration['pinterest_titletext']) ? $this->configuration['pinterest_titletext'] : '',
      '#size' => 60,
      '#maxlength' => 128,
      '#weight' => '1',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {

    // drupal_set_message('needs to be an integer', 'error');
    // $form_state->setErrorByName('icon_placement', t('Organization name should not be numeric'));
    //   $form_state->setErrorByName('icon_placement', t('check'));
    $order_icon['reddit_icon_order'] = $form_state->getValue('simple_social_icons_reddit')['reddit_icon_order'];
    $order_icon['tumblr_icon_order'] = $form_state->getValue('simple_social_icons_tumblr')['tumblr_icon_order'];
    $order_icon['stumbleupon_icon_order'] = $form_state->getValue('simple_social_icons_stumbleupon')['stumbleupon_icon_order'];
    $order_icon['twitter_icon_order'] = $form_state->getValue('simple_social_icons_twitter')['twitter_icon_order'];

    $order_icon['linkedin_icon_order'] = $form_state->getValue('simple_social_icons_linkedin')['linkedin_icon_order'];
    $order_icon['pinterest_icon_order'] = $form_state->getValue('simple_social_icons_pinterest')['pinterest_icon_order'];
    $order_icon['email_icon_order'] = $form_state->getValue('simple_social_icons_email')['email_icon_order'];
    $order_icon['facebook_icon_order'] = $form_state->getValue('simple_social_icons_facebook')['facebook_icon_order'];
    $order_icon['googleplus_icon_order'] = $form_state->getValue('simple_social_icons_googleplus')['googleplus_icon_order'];
    $val = [];
    // dsm(array_count_values($order_icon));
    foreach ($order_icon as $key => $icon) {
      // dsm($icon);
      if (!in_array($icon, $val)) {
        $val[] = $icon;
      }
      else {
        drupal_set_message('Order of icon is same for two setting', 'error');
        $form_state->setErrorByName($key, t('These value should be more than 1'));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->configuration['icon_placement'] = $form_state->getValue('icon_placement');
    $this->configuration['size'] = $form_state->getValue('size');
    $this->configuration['font_size'] = $form_state->getValue('font_size');
    $this->configuration['radius'] = $form_state->getValue('radius');
    $this->configuration['spacing'] = $form_state->getValue('spacing');
    $this->configuration['button_link_color'] = $form_state->getValue('button_link_color');
    $this->configuration['icon_color'] = $form_state->getValue('icon_color');
    $this->configuration['use_default_style_ignore_colors'] = $form_state->getValue('use_default_style_ignore_colors');

    $this->configuration['reddit_title'] = $form_state->getValue('simple_social_icons_reddit')['reddit_title'];
    $this->configuration['reddit_url'] = $form_state->getValue('simple_social_icons_reddit')['reddit_url'];
    $this->configuration['reddit_enable'] = $form_state->getValue('simple_social_icons_reddit')['reddit_enable'];
    $this->configuration['reddit_icon_order'] = $form_state->getValue('simple_social_icons_reddit')['reddit_icon_order'];

    $this->configuration['tumblr_title'] = $form_state->getValue('simple_social_icons_tumblr')['tumblr_title'];
    $this->configuration['tumblr_url'] = $form_state->getValue('simple_social_icons_tumblr')['tumblr_url'];
    $this->configuration['tumblr_enable'] = $form_state->getValue('simple_social_icons_tumblr')['tumblr_enable'];
    $this->configuration['tumblr_icon_order'] = $form_state->getValue('simple_social_icons_tumblr')['tumblr_icon_order'];

    $this->configuration['stumbleupon_title'] = $form_state->getValue('simple_social_icons_stumbleupon')['stumbleupon_title'];
    $this->configuration['stumbleupon_url'] = $form_state->getValue('simple_social_icons_stumbleupon')['stumbleupon_url'];
    $this->configuration['stumbleupon_enable'] = $form_state->getValue('simple_social_icons_stumbleupon')['stumbleupon_enable'];
    $this->configuration['stumbleupon_icon_order'] = $form_state->getValue('simple_social_icons_stumbleupon')['stumbleupon_icon_order'];

    $this->configuration['twitter_via'] = $form_state->getValue('simple_social_icons_twitter')['twitter_via'];
    $this->configuration['twitter_enable'] = $form_state->getValue('simple_social_icons_twitter')['twitter_enable'];
    $this->configuration['twitter_weight'] = $form_state->getValue('simple_social_icons_twitter')['twitter_weight'];
    $this->configuration['twitter_icon_order'] = $form_state->getValue('simple_social_icons_twitter')['twitter_icon_order'];

    $this->configuration['linkedin_summary'] = $form_state->getValue('simple_social_icons_linkedin')['linkedin_summary'];
    $this->configuration['linkedin_source'] = $form_state->getValue('simple_social_icons_linkedin')['linkedin_source'];
    $this->configuration['linkedin_enable'] = $form_state->getValue('simple_social_icons_linkedin')['linkedin_enable'];
    $this->configuration['linkedin_icon_order'] = $form_state->getValue('simple_social_icons_linkedin')['linkedin_icon_order'];

    $this->configuration['pinterest_image_url'] = $form_state->getValue('simple_social_icons_pinterest')['pinterest_image_url'];
    $this->configuration['pinterest_desc'] = $form_state->getValue('simple_social_icons_pinterest')['pinterest_desc'];
    $this->configuration['pinterest_enable'] = $form_state->getValue('simple_social_icons_pinterest')['pinterest_enable'];
    $this->configuration['pinterest_icon_order'] = $form_state->getValue('simple_social_icons_pinterest')['pinterest_icon_order'];

    $this->configuration['email_subject'] = $form_state->getValue('simple_social_icons_email')['email_subject'];
    $this->configuration['email_body'] = $form_state->getValue('simple_social_icons_email')['email_body'];
    $this->configuration['email_enable'] = $form_state->getValue('simple_social_icons_email')['email_enable'];
    $this->configuration['email_icon_order'] = $form_state->getValue('simple_social_icons_email')['email_icon_order'];

    $this->configuration['facebook_enable'] = $form_state->getValue('simple_social_icons_facebook')['facebook_enable'];
    $this->configuration['facebook_icon_order'] = $form_state->getValue('simple_social_icons_facebook')['facebook_icon_order'];

    $this->configuration['googleplus_enable'] = $form_state->getValue('simple_social_icons_googleplus')['googleplus_enable'];
    $this->configuration['googleplus_icon_order'] = $form_state->getValue('simple_social_icons_googleplus')['googleplus_icon_order'];

    $this->configuration['stumbleupon_titletext'] = $form_state->getValue('simple_social_icons_titletext')['stumbleupon_titletext'];
    $this->configuration['twitter_titletext'] = $form_state->getValue('simple_social_icons_titletext')['twitter_titletext'];
    $this->configuration['linkedin_titletext'] = $form_state->getValue('simple_social_icons_titletext')['linkedin_titletext'];
    $this->configuration['email_titletext'] = $form_state->getValue('simple_social_icons_titletext')['email_titletext'];
    $this->configuration['facebook_titletext'] = $form_state->getValue('simple_social_icons_titletext')['facebook_titletext'];
    $this->configuration['googleplus_titletext'] = $form_state->getValue('simple_social_icons_titletext')['googleplus_titletext'];
    $this->configuration['pinterest_titletext'] = $form_state->getValue('simple_social_icons_titletext')['pinterest_titletext'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $reddit_enable = isset($this->configuration['reddit_enable']) ? $this->configuration['reddit_enable'] : '';
    $tumblr_enable = isset($this->configuration['tumblr_enable']) ? $this->configuration['tumblr_enable'] : '';
    $stumbleupon_enable = isset($this->configuration['stumbleupon_enable']) ? $this->configuration['stumbleupon_enable'] : '';
    $linkedin_enable = isset($this->configuration['linkedin_enable']) ? $this->configuration['linkedin_enable'] : '';
    $pinterest_enable = isset($this->configuration['pinterest_enable']) ? $this->configuration['pinterest_enable'] : '';
    $email_enable = isset($this->configuration['email_enable']) ? $this->configuration['email_enable'] : '';
    $facebook_enable = isset($this->configuration['facebook_enable']) ? $this->configuration['facebook_enable'] : '';

    $googleplus_enable = isset($this->configuration['googleplus_enable']) ? $this->configuration['googleplus_enable'] : '';

    $icon_placement = isset($this->configuration['icon_placement']) ? $this->configuration['icon_placement'] : '';
    $size = (isset($this->configuration['size']) ? $this->configuration['size'] : '38') . 'px';
    $font_size = (isset($this->configuration['font_size']) ? $this->configuration['font_size'] : '22') . 'px';
    $radius = (isset($this->configuration['radius']) ? $this->configuration['radius'] : '30') . 'px';
    $spacing = (isset($this->configuration['spacing']) ? $this->configuration['spacing'] : '8') . 'px';
    $button_link_color = isset($this->configuration['button_link_color']) ? $this->configuration['button_link_color'] : '#eee';
    $icon_color = isset($this->configuration['icon_color']) ? $this->configuration['icon_color'] : '#fffff';
    $default_style = isset($this->configuration['use_default_style_ignore_colors']) ? $this->configuration['use_default_style_ignore_colors'] : '';


    $reddit_url = isset($this->configuration['reddit_url']) ? $this->configuration['reddit_url'] : '';
    $reddit_title = isset($this->configuration['reddit_title']) ? $this->configuration['reddit_title'] : '';
    $reddit_enable = isset($this->configuration['reddit_enable']) ? $this->configuration['reddit_enable'] : '';
    $reddit_icon_order = isset($this->configuration['reddit_icon_order']) ? $this->configuration['reddit_icon_order'] : '1';

    $tumblr_url = isset($this->configuration['tumblr_url']) ? $this->configuration['tumblr_url'] : '';
    $tumblr_title = isset($this->configuration['tumblr_title']) ? $this->configuration['tumblr_title'] : '';
    $tumblr_enable = isset($this->configuration['tumblr_enable']) ? $this->configuration['tumblr_enable'] : '';
    $tumblr_icon_order = isset($this->configuration['tumblr_icon_order']) ? $this->configuration['tumblr_icon_order'] : '2';

    $stumbleupon_url = isset($this->configuration['stumbleupon_url']) ? $this->configuration['stumbleupon_url'] : '';
    $stumbleupon_title = isset($this->configuration['stumbleupon_title']) ? $this->configuration['stumbleupon_title'] : '';
    $stumbleupon_enable = isset($this->configuration['stumbleupon_enable']) ? $this->configuration['stumbleupon_enable'] : '';
    $stumbleupon_icon_order = isset($this->configuration['stumbleupon_icon_order']) ? $this->configuration['stumbleupon_icon_order'] : '3';

    $twitter_via = isset($this->configuration['twitter_via']) ? $this->configuration['twitter_via'] : '';
    $twitter_enable = isset($this->configuration['twitter_enable']) ? $this->configuration['twitter_enable'] : '';
    $twitter_icon_order = isset($this->configuration['twitter_icon_order']) ? $this->configuration['twitter_icon_order'] : '4';

    $linkedin_summary = isset($this->configuration['linkedin_summary']) ? $this->configuration['linkedin_summary'] : '';
    $linkedin_source = isset($this->configuration['linkedin_source']) ? $this->configuration['linkedin_source'] : '';
    $linkedin_enable = isset($this->configuration['linkedin_enable']) ? $this->configuration['linkedin_enable'] : '';
    $linkedin_icon_order = isset($this->configuration['linkedin_icon_order']) ? $this->configuration['linkedin_icon_order'] : '5';

    $pinterest_image_url = isset($this->configuration['pinterest_image_url']) ? $this->configuration['pinterest_image_url'] : '';
    $pinterest_desc = isset($this->configuration['pinterest_desc']) ? $this->configuration['pinterest_desc'] : '';
    $pinterest_enable = isset($this->configuration['pinterest_enable']) ? $this->configuration['pinterest_enable'] : '';
    $pinterest_icon_order = isset($this->configuration['pinterest_icon_order']) ? $this->configuration['pinterest_icon_order'] : '6';

    $email_subject = isset($this->configuration['email_subject']) ? $this->configuration['email_subject'] : '';
    $email_body = isset($this->configuration['email_body']) ? $this->configuration['email_body'] : '';
    $email_enable = isset($this->configuration['email_enable']) ? $this->configuration['email_enable'] : '';
    $email_icon_order = isset($this->configuration['email_icon_order']) ? $this->configuration['email_icon_order'] : '7';


    $facebook_enable = isset($this->configuration['facebook_enable']) ? $this->configuration['facebook_enable'] : '';
    $facebook_icon_order = isset($this->configuration['facebook_icon_order']) ? $this->configuration['facebook_icon_order'] : '8';

    $googleplus_enable = isset($this->configuration['googleplus_enable']) ? $this->configuration['googleplus_enable'] : '';
    $googleplus_icon_order = isset($this->configuration['googleplus_icon_order']) ? $this->configuration['googleplus_icon_order'] : '9';

    if($default_style){
      $icon_color = '#ffffff';
      $button_link_color = 'none';
    }

    $output = array();
    $output[]['#cache']['max-age'] = 0; // No cache
    $values = [
      'icon_placement' => $icon_placement,
      'reddit_title' => $reddit_title,
      'reddit_url' => $reddit_url,
      'reddit_enable' => $reddit_enable,
      'tumblr_title' => $tumblr_title,
      'tumblr_url' => $tumblr_url,
      'tumblr_enable' => $tumblr_enable,
      'stumbleupon_title' => $stumbleupon_title,
      'stumbleupon_url' => $stumbleupon_url,
      'stumbleupon_enable' => $stumbleupon_enable,
      'twitter_via' => $twitter_via,
      'twitter_enable' => $twitter_enable,
      'linkedin_summary' => $linkedin_summary,
      'linkedin_source' => $linkedin_source,
      'linkedin_enable' => $linkedin_enable,
      'pinterest_image_url' => $pinterest_image_url,
      'pinterest_desc' => $pinterest_desc,
      'pinterest_enable' => $pinterest_enable,
      'email_subject' => $email_subject,
      'email_body' => $email_body,
      'email_enable' => $email_enable,
      'facebook_enable' => $facebook_enable,
      'googleplus_enable' => $googleplus_enable,
      'reddit_icon_order' => $reddit_icon_order,
      'tumblr_icon_order' => $tumblr_icon_order,
      'stumbleupon_icon_order' => $stumbleupon_icon_order,
      'twitter_icon_order' => $twitter_icon_order,
      'linkedin_icon_order' => $linkedin_icon_order,
      'pinterest_icon_order' => $pinterest_icon_order,
      'email_icon_order' => $email_icon_order,
      'facebook_icon_order' => $facebook_icon_order,
      'googleplus_icon_order' => $googleplus_icon_order,
      'reddit_titletext' => isset($this->configuration['reddit_titletext']) ? $this->configuration['reddit_titletext'] : '',
      'tumblr_titletext' => isset($this->configuration['tumblr_titletext']) ? $this->configuration['tumblr_titletext'] : '',
      'stumbleupon_titletext' => isset($this->configuration['stumbleupon_titletext']) ? $this->configuration['stumbleupon_titletext'] : '',
      'twitter_titletext' => isset($this->configuration['twitter_titletext']) ? $this->configuration['twitter_titletext'] : '',
      'linkedin_titletext' => isset($this->configuration['linkedin_titletext']) ? $this->configuration['linkedin_titletext'] : '',
      'email_titletext' => isset($this->configuration['email_titletext']) ? $this->configuration['email_titletext'] : '',
      'facebook_titletext' => isset($this->configuration['facebook_titletext']) ? $this->configuration['facebook_titletext'] : '',
      'googleplus_titletext' => isset($this->configuration['googleplus_titletext']) ? $this->configuration['googleplus_titletext'] : '',
      'pinterest_titletext' => isset($this->configuration['pinterest_titletext']) ? $this->configuration['pinterest_titletext'] : '',
    ];
    $output[] = ['#markup' => $this->icons($values)];

    $style = ".soc li a {
            /*size*/
            width: $size;
            height: $size;
            line-height: $size;

            /*size 55%*/
            font-size: $font_size;

            /*Radius*/
            -webkit-border-radius: $radius;
            -moz-border-radius: $radius;
            border-radius: $radius;

            /*Spacing*/
            margin-right: $spacing;
            color: $icon_color !important;
            background-color: $button_link_color !important;
             /*color: #ffffff;*/
             /*background-color: none;*/
    }";



    $style .= ".soc_ver li a {
            /*size*/
            width: $size;
            height: $size;
            line-height: $size;

            /*size 55%*/
            font-size: $font_size;

            /*Radius*/
            -webkit-border-radius: $radius;
            -moz-border-radius: $radius;
            border-radius: $radius;

            /*Spacing*/
            margin-right: $spacing;
            color: $icon_color !important;
            background-color: $button_link_color !important;
             /*color: #ffffff;*/
             /*background-color: none;*/
    }";

    $output['#attached']['html_head'][] = [
      // The data.
      [
        // The HTML tag to add, in this case a <script> tag.
        '#tag' => 'style',
        // The value of the HTML tag, here we want to end up with <script>alert("Hello world!");</script>.
        '#value' => Markup::create($style),
      ],
      // A key, to make it possible to recognize this HTML <HEAD> element when altering.
      'hello-world'
    ];

    $output['#attached']['library'][] = 'simple_social_icons/simple_social_icons';

    return $output;
  }

  /**
   * @param array $values
   * @return string
   */
  private function  icons(array $values) {
    $request = \Drupal::request();

    $url = Url::fromRoute('<current>');
    $url = $request->getHttpHost() . $url->toString();

    // Load the current node.
    $node = \Drupal::routeMatch()->getParameter('node');

    $site_config = \Drupal::config('system.site');

    $route = $request->attributes->get(RouteObjectInterface::ROUTE_OBJECT);
    if ($route) {
      $title = \Drupal::service('title_resolver')->getTitle($request, $route);
    }
    elseif ($node) {
      $node_fields = $node->toArray();
      $title = $node_fields['title'][0]['value'];
    }
    else {
      // Default title will come here
      $title = $site_config->get('name');
    }

    if (!empty($values['twitter_via'])) {
      $twitter_icon = '<li><a class="soc-twitter soc_ver-twitter" href="https://twitter.com/intent/tweet?source=' . $url . '&text=' . $title . ':' . $url . '&via=@'. $values['twitter_via'] . '" target="_blank" title=" '. $values['twitter_titletext'] .' "></a></li>';
    }
    else {
      $twitter_icon = '<li><a class="soc-twitter soc_ver-twitter" href="https://twitter.com/intent/tweet?source=' . $url . '&text=' . $title . ':' . $url . '&via=" target="_blank" title=" '. $values['twitter_titletext'] .' "></a></li>';
    }

    $facebook_icon = '<li><a class="soc-facebook soc_ver-facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '&t=' . $title . '" target="_blank" title=" '. $values['facebook_titletext'] .' "></a></li>';

    if (!empty($values['pinterest_image_url']) && !empty($values['pinterest_desc'])) {
      $pinterest_icon = '<li><a target="_blank" title=" '. $values['pinterest_titletext'] .' " class="soc-pinterest soc_ver-pinterest" href="https://pinterest.com/pin/create/button/?url=' . $url . '&media=' . $values['pinterest_image_url'] . '&description=' . $values['pinterest_desc'] . '"></a></li>';
    }
    else if (!empty($values['pinterest_image_url'])) {
      $pinterest_icon = '<li><a target="_blank" title=" '. $values['pinterest_titletext'] .' " class="soc-pinterest soc_ver-pinterest" href="https://pinterest.com/pin/create/button/?url=' . $url . '&media=' . $values['pinterest_image_url'] . '&description="></a></li>';
    }
    else if (!empty($values['pinterest_desc'])) {
      $pinterest_icon = '<li><a target="_blank" title=" '. $values['pinterest_titletext'] .' " class="soc-pinterest soc_ver-pinterest" href="https://pinterest.com/pin/create/button/?url=' . $url . '&media=&description=' . $values['pinterest_desc'] . '"></a></li>';
    }
    else {
      $pinterest_icon = '<li><a target="_blank" title=" '. $values['pinterest_titletext'] .' " class="soc-pinterest soc_ver-pinterest" href="https://pinterest.com/pin/create/button/?url=' . $url . '&media=&description="></a></li>';
    }

    $google_icon = '<li><a class="soc-google soc_ver-google" href="https://plus.google.com/share?url=' . $url . '" target="_blank" title="'. $values['googleplus_titletext'] .'"></a></li>';

    if (!empty($values['linkedin_summary']) && !empty($values['linkedin_source'])) {
      $linked_in_icon = '<li><a title=" '. $values['linkedin_titletext'] .'" class="soc-linkedin soc_ver-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '&source='. $values['linkedin_source'] .'&summary=' . $values['linkedin_summary'] . '" target="_blank"></a></li>';
    }
    else if (!empty($values['linkedin_source'])) {
      $linked_in_icon = '<li><a title=" '. $values['linkedin_titletext'] .'" class="soc-linkedin soc_ver-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '&source='. $values['linkedin_source'] .'&summary=" target="_blank"></a></li>';
    }
    else if (!empty($values['linkedin_summary'])) {
      $linked_in_icon = '<li><a title=" '. $values['linkedin_titletext'] .'" class="soc-linkedin soc_ver-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '&source=&summary=' . $values['linkedin_summary'] . '" target="_blank"></a></li>';
    }
    else {
      $linked_in_icon = '<li><a title=" '. $values['linkedin_titletext'] .'" class="soc-linkedin soc_ver-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '&source=&summary=" target="_blank"></a></li>';
    }

    // $blog_icon = '<li><a class="soc-rss soc-icon-last" href="#"></a></li>';

    if (!empty($values['email_body']) && !empty($values['email_subject'])) {
      $email = '<li><a title=" '. $values['email_titletext'] .'" class="soc-email1 soc_ver-email1" href="mailto:?&subject=' . $values['email_subject'] . '&body=' . $values['email_body'] . ' ' . $url . '"></a></li>';
    }
    else if(!empty($values['email_body'])) {
      $email = '<li><a title=" '. $values['email_titletext'] .'" class="soc-email1 soc_ver-email1" href="mailto:?&subject=&body=' . $values['email_body'] . ' ' . $url . '"></a></li>';
    }
    else if(!empty($values['email_subject'])) {
      $email = '<li><a title=" '. $values['email_titletext'] .'" class="soc-email1 soc_ver-email1" href="mailto:?&subject=' . $values['email_subject'] . '&body=' . $url . '"></a></li>';
    }
    else {
      $email = '<li><a title=" '. $values['email_titletext'] .'" class="soc-email1 soc_ver-email1" href="mailto:?&subject=&body=' . $url . '"></a></li>';
    }

    if (!empty($values['stumbleupon_url']) && !empty($values['stumbleupon_title'])) {
      $stumbleupon_icon = '<li><a target="_blank" title=" '. $values['stumbleupon_titletext'] .'" class="soc-stumbleupon soc_ver-stumbleupon" href="http://www.stumbleupon.com/submit?url=' . $values['stumbleupon_url'] . '&title=' . $values['stumbleupon_title'] . '"></a></li>';
    }
    else if(!empty($values['stumbleupon_url'])) {
      $stumbleupon_icon = '<li><a target="_blank" title=" '. $values['stumbleupon_titletext'] .'" class="soc-stumbleupon soc_ver-stumbleupon" href="http://www.stumbleupon.com/submit?url=' . $values['stumbleupon_url'] . '&title=' . $title . '"></a></li>';
    }
    else if(!empty($values['stumbleupon_title'])) {
      $stumbleupon_icon = '<li><a target="_blank" title=" '. $values['stumbleupon_titletext'] .'" class="soc-stumbleupon soc_ver-stumbleupon" href="http://www.stumbleupon.com/submit?url=' . $url . '&title=' . $values['stumbleupon_title'] . '"></a></li>';
    }
    else {
      $stumbleupon_icon = '<li><a target="_blank" title=" '. $values['stumbleupon_titletext'] .'" class="soc-stumbleupon soc_ver-stumbleupon" href="http://www.stumbleupon.com/submit?url=' . $url . '&title=' . $title . '"></a></li>';
    }

    if (!empty($values['tumblr_url']) && !empty($values['tumblr_title'])) {
       $tumblr_icon = '<li><a target="_blank" title=" '. $values['tumblr_titletext'] .'" class="soc-tumblr soc_ver-tumblr" href="http://www.tumblr.com/share?v=3&u=' . $values['tumblr_url'] . '&t=' . $values['tumblr_title'] . '"></a></li>';
    }
    else if(!empty($values['tumblr_url'])) {
       $tumblr_icon = '<li><a target="_blank" title=" '. $values['tumblr_titletext'] .'" class="soc-tumblr soc_ver-tumblr" href="http://www.tumblr.com/share?v=3&u=' . $values['tumblr_url'] . '&t=' . $title . '"></a></li>';
    }
    else if(!empty($values['tumblr_title'])) {
       $tumblr_icon = '<li><a target="_blank" title=" '. $values['tumblr_titletext'] .'" class="soc-tumblr soc_ver-tumblr" href="http://www.tumblr.com/share?v=3&u=' . $url . '&t=' . $values['tumblr_title'] . '"></a></li>';
    }
    else {
       $tumblr_icon = '<li><a target="_blank" title=" '. $values['tumblr_titletext'] .'" class="soc-tumblr soc_ver-tumblr" href="http://www.tumblr.com/share?v=3&u=' . $url . '&t=' . $title . '"></a></li>';
    }


    if (!empty($values['reddit_url']) && !empty($values['reddit_title'])) {
       $reddit_icon = '<li><a target="_blank" title=" '. $values['reddit_titletext'] .'" class="soc-reddit soc_ver-reddit" href="http://www.reddit.com/submit?url=' . $values['reddit_url'] . '&title=' . $values['reddit_title'] . '"></a></li>';
    }
    else if(!empty($values['reddit_url'])) {
       $reddit_icon = '<li><a target="_blank" title=" '. $values['reddit_titletext'] .'" class="soc-reddit soc_ver-reddit" href="http://www.reddit.com/submit?url=' . $values['reddit_url'] . '&title=' . $title . '"></a></li>';
    }
    else if(!empty($values['reddit_title'])) {
       $reddit_icon = '<li><a target="_blank" title=" '. $values['reddit_titletext'] .'" class="soc-reddit soc_ver-reddit" href="http://www.reddit.com/submit?url=' . $url . '&title=' . $values['reddit_title'] . '"></a></li>';
    }
    else {
       $reddit_icon = '<li><a target="_blank" title=" '. $values['reddit_titletext'] .'" class="soc-reddit soc_ver-reddit" href="http://www.reddit.com/submit?url=' . $url . '&title=' . $title . '"></a></li>';
    }



    if ($values['icon_placement'] == 0) {

      //print_r($values['icon_placement']);
      //die;
      /* icons are displaying horizontal value as 0 */
      //$icons = '<ul class="soc">';

      if (!$values['reddit_enable']) {
        $icon_order[$values['reddit_icon_order']] = $reddit_icon;
      }
      if (!$values['tumblr_enable']) {
        $icon_order[$values['tumblr_icon_order']] = $tumblr_icon;
      }
      if (!$values['stumbleupon_enable']) {
        $icon_order[$values['stumbleupon_icon_order']] = $stumbleupon_icon;
      }
      if (!$values['twitter_enable']) {
        $icon_order[$values['twitter_icon_order']] = $twitter_icon;
      }
      if (!$values['linkedin_enable']) {
        $icon_order[$values['linkedin_icon_order']] = $linked_in_icon;
      }
      if (!$values['pinterest_enable']) {
        $icon_order[$values['pinterest_icon_order']] = $pinterest_icon;
      }
      if (!$values['email_enable']) {
        $icon_order[$values['email_icon_order']] = $email;
      }
      if (!$values['facebook_enable']) {
        $icon_order[$values['facebook_icon_order']] = $facebook_icon;
      }
      if (!$values['googleplus_enable']) {
        $icon_order[$values['googleplus_icon_order']] = $google_icon;
      }
      // $icons .= '</ul>';
      //dsm($val);
      ksort($icon_order);
      $icons = '<ul class="soc">';
      foreach ($icon_order as $key => $icon_sort_list) {
        $icons .= $icon_sort_list;
        // dsm($val_new[$key]);
      }
      $icons .= '</ul>';
      return $icons;
    }
    else {
      /* icons are displaying vertical value as 1 */
      $icons = '<ul class="soc_ver">';
      if (!$values['reddit_enable']) {
        $icons .= $reddit_icon;
      }
      if (!$values['tumblr_enable']) {
        $icons .= $tumblr_icon;
      }
      if (!$values['stumbleupon_enable']) {
        $icons .= $stumbleupon_icon;
      }
      if (!$values['twitter_enable']) {
        $icons .= $twitter_icon;
      }
      if (!$values['linkedin_enable']) {
        $icons .= $linked_in_icon;
      }
      if (!$values['pinterest_enable']) {
        $icons .= $pinterest_icon;
      }
      if (!$values['email_enable']) {
        $icons .= $email;
      }
      if (!$values['facebook_enable']) {
        $icons .= $facebook_icon;
      }
      if (!$values['googleplus_enable']) {
        $icons .= $google_icon;
      }
      $icons .= '</ul>';
      return $icons;
    }
  }
}
