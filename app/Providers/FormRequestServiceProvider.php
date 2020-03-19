<?php
namespace App\Providers;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

/**
 * Class FormRequestServiceProvider
 */
class FormRequestServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 * @return void.
	 */
	public function register()
	{

	}

	/**
	 * Bootstrap the application services.
	 * @return void.
	 */
	public function boot()
	{
		$this->app->resolving(FormRequest::class, function ($request, $app)
		{
			$this->initializeRequest($request, $app['request']);
		});

		$this->app->afterResolving(FormRequest::class, function ($form)
		{
			$form->validate();
		});
	}

	/**
	 * Initialize the form request with data from the given request.
	 *
	 * @param FormRequest $form    Param.
	 * @param Request     $current Param.
	 * @return void.
	 */
	protected function initializeRequest(FormRequest $form, Request $current)
	{
		$files = $current->files->all();
		$files = \is_array($files) ? array_filter($files) : $files;
		$form->initialize($current->query->all(), $current->request->all(), $current->attributes->all(), $current->cookies->all(), $files, $current->server->all(), $current->getContent());
		$form->setJson($current->json());
	}
}
