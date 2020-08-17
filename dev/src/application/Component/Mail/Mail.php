<?php namespace Application\Component\Mail;


use Andesite\Core\Env\Env;
use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;

class Mail {

	/** @var PHPMailer  */
	protected $mailer;
	/**@var \Twig\TemplateWrapper */
	private $html;
	/**@var \Twig\TemplateWrapper */
	private $text;

	public function __construct($template) {
		$this->mailer = new PHPMailer();
		$this->mailer->CharSet = 'UTF-8';
		$this->mailer->From = Env::Service()->get('app.mail.sender.email');
		$this->mailer->FromName = Env::Service()->get('app.mail.sender.name');

		//MAILJET SETTINGS
		$this->mailer->IsSMTP();
		$this->mailer->SMTPAuth = true;
		$this->mailer->Host = 'in-v3.mailjet.com';
		$this->mailer->Port = 80;
		$this->mailer->Username = 'f2a9231b1492b70f5f927246b14ef643';
		$this->mailer->Password = 'a4195c9c5792f438b0a0c0b53b1f2d82';
		$this->mailer->isHTML(true);
		$this->mailer->SMTPKeepAlive = true;


		$this->prepare($template);
	}

	public function send($to, $name, $subject, $data){
		$this->mailer->Subject = $subject;
		$this->mailer->addAddress($to, $name);
		$this->mailer->Body = $this->html->render($data);
		$this->mailer->AltBody = $this->text->render($data);
		$this->mailer->send();
	}

	protected function prepare($template){
		$twig = new Environment(new \Twig\Loader\ArrayLoader([]));
		$twig->setCache(false);
		$this->html = $twig->createTemplate(file_get_contents(Env::Service()->get('app.mail.template').$template.'.html.twig'));
		$this->text = $twig->createTemplate(file_get_contents(Env::Service()->get('app.mail.template').$template.'.txt.twig'));
	}
}
