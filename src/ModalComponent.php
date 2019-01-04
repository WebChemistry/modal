<?php declare(strict_types = 1);

namespace WebChemistry\Modal;

use Nette\Application\UI\Control;

class ModalComponent extends Control {

	/** @var Control */
	private $control;

	public function __construct(Control $control) {
		$this->control = $control;

		$this->onAnchor[] = function (): void {
			if ($this->getPresenter()->isAjax()) {
				$this->redrawControl('modal');
			}
		};
	}

	protected function createComponentControl() {
		return $this->control;
	}

	final public function render(): void {
		$template = $this->createTemplate();
		$template->setFile(__DIR__ . '/templates/bootstrap.latte');
		$template->visible = (bool) $this->getParameter('visibility');
		$template->id = $this->getUniqueId();

		$template->render();
	}

	final public function getLink(): string {
		return $this->link('this', ['visibility' => true]);
	}

	final public function renderLink(): void {
		echo $this->getLink();
	}

}
