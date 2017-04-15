<?php
namespace Iaejean\Mail;

use Iaejean\Base\TraitService;
use JMS\DiExtraBundle\Annotation as DI;
use Mailgun\Tests\Mock\Mailgun;

/**
 * Class MailService
 * @package Iaejean\Mail
 * @DI\Service()
 */
class MailService
{
    /**
     * @var Mailgun
     */
    protected $mailgun;
    /**
     * @var string
     */
    protected $key;
    /**
     * @var string
     */
    protected $domain;
    /**
     * @var string
     */
    protected $from;

    use TraitService;

    /**
     * MailService constructor.
     *
     * @param $key
     * @param $domain
     * @DI\InjectParams({
     *     "key" = @DI\Inject("%mailgun_apiKey%"),
     *     "domain" = @DI\Inject("%mailgun_endpoint%"),
     *     "from" = @DI\Inject("%mailgun_from%")
     * })
     */
    public function __construct($key, $domain, $from)
    {
        $this->key = $key;
        $this->domain = $domain;
        $this->from = $from;
    }

    public function connect()
    {
        if (!$this->mailgun instanceof Mailgun) {
            $this->logger->info('Connecting to Mailgun Service');
            $this->mailgun = new Mailgun($this->key);
        }
    }

    /**
     * @param       $to
     * @param       $subject
     * @param       $text
     * @param null  $cc
     * @param null  $html
     * @param array $attachment
     * @param null  $from
     *
     * @throws \Exception
     */
    public function send($to, $subject, $text, $cc = null, $html = null, array $attachment = [], $from = null)
    {
        try {
            $this->connect();
            $this->logger->info("Sending message to/subject: $to/$subject");

            $params = [];
            foreach (get_defined_vars() as $key => $val) {
                if (!empty($val) && $key !== "attachment") {
                    $params[$key] = $val;
                }
            }

            $params = array_merge($params, ["from" => $this->from]);
            if (!is_null($from)) {
                $params["from"] = $from;
            }

            $response = $this->mailgun->sendMessage($this->domain, $params, ['attachment'=> $attachment]);
            $this->logger->info(json_encode($response));
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new \Exception();
        }
    }
}
