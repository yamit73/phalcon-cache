<?php
namespace App\Components;

use Phalcon\Di\Injectable;
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class Locale extends Injectable
{
    /**
     * @return NativeArray
     */
    public function getTranslator(): NativeArray
    {
        // Ask browser what is the best language
        $language = $this->request->getQuery('lan');
        $messages = [];
        
        $translationFile = APP_PATH.'/messages/' . $language . '.php';

        if (true !== file_exists($translationFile)) {
            $translationFile = APP_PATH.'/messages/en.php';
        }
        
        require $translationFile;

        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);
        $cache=$this->cache;
        if ($cache->has($language.'_messages')) {
            $messages=(array)$cache->get($language.'_messages');
        } else {
            $cache->set($language.'_messages',$messages);
        }
        return $factory->newInstance(
            'array',
            [
                'content' => $messages,
            ]
        );
    }
}