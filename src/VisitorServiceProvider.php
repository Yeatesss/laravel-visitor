<?php
namespace Yeates\Visitor;

use \Illuminate\Support\ServiceProvider;
use Yeates\Visitor\Channels\FreeIpChannel;
use Yeates\Visitor\Channels\TaoBaoIpChannel;
use Yeates\Visitor\Services\IpHandleService;

class VisitorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/visitor.php' => config_path('visitor.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__.'/../config/visitor.php', 'visitor');
        if (! class_exists('CreateVisitorIpPoolTables')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../migrations/create_visitor_ip_pool_table.php.stub' => database_path("/migrations/{$timestamp}_create_visitor_ip_pool_table.php"),
            ], 'migrations');
        }
    }
    public function register()
    {
//        $this->app->bind('command.activitylog:clean', CleanActivitylogCommand::class);
//        $this->commands([
//            'command.activitylog:clean',
//        ]);
        $this->app->bind('VisitorLog', function () {
            return new VisitorLog();
        });
        $this->app->bind('TaoBaoIpChannel', function () {
            return new TaoBaoIpChannel();
        });
        $this->app->bind('FreeIpChannel', function () {
            return new FreeIpChannel();
        });
       
//        $this->bindFunction(IpHandleService::RESOLVE_IP_CHANNEL);
//        $this->app->singleton(ActivityLogStatus::class);
    }
    
    
    public function bindFunction(array $funName){
        $a = 'TaoBaoIpChannel';
        dd(app(TaoBaoIpChannel::class));
        array_walk($funName,function($fun){
            $this->app->bind($fun, function () use($fun) {
                
                return new $fun();
            });
        
        });
    }
//    public static function determineActivityModel(): string
//    {
//        $activityModel = config('activitylog.activity_model') ?? ActivityModel::class;
//        if (! is_a($activityModel, Activity::class, true)
//            || ! is_a($activityModel, Model::class, true)) {
//            throw InvalidConfiguration::modelIsNotValid($activityModel);
//        }
//        return $activityModel;
//    }
//    public static function getActivityModelInstance(): Model
//    {
//        $activityModelClassName = self::determineActivityModel();
//        return new $activityModelClassName();
//    }
}