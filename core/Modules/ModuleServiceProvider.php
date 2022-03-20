<?php

namespace Core\Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	foreach (scandir(__DIR__) as $folder) {

    		if (file_exists(__DIR__.'/'.$folder.'/routes.php')) {
    			include __DIR__.'/'.$folder.'/routes.php';
    		}

    		if (is_dir(__DIR__.'/'.$folder.'/Views/')) {
    			$this->loadViewsFrom(__DIR__.'/'.$folder.'/Views', $folder);
    		}

            $this->loadViewComponentsAs('admin', [
                'sidebar' => \Core\Modules\Admin\Components\SidebarComponent::class,
                'navbar' => \Core\Modules\Admin\Components\NavbarComponent::class,
                
            ]);
        }
    }
}
