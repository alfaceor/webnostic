<?php
/**
 * DooMailer class file.
 * @package doo.helper
 * @author Milos Kovacki <kovacki@gmail.com>
 * @link http://www.doophp.com/
 * @copyright Copyright &copy; 2009 Leng Sheng Hong
 * @license http://www.doophp.com/license
 */

/**
* DooMailer class, for sending e-mails
*
* @author Milos Kovacki <kovacki@gmail.com>
* @copyright &copy; 2009 Milos Kovacki
* @license http://www.doophp.com/license
*/
class DooMailer {

	/**
	* Mail charset set
	* @var string
	*/
	protected $_charset = null;

	/**
	* Mail headers
	*/
	protected $_headers = null;

	/**
	* From address
	* @var string
	*/
    protected $_from = null;

	/**
	* To address
	* @var string
	*/
    protected $_to = array();

	/**
	* Email subject
	* @var string
	*/
    protected $_subject = null;

    /**
    * Email date
    * @var string
    */
    protected $_date = null;

	/**
	* Email body text
	* @var string
	*/
    protected $_bodyText = false;

	/**
	* Email body HTML
	*/
    protected $_bodyHtml = false;

	/**
	* Email content type
	*/
    protected $_type = null;

	/**
	* Attachments for email
	*
	* @var array
	*/
	protected $_attachments = array();

	/**
	 * End of line combo to use in headers
	 * Some OS / Mail Servers require an alternative line ending
	 * @var string
	 */
	protected $_headerEOL = "\r\n";

	/**
	* Flag if email has attachments
	* @var bool
	*/
    public $hasAttachments = false;

	/**
	* Class constructor
	*
	* @param string $charset Charset for mail, default (utf-8)
	* @param string $headerEOL The string to use for end of line in the mail headers (Note: Use double quotes when defining this)
	*/
	public function __construct($charset = 'utf-8', $headerEOL = "\r\n") {
		$this->_charset = $charset;
		$this->_headerEOL = $headerEOL;
	}

	/**
	* Set body text
	*
	* @param string $bodyText Text for message body
	*/

	public function setBodyText($bodyText) {
		$this->_bodyText = $bodyText;
	}

	/**
	* Set body HTML
	*
	* @param string $bodyHtml HTML for message body
	*/
	public function setBodyHtml($bodyHtml) {
		$this->_bodyHtml = $bodyHtml;
	}

	/**
	* Set email subject
	* @param string $subject Email subject
	* @param bool $encode Force encoding of subject
	*/
	public function setSubject($subject, $encode=false) {
		if ($encode == true) {
			$this->_subject = '=?'.$this->_charset.'?B?'.base64_encode($subject).'?=';
		} else {
			$this->_subject = $subject;
		}
	}

	/**
	* Set from field
	*
	* @param string $email Email address for from field
	* @param string $name Name of sender
	*/
	public function setFrom($email, $name=null) {
		$this->_from = array('email' => $email, 'name' => $name);
	}

	/**
	* Add email address for to field
	*
	* @param string $email Email for reciever
	* @param string $name Name of person you are sending email
	*/
	public function addTo($email, $name=null) {
		if ($email != "") {
			array_push($this->_to, array($email, $name));
		}
	}

	/**
	* Add attachment to email
	*
	* @var string $file
	*/
	public function addAttachment($file) {
		if (file_exists($file) && (is_file($file))) {
			// read file
			$tmpFile = fopen($file, 'rb');
			$data = fread( $tmpFile, filesize($file) );
			fclose($tmpFile);
			// add to array
			array_push(
               $this->_attachments,
               array('file_name' => @end(explode('/', $file)),
               'file_type' => filetype($file), 'file_data' => $data)
			);
			$this->hasAttachments = true;
		}
	}

	/**
	* Get to functon returns all recievers of email
	*
	* @param bool $header If header is true (first value true) it will return
	* to params for header.
	*/
	private function getTo($headers=false) {
		$tmp = "";
		foreach ($this->_to as $to) {
			if (isset($to[0])) {
				$name = (isset($to[1]))?$to[1]:'';
				if (!$headers)
					$tmp .= $to[0] . ', ';
				else
					$tmp .= $name . '<'.$to[0].'>, ';
			}
		}
		return substr($tmp, 0, -2);
	}

	/*
	* Create headers and send email
	*
	* @return bool Returns true if mail is sent.
	*/
	public function send() {
		$body = "";
		// add from
		$from = $this->_from;
		$fromName = (isset($from['name']))?$from['name']:'';
		$fromEmail = (isset($from['email']))?$from['email']:'';
		$mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';
		$header = "From: ".$fromName." <{$fromEmail}>" . $this->_headerEOL;
		$header .= "MIME-Version: 1.0" . $this->_headerEOL;
		$header .= "Content-Type: multipart/alternative; boundary=\"{$mime_boundary}\"" . $this->_headerEOL;

        // add content
		if (isset($this->_bodyText) && ($this->_bodyText != "") && ($this->_bodyHtml == "")) {
			$body.= "--{$mime_boundary}" . $this->_headerEOL;
			$body.= "Content-Type: text/plain; charset={$this->_charset}" . $this->_headerEOL;
			$body.= "Content-Transfer-Encoding: 7bit" . $this->_headerEOL . $this->_headerEOL;
			$body.= $this->_bodyText;
			$body.= $this->_headerEOL . $this->_headerEOL;
		} else if (isset($this->_bodyHtml)) {
			$body.= "--{$mime_boundary}" . $this->_headerEOL;
			$body.= "Content-Type: text/html; charset={$this->_charset}" . $this->_headerEOL;
			$body.= "Content-Transfer-Encoding: 7bit" . $this->_headerEOL . $this->_headerEOL;
			$body.= $this->_bodyHtml;
			$body.= $this->_headerEOL . $this->_headerEOL;
		}
		// add attachments if there are any
		if ($this->hasAttachments == true) {
			foreach ($this->_attachments as $attachment => $a) {
				$body .= "--{$mime_boundary}" . $this->_headerEOL;
				$body .= 'Content-Type: "'.$a['file_type'].'"; name="'.$a['file_name'] . $this->_headerEOL;
				$body .= 'Content-Disposition: attachment; filename="'.$a['file_name'] .'"'. $this->_headerEOL;
				$body .= "Content-Transfer-Encoding: base64" . $this->_headerEOL;
				$body .= chunk_split(base64_encode($a['file_data'])) . $this->_headerEOL;
			}
		}
		$body .= "--{$mime_boundary}--" . $this->_headerEOL;

		// mail it
		if (mail($this->getTo(true), $this->_subject, $body, $header)) {
			return true;
		}
		return false;
	}
}