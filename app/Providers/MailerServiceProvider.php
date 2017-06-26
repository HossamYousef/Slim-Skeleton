<?php

namespace App\Providers;

use App\Common\MailRenderer;
use Pimple\Container;

final class MailerServiceProvider extends AbstractServiceProvider
{
    /**
     * Register mailer service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config = $container['settings'];

        $container['Mailer'] = function ($container) use ($config) {
            return new \Swift_Mailer(
                (new \Swift_SmtpTransport(
                    $config['Mail']['host'], // Specify main and backup SMTP servers
                    $config['Mail']['port'], // TCP port to connect to
                    $config['Mail']['encryption']
                )) // Enable TLS encryption, `ssl` also accepted
                ->setUsername($config['Mail']['username']) // SMTP username
                ->setPassword($config['Mail']['password'])
            );
        };

        $container['MailMessage'] = function ($container) {
            return new \Swift_Message();
        };

        $container['MailRenderer'] = function () use ($config) {
            $renderer = new MailRenderer(
                $config['MailRenderer']['template_path'],
                $config['MailRenderer']['template_settings']
            );
            return $renderer;
        };
    }
}
