<?php

require_once '../vendor/autoload.php';

class PanelApp extends \Fabs\Component\Http\HttpApplicationBase
{

    protected function onConstruct()
    {
        $this->addMiddleware(\Fabs\Component\Http\Middleware\JSONContentMiddleware::class);
    }

    /**
     * @param \Fabs\Component\Http\Bag\ModuleBag $module_bag
     * @return void
     */
    protected function configureModuleBag($module_bag)
    {
        $module_bag->create('/irobot', IRobotModule::class);
    }
}

class IRobotModule extends \Fabs\Component\Http\ModuleBase
{

    /**
     * @return \Fabs\Component\Http\ResourceProviderInterface
     */
    public function getResourceProvider()
    {
        return new ResourceProvider();
    }

    /**
     * @return \Fabs\Component\Http\ServiceProviderInterface|null
     */
    public function getServiceProvider()
    {
        return null;
    }
}

class ResourceProvider implements \Fabs\Component\Http\ResourceProviderInterface
{

    /**
     * @param \Fabs\Component\Http\Bag\ResourceBag $resource_bag
     * @return void
     */
    public function configureResourceBag($resource_bag)
    {
        $resource_bag->create('/item', ItemResourceBase::class);
    }
}

class ItemResourceBase extends \Fabs\Component\Http\JSONResourceBase
{
    /**
     * @param \Fabs\Component\Http\Bag\EndpointBag $endpoint_bag
     * @return void
     */
    public function configureEndpointBag($endpoint_bag)
    {
        $endpoint_bag->create('/')
            ->addGET('getAll')
            ->addPOST('create');
    }

    public function getAll()
    {
        return 'getall response';
    }

    public function create()
    {
        $model = $this->getRequestContent(new \Fabs\Component\Serializer\Normalizer\Type(ItemCreateModel::class));
        return $model;
    }
}

class ItemCreateModel implements \Fabs\Component\Serializer\Normalizer\NormalizableInterface
{

    /** @var string */
    public $name = null;
    /** @var float */
    public $price = 0.0;
    /** @var ItemDescriptionCreateModel */
    public $description = null;

    /**
     * @param \Fabs\Component\Serializer\Normalizer\NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('description',
            new \Fabs\Component\Serializer\Normalizer\Type(ItemDescriptionCreateModel::class));
    }
}

class ItemDescriptionCreateModel implements \Fabs\Component\Serializer\Normalizer\NormalizableInterface
{
    /** @var string */
    public $market_hash_name = null;

    /**
     * @param \Fabs\Component\Serializer\Normalizer\NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {

    }
}

class IRobotExceptionHandler extends \Fabs\Component\Http\ExceptionHandlerBase
{

    /**
     * @param \Exception $exception
     */
    public function handle($exception)
    {
//        throw $exception;
        if ($exception === null) {
            return;
        }

        $exception_message = $exception->getMessage();
        $file_name = $exception->getFile();
        $line = strval($exception->getLine());
        $stack_trace_string = $exception->getTraceAsString();

        try {
            $inputs = file_get_contents('php://input');
        } catch (\Exception $exception) {
            $inputs = null;
        }

        try {
            $context = $_SERVER;
        } catch (\Exception $exception) {
            $context = null;
        }

        $property_name = null;
        $validator_name = null;
//        if ($exception instanceof ValidationException) {
//            $property_name = $exception->getPropertyName();
//            $validator_name = $exception->getValidatorName();
//        } else {
//            $property_name = null;
//            $validator_name = null;
//        }

        $log_message = sprintf(
            "\n\n message: %s \n file: %s:%s\n property: %s \n validation: %s \n stacktrace: %s \n inputs: %s\n context: %s\n\n",
            $exception_message,
            $file_name,
            $line,
            $property_name,
            $validator_name,
            $stack_trace_string,
            $inputs,
            json_encode($context)
        );

        echo '<pre>' . $log_message;
    }
}

$app = new PanelApp();
$app
    ->addExceptionHandlerDefinition(
        (new \Fabs\Component\Http\Definition\ExceptionHandlerDefinition(\Fabs\Component\Http\Exception\StatusCodeException::class))
            ->setClassName(\Fabs\Component\Http\ExceptionHandler\RestfulExceptionHandler::class))
    ->addExceptionHandlerDefinition(
        (new \Fabs\Component\Http\Definition\ExceptionHandlerDefinition(\Exception::class))
            ->setClassName(IRobotExceptionHandler::class));
$app->run();