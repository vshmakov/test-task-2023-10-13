PHPUnit 9.6.13 by Sebastian Bergmann and contributors.

Testing 
E                                                                   1 / 1 (100%)

Time: 00:01.504, Memory: 52.50 MB

There was 1 error:

1) App\Tests\Api\Purchase\CreateTest::testAction
Error: Call to a member function getLinks() on null

/app/vendor/api-platform/core/src/State/Processor/AddLinkHeaderProcessor.php:40
/app/vendor/api-platform/core/src/HttpCache/State/AddHeadersProcessor.php:32
/app/vendor/api-platform/core/src/State/Processor/SerializeProcessor.php:75
/app/vendor/api-platform/core/src/State/Processor/WriteProcessor.php:42
/app/vendor/api-platform/core/src/Symfony/Controller/MainController.php:100
/app/vendor/symfony/http-kernel/HttpKernel.php:182
/app/vendor/symfony/http-kernel/HttpKernel.php:76
/app/vendor/symfony/http-kernel/EventListener/ErrorListener.php:108
/app/vendor/api-platform/core/src/Symfony/EventListener/ExceptionListener.php:48
/app/vendor/symfony/event-dispatcher/Debug/WrappedListener.php:116
/app/vendor/symfony/event-dispatcher/EventDispatcher.php:220
/app/vendor/symfony/event-dispatcher/EventDispatcher.php:56
/app/vendor/symfony/event-dispatcher/Debug/TraceableEventDispatcher.php:139
/app/vendor/symfony/http-kernel/HttpKernel.php:240
/app/vendor/symfony/http-kernel/HttpKernel.php:91
/app/vendor/symfony/http-kernel/Kernel.php:197
/app/vendor/symfony/http-kernel/HttpKernelBrowser.php:66
/app/vendor/symfony/framework-bundle/KernelBrowser.php:171
/app/vendor/symfony/browser-kit/AbstractBrowser.php:403
/app/tests/Api/ActionTest.php:114
/app/tests/Api/ActionTest.php:40

ERRORS!
Tests: 1, Assertions: 0, Errors: 1.
