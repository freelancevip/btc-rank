<?php

class CryptoCurrency {
	private $dom;
	public $title, $capital, $course, $diff;

	function __construct( $dom ) {
		$this->dom = $dom;
	}

	function getId() {
		return (int) trim( $this->dom->find( "td", 0 )->plaintext );
	}

	function getTitle() {
		return (string) trim( $this->dom->find( "td", 1 )->plaintext );
	}

	function getCapital() {
		$text = $this->dom->find( "td", 2 )->plaintext;

		return (float) trim( str_replace( array( '$', ',' ), '', $text ) );
	}

	function getCourse() {
		$text = $this->dom->find( "td", 3 )->plaintext;

		return (float) trim( str_replace( '$', '', $text ) );
	}

	function getDiff() {
		$text = $this->dom->find( "td", 4 )->plaintext;

		return (float) trim( str_replace( array( '▼', '▲', '(', ')', '%' ), '', $text ) );
	}

	function toArray() {
		return array(
			'id'      => $this->getId(),
			'title'   => $this->getTitle(),
			'capital' => $this->getCapital(),
			'course'  => $this->getCourse(),
			'diff'    => $this->getDiff(),
		);
	}
}
