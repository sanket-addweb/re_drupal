<?php

namespace Drupal\revise_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\revise_module\Services\HelloService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "revise_module_hello_block",
 *   admin_label = @Translation("Hello word block"),
 *   category = @Translation("Hello word block")
 * )
 */
class HelloBlock extends BlockBase implements ContainerFactoryPluginInterface{

  private $hello;

	public function __construct(array $configuration, $plugin_id,$plugin_definition, HelloService $hello){
		$this->hello = $hello;
		parent::__construct($configuration, $plugin_id, $plugin_definition);
	}
	/**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The Drupal service container.
   *
   * @return static
   */
	public static function create(ContainerInterface $container,array $configuration, $plugin_id, $plugin_definition){
		return new static(
			$configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('revise_module.helloServices'),
		);
	}
  /**
   * {@inheritdoc}
   */
  public function build() {
		$helloWord = $this->hello->getHello();

		$url = Url::fromRoute('revise_module.formDataDisplay');
		$link = Link::fromTextAndUrl('1.My form link', $url);
		$project_link = $link->toRenderable();
		$path_link=render($project_link);
    $build['content'] = [
      '#markup' => $this->t("It works! and $helloWord and $path_link"),
    ];
    $build['link'] = [
      '#title' => $this->t('2.My Custom Form'),
      '#type' => 'link',
      '#url' => $url,
    ];
    return $build;
  }

}
